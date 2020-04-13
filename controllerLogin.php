<?php
require_once "vendor/autoload.php";
Tools::headers();
$headers = apache_request_headers();
$return = null;
switch ($_SERVER["REQUEST_METHOD"]) {
	case "POST":
		$post = json_decode(file_get_contents("php://input"));
		if (isset($post->user) && !Validate::isEmpty($post->user) && isset($post->password) &&
			!Validate::isEmpty($post->password) && isset($headers['Application'])) {
			try {
				$command = FactoryCommand::createCommandGetOriginByPublicKey(FactoryEntity::createOrigin(-1, '', '',
					$headers['Application']));
				$command->execute();
				$origin = $command->return();
				//	Hash the password
				$password = $post->password . Environment::siteKey() . Tools::siteEncrypt($post->password);
				//	Try to get the user
				try {
					$command = FactoryCommand::createCommandGetUserByUsername($post->user);
					$command->execute();
					$user = $command->return();
					if (!$user->blocked && !$user->delete) {
						if (Validate::verifyPassword($password, $user->password)) {
							$token = Auth::generateJWT($user->id, $origin->getPrivateKey());
							$return = FactoryDto::createDtoLogin($user, $token);
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
			$return = new ErrorResponse(Values::getText('ERROR_DATA_INCOMPLETE'));
			Tools::setResponse(Values::getValue('ERROR_DATA_INCOMPLETE'));
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(404);
		break;
}
