 <?php
require_once "vendor/autoload.php";
Tools::headers();
$get = Tools::getObject();
$post = Tools::postObject();
$headers = apache_request_headers();
$return = null;
$mapper = FactoryMapper::createMapperFavorite();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				$command = FactoryCommand::createCommandGetAllFavoriteByUserId($loggedUser);
				try {
					$command->execute();
					$return = $command->return();
					Tools::setResponse();
				}
				catch (DatabaseConnectionException $e) {
					$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
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
		if (Validate::headers()) {
			try {
				$loggedUser = Tools::getUserLogged($headers[Values::BEARER_HEADER],
					$headers[Values::APPLICATION_HEADER]);
				$post = json_decode(file_get_contents('php://input'));
				if (Validate::favorite($post)) {
					$command = FactoryCommand::createCommandCreateFavorite($post->property, $loggedUser);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
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
				$put = json_decode(file_get_contents('php://input'));
				if (Validate::id($put)) {
					$command = FactoryCommand::createCommandDeleteFavorite($put->id, $loggedUser);
					try {
						$command->execute();
						$return = $command->return();
						Tools::setResponse();
					}
					catch (DatabaseConnectionException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
						Tools::setResponse(Values::getValue("ERROR_DATABASE"));
					}
					catch (FavoriteNotFoundException $e) {
						$return = new ErrorResponse(Values::getText("ERROR_FAVORITE_NOT_FOUND"));
						Tools::setResponse(Values::getValue("ERROR_FAVORITE_NOT_FOUND"));
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
	default:
		Tools::setResponse(405);
		break;
}