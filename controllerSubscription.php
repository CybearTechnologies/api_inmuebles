<?php
require_once "vendor/autoload.php";
Tools::headers();
$headers = apache_request_headers();
$get = Tools::getObject();
$post = Tools::postObject();
$return = null;
$mapper = FactoryMapper::createMapperSubscription();
$mapperSubDetail = FactoryMapper::createMapperSubscriptionDetail();
$wrapper = new MailerWrapper();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (Validate::id($get)) {
					$command = FactoryCommand::createCommandGetSubscription($get->id);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (SubscriptionNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SUBSCRIPTION_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_SUBSCRIPTION_NOT_FOUND"));
					}
					catch (CustomException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
				}
				else {
					$command = FactoryCommand::createCommandGetAllSubscription();
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (SubscriptionNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SUBSCRIPTION_NOT_FOUND"));
						Tools::setResponse();
					}
				}
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Tools::setResponse(Values::getValue('ERROR_ORIGIN_NOT_FOUND'));
			}
			catch (InvalidJWTException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
			catch (Exception $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_HEADER"));
			Tools::setResponse(Values::getValue("ERROR_HEADER"));
		}
		echo json_encode($return);
		break;
	case "POST":
		if (Validate::application()) {
			if (Validate::subscription($post)) {
				try {
					// Files processing
					$details = [];
					$files = [];
					if (isset($_FILES['files']) && count($_FILES['files']['size']) > 0) {
						$i = 0;
						foreach ($_FILES['files']['name'] as $file) {
							$path = Tools::saveFile($file, $_FILES['files']['tmp_name'][$i],
								$post->firstName . $post->lastName, 'files/user');
							array_push($details,
								FactoryDto::createDtoSubscriptionDetail(-1, Environment::baseURL() . $path, -1));
							array_push($files, __DIR__ . '/' . $path);
							$i++;
						}
					}
					$post->password = Validate::passwordHash($post->password . Environment::siteKey() . Tools::siteEncrypt($post->password));
					/** @var DtoSubscription $post */
					$subscription = $mapper->fromDtoToEntity($post);
					$command = FactoryCommand::createCommandSubscribeUser($subscription, $details);
					$command->execute();
					$return = $command->return();
					Tools::setResponse();
					$wrapper->setFrom()->setTo($return->email, $return->firstName . ' ' . $return->lastName)
						->setSubject('Buscamatch')
						->setBody('Se ha enviado tu solicitud correctamente. Pronto se dara respuesta!')
						->sendEmail();
				}
				catch (DatabaseConnectionException $exception) {
					foreach ($files as $file)
						file_exists($file) ? Tools::removeFile($file) : null;
					$return = new ErrorResponse($exception->getMessage());
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
				}
				catch (FileNotFoundException $exception) {
					foreach ($files as $file)
						file_exists($file) ? Tools::removeFile($file) : null;
					$return = $exception->getMessage();
					Tools::setResponse($exception->getCode());
				}
				catch (SaveFileException $exception) {
					foreach ($files as $file)
						file_exists($file) ? Tools::removeFile($file) : null;
					$return = $exception->getMessage();
					Tools::setResponse($exception->getCode());
				}
				catch (MailerException $exception) {
					$return = new ErrorResponse($exception->getMessage());
					Tools::setResponse(Values::getValue("ERROR_MAILER"));
				}
			}
			else {
				$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
				Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_HEADER"));
			Tools::setResponse(Values::getValue("ERROR_HEADER"));
		}
		echo json_encode($return);
		break;
	case "PUT":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (isset($get->action) && $get->action = "accept" && isset($get->id) && is_numeric($get->id)) {
					$command = FactoryCommand::createCommandApproveSubscription($get->id);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
						$wrapper->setFrom()->setTo($return->email, $return->firstName . ' ' . $return->lastName)
							->setSubject('Buscamatch')
							->setBody('Tu solicitud de registro se ha aceptado exitosamente!
					 				inicia sesion en https://buscamatch.com')
							->sendEmail();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (SubscriptionNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SUBSCRIPTION_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_SUBSCRIPTION_NOT_FOUND"));
					}
					catch (MailerException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_MAILER"));
						Tools::setResponse(Values::getValue("ERROR_MAILER"));
					}
				}
				if (isset($get->decline) && isset($get->id) && is_numeric($get->id)) {
					$command = FactoryCommand::createCommandDeleteSubscription($get->id);
					try {
						$command->execute();
					}
					catch (DatabaseConnectionException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (SubscriptionNotFoundException $exception) {
						$return = new ErrorResponse(Values::getText("ERROR_SUBSCRIPTION_NOT_FOUND"));
						Tools::setResponse();
					}
				}
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Tools::setResponse(Values::getValue('ERROR_ORIGIN_NOT_FOUND'));
			}
			catch (InvalidJWTException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
			catch (Exception $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_HEADER"));
			Tools::setResponse(Values::getValue("ERROR_HEADER"));
		}
		echo json_encode($return);
		break;
	case "DELETE":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				if (Validate::id($get)) {
					$command = FactoryCommand::createCommandDeleteSubscription($get->id);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (SubscriptionNotFoundException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_SUBSCRIPTION_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_SUBSCRIPTION_NOT_FOUND"));
					}
				}
				else {
					$return = new ErrorResponse(Values::getText("ERROR_HEADER"));
					Tools::setResponse(Values::getValue("ERROR_HEADER"));
				}
			}
			catch (DatabaseConnectionException $e) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Tools::setResponse(Values::getValue('ERROR_ORIGIN_NOT_FOUND'));
			}
			catch (InvalidJWTException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
			catch (Exception $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(Values::getText('ERROR_LOGIN_USER_NOT_LOGGED'));
				Tools::setResponse(Values::getValue('ERROR_LOGIN_USER_NOT_LOGGED'));
			}
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}