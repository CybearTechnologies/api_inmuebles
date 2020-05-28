<?php
require_once "vendor/autoload.php";
Tools::headers();
$headers = apache_request_headers();
$return = null;
$wrapper = new MailerWrapper();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "POST":
		if (Validate::application()) {
			if (Validate::subscription($post)) {
				$command =FactoryCommand::createCommandGetUserByUsername($post->email);
				try{
					$command->execute();
					$user = $command->return();

					//TODO logica de generación de token basado en email
					$passwordToken = FactoryEntity::createPasswordToken(-1,"HKFJRTIIT12212324",$user->id);
					$command = FactoryCommand::createCommandCreatePasswordToken($passwordToken);
					$command->execute();
					$passwordToken = $command->return();
					$wrapper->setFrom()->setTo($user->email, $user->firstName . ' ' . $user->lastName)
						->setSubject('Buscamatch - Recuperar Contraseña')
						->setBody('Para realizar el cambio de contraseña acceda al siguiente enlace'
							.Environment::baseFrontURL().'change-password/'.$passwordToken->token)
						->sendEmail();
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
			}
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(404);
		break;
}

