<?php
require_once "vendor/autoload.php";
Tools::headers();
$headers = apache_request_headers();
$return = null;
$wrapper = new MailerWrapper();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "POST":
		$post = json_decode(file_get_contents("php://input"));
		if (Validate::application()) {
			try{
				if (Validate::passwordToken($post)) {
					$command = FactoryCommand::createCommandGetUserByUsername($post->email);
					$command->execute();
					$user = $command->return();
					$loggedUser=$user->id;
					$randomString = md5(uniqid($post->email, true));
					$passwordToken = FactoryEntity::createPasswordToken(-1, $randomString, $user->id);
					$command = FactoryCommand::createCommandCreatePasswordToken($passwordToken,$loggedUser);
					$command->execute();
					$passwordToken = $command->return();
					$wrapper->setFrom()->setTo($user->email, $user->firstName . ' ' . $user->lastName)
						->setSubject('Buscamatch - Recuperar Contraseña')
						->setBody('Para realizar el cambio de contraseña acceda al siguiente enlace '
							. Environment::baseFrontURL() . 'change-password/' . $passwordToken->token."_".$user->email)
						->sendEmail();
					Tools::setResponse();
				}
				else {
					$return = new ErrorResponse(Values::getText('ERROR_DATA_INCOMPLETE'));
					Tools::setResponse(Values::getValue('ERROR_DATA_INCOMPLETE'));
				}
			}
			catch (DatabaseConnectionException $exception) {
				Logger::exception($exception,Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (MultipleUserException $exception) {
				Logger::exception($exception,Logger::ERROR);
				$return = new ErrorResponse(Values::getValue('ERROR_USER_WRONG_PASSWORD'));
				Tools::setResponse(Values::getValue('ERROR_USER_WRONG_PASSWORD'));
			}
			catch (UserNotFoundException $exception) {
				//no se debe devolver que no se encontró el usuario
				Logger::exception($exception,Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (MailerException $exception) {
				Logger::exception($exception,Logger::ERROR);
				$return = new ErrorResponse($exception->getMessage());
				Tools::setResponse(Values::getValue("ERROR_MAILER"));
			}
			catch (PasswordTokenNotFoundException $e) {
				//no se debe devolver que no se encontró el usuario
				Logger::exception($e,Logger::ERROR);
				$return = new ErrorResponse($e->getMessage());
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		echo json_encode($return);
		break;
	case "GET":
		if (Validate::application()) {
			$get = Tools::getObject();
			if (Validate::validPasswordToken($get)) {
				try{
					$values = explode("_",$get->token);
					$command=FactoryCommand::createCommandGetPasswordTokenByToken($values[0],$values[1]);
					$command->execute();
					$command=FactoryCommand::createCommandGetUserByUsername($values[1]);
					$command->execute();
					$user= $command->Return()->id;
					$command = FactoryCommand::createCommandGetOriginByPublicKey($headers[Values::APPLICATION_HEADER]);
					$command->execute();
					$origin = $command->return()->getPrivateKey();
					$token = Auth::generateJWT($user, $origin);
					$return = $token;
					Tools::setResponse();
				}
				catch (DatabaseConnectionException $exception) {
					Logger::exception($exception,Logger::ERROR);
					$return = new ErrorResponse($exception->getMessage());
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
				}
				catch (PasswordTokenNotFoundException $exception) {

					Logger::exception($exception,Logger::ERROR);
					$return = new ErrorResponse($exception->getMessage());
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
				}
				catch (MultipleUserException $e) {

					Logger::exception($e,Logger::ERROR);
					$return = new ErrorResponse($e->getMessage());
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
				}
				catch (UserNotFoundException $e) {

					Logger::exception($e,Logger::ERROR);
					$return = new ErrorResponse($e->getMessage());
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
				}
				catch (OriginNotFoundException $e) {
					Logger::exception($e,Logger::ERROR);
					$return = new ErrorResponse($e->getMessage());
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
				}
			}
		}
		else {
			$return = new ErrorResponse(Values::getText('ERROR_DATA_INCOMPLETE'));
			Tools::setResponse(Values::getValue('ERROR_DATA_INCOMPLETE'));
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(404);
		break;
}

