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
					$command = FactoryCommand::createCommandGetUserByUsername(FactoryEntity::createUser(-1, '', '', '',
						$post->user));
					$command->execute();
					$user = $command->return();
					if (!$user->isBlocked() && !$user->isDelete()) {
						if (Validate::verifyPassword($password, $user->getPassword())) {
							$token = Tools::encryptSha256($origin->getPrivateKey());
							$return = $user;
							Tools::setResponse();
						}
						else {
							$return = new ErrorResponse(Values::getText('ERROR_USER_WRONG_PASSWORD'));
							Tools::setResponse(Values::getValue('ERROR_USER_WRONG_PASSWORD'));
						}
					}
					else {
						$return = new ErrorResponse(Values::getText('ERROR_USER_BLOCK_DELETED'));
						Tools::setResponse(Values::getValue('ERROR_USER_BLOCK_DELETED'));
					}
				}
				catch (UserNotFoundException $exception) {
					$return = new ErrorResponse(Values::getText('ERROR_USER_NOT_FOUND'));
					Tools::setResponse($exception->getCode());
				}
				catch (MultipleUserException $exception) {
					$return = new ErrorResponse('ERROR_USER_NOT_FOUND');
					Tools::setResponse($exception->getCode());
				}
			}
			catch (DatabaseConnectionException $exception) {
				Logger::exception($exception, Logger::WARNING);
				$return = new ErrorResponse(Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Tools::setResponse($exception->getCode());
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new ErrorResponse(Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Tools::setResponse($exception->getCode());
			}
		}
		else {
			$return = new ErrorResponse(Values::getText('ERROR_INCOMPLETE_DATA'));
			Tools::setResponse(Values::getValue('ERROR_INCOMPLETE_DATA'));
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(404);
		break;
}
