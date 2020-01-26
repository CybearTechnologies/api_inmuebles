<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperAgency();
$mapperSeat = FactoryMapper::createMapperSeat();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$agency = FactoryEntity::createAgency($get->id);
			$command = FactoryCommand::createGetAgencyByIdCommand($agency);
			try {
				$command->execute();
				$dto = $mapper->fromEntityToDTO($command->return());
				if (isset($get->seats)) {
					$command = FactoryCommand::createGetAllSeatsByAgencyCommand($agency);
					try {
						$command->execute();
						$dto->seats = $mapperSeat->fromEntityArrayToDtoArray($command->return());
					}
					catch (SeatNotFoundException $exception) {
						unset($dto->seats);
					}
				}
				else
					unset($dto->seats);
				$return = new ErrorResponse(true, $dto);
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (AgencyNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_AGENCY_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllAgenciesCommand();
			try {
				$command->execute();
				$return = new ErrorResponse(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				ErrorResponse::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_DATABASE"));
				ErrorResponse::setResponse($exception->getCode());
			}
			catch (AgencyNotFoundException $exception) {
				$return = new ErrorResponse(false, [], Values::getText("ERROR_AGENCIES_NOT_FOUND"));
				ErrorResponse::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}