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
				$return = new Result(true, $dto);
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (AgencyNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_AGENCY_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllAgenciesCommand();
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (AgencyNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_AGENCIES_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}