<?php
require_once "autoload.php";
Tools::headers();
$return = null;
switch ($_SERVER["REQUEST_METHOD"]) {
	case "POST":
		$post = json_decode(file_get_contents("php://input"));
		if (isset($post->user) && !Validate::isEmpty($post->user) && isset($post->password) &&
			!Validate::isEmpty($post->password) && isset($post->origin) && !Validate::isEmpty($post->origin)) {
			try {
				$command = FactoryCommand::createGetOriginByPublicKeyCommand($post->origin);
				$command->execute();
				$origin = $command->return();
				//	Hash the password
				$password = $post->password . Environment::siteKey() . Tools::siteEncrypt($post->password);
				//	Try to get the user
				try {
					$command = FactoryCommand::createGetUserByUsernameCommand(FactoryEntity::createUser(-1, '', '', '',
						$post->user));
					$command->execute();
					$user = $command->return();
					if (!$user->isBlocked() && !$user->isDeleted()) {
						if (Validate::verifyPassword($password, $user->getPassword())){
							$token = Tools::encryptSha256($origin->getPrivateKey());
							$return = new ErrorResponse(true, $origin->getPublicKey());
							ErrorResponse::setResponse();
						}
						else{
							$return = new ErrorResponse(false, [], Values::getText('ERROR_USER_WRONG_PASSWORD'));
							ErrorResponse::setResponse(Values::getValue('ERROR_USER_WRONG_PASSWORD'));
						}
					}
					else{
						$return = new ErrorResponse(false, [], Values::getText('ERROR_USER_BLOCK_DELETED'));
						ErrorResponse::setResponse(Values::getValue('ERROR_USER_BLOCK_DELETED'));
					}
				}
				catch (UserNotFoundException $exception) {
					$return = new ErrorResponse(false, [], Values::getText('ERROR_USER_NOT_FOUND'));
					ErrorResponse::setResponse($exception->getCode());
				}
			}
			catch (DatabaseConnectionException $exception) {
				Logger::exception($exception, Logger::WARNING);
				$return = new ErrorResponse(false, [], Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(false, [], Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				ErrorResponse::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(false, [], Values::getText('ERROR_INCOMPLETE_DATA'));
			ErrorResponse::setResponse(Values::getValue('ERROR_INCOMPLETE_DATA'));
		}
		echo json_encode($return);
		break;
	default:
		ErrorResponse::setResponse(404);
		break;
}
