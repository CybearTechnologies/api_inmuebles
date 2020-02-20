<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperAgency();
$mapperSeat = FactoryMapper::createMapperSeat();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::id($get)) {
			$agency = FactoryEntity::createAgency($get->id);
			$command = FactoryCommand::createCommandGetAgencyById($agency);
			try {
				$command->execute();
				$dto = $mapper->fromEntityToDTO($command->return());
				if (empty($dto->seats)) {
					$command = FactoryCommand::createCommandGetAllSeatsByAgency($agency);
					try {
						$command->execute();
						$dto->seats = $mapperSeat->fromEntityArrayToDtoArray($command->return());
					}
					catch (SeatNotFoundException $exception) {
						unset($dto->seats);
					}
				}
				$return = $dto;
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (AgencyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createCommandGetAllAgencies();
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (AgencyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_AGENCIES_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_AGENCIES_NOT_FOUND"));
			}
			echo json_encode($return);
		}
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::agency($post)) {
			$command = FactoryCommand::createCommandCreateAgency($mapper->fromDtoToEntity($post));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (AgencyAlreadyExistException $exception) {
				$return = new ErrorResponse(Values::getText('ERROR_AGENCY_ALREADY_EXIST'));
				Tools::setResponse(Values::getValue('ERROR_AGENCY_ALREADY_EXIST'));
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText('ERROR_DATABASE'));
				Tools::setResponse(Values::getValue('ERROR_DATABASE'));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	case "DELETE":
		if (Validate::id($get)) {
			$command = FactoryCommand::createCommandDeleteAgencyById(FactoryEntity::createAgency($get->id));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (AgencyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	case "PUT":
		$put = json_decode(file_get_contents('php://input'));
		if (Validate::putAgency($put)) {
			$command = FactoryCommand::createCommandUpdateAgencyById($mapper->fromDtoToEntity($put));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (AgencyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "active") {
			$command = FactoryCommand::createCommandActiveAgencyById(FactoryEntity::createAgency($get->id));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (AgencyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && isset($get->action) && strtolower($get->action) == "inactive") {
			$command = FactoryCommand::createCommandInactiveAgencyById(FactoryEntity::createAgency($get->id));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (AgencyNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_AGENCY_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_AGENCY_NOT_FOUND"));
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
		}
		else {
			$return = new ErrorResponse(Values::getText("ERROR_DATA_INCOMPLETE"));
			Tools::setResponse(Values::getValue("ERROR_DATA_INCOMPLETE"));
		}
		echo json_encode($return);
		break;
	default:
		Tools::setResponse(405);
		break;
}