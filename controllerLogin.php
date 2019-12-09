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
							$return = new Result(true, $origin->getPublicKey());
							Result::setResponse();
						}
						else{
							$return = new Result(false, [], Values::getText('ERROR_USER_WRONG_PASSWORD'));
							Result::setResponse(Values::getValue('ERROR_USER_WRONG_PASSWORD'));
						}
					}
					else{
						$return = new Result(false, [], Values::getText('ERROR_USER_BLOCK_DELETED'));
						Result::setResponse(Values::getValue('ERROR_USER_BLOCK_DELETED'));
					}
				}
				catch (UserNotFoundException $exception) {
					$return = new Result(false, [], Values::getText('ERROR_USER_NOT_FOUND'));
					Result::setResponse($exception->getCode());
				}
			}
			catch (DatabaseConnectionException $exception) {
				Logger::exception($exception, Logger::WARNING);
				$return = new Result(false, [], Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Result::setResponse($exception->getCode());
			}
			catch (OriginNotFoundException $exception) {
				Logger::exception($exception, Logger::ERROR);
				$return = new Result(false, [], Values::getText('ERROR_ORIGIN_NOT_FOUND'));
				Result::setResponse($exception->getCode());
			}
		}
		else {
			$return = new Result(false, [], Values::getText('ERROR_INCOMPLETE_DATA'));
			Result::setResponse(Values::getValue('ERROR_INCOMPLETE_DATA'));
		}
		echo json_encode($return);
		break;
	default:
		Result::setResponse(404);
		break;
}
