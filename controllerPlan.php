<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperPlan();
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (Validate::id($get)) {
			$command = FactoryCommand::createCommandGetPlanById(FactoryEntity::createPlan($get->id));
			try {
				$command->execute();
				$return = $command->return();
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PlanNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PLAN_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PLAN_NOT_FOUND"));
			}
			catch (CustomException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createCommandGetAllPlan();
			try {
				$command->execute();
				$return = $mapper->fromEntityArrayToDTOArray($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PlanNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PLANS_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PLANS_NOT_FOUND"));
			}
			echo json_encode($return);
		}
		break;
	case "POST":
		$post = json_decode(file_get_contents('php://input'));
		if (Validate::plan($post)) {
			$command = FactoryCommand::createCommandCreatePlan($mapper->fromDtoToEntity($post));
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PlanAlreadyExistException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PLAN_ALREADY_EXIST"));
				Tools::setResponse(Values::getValue("ERROR_PLAN_ALREADY_EXIST"));
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
			$plan = FactoryEntity::createPlan($get->id);
			$command = FactoryCommand::createCommandDeletePlanById($plan);
			try {
				$command->execute();
				$return = $mapper->fromEntityToDto($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PlanNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PLAN_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PLAN_NOT_FOUND"));
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
		if (Validate::putPlan($put)) {
			try {
				$command = FactoryCommand::createCommandUpdatePlanById($mapper->fromDtoToEntity($put));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PlanNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PLAN_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PLAN_NOT_FOUND"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "active") {
			try {
				$command = FactoryCommand::createCommandActivePlanById(FactoryEntity::createPlan($get->id));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PlanNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PLAN_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PLAN_NOT_FOUND"));
			}
		}
		elseif (isset($get->id) && is_numeric($get->id) && strtolower($get->action) == "inactive") {
			try {
				$command = FactoryCommand::createCommandInactivePlanById(FactoryEntity::createPlan($get->id));
				$command->execute();
				$return = $mapper->fromEntityToDTO($command->return());
				Tools::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
				Tools::setResponse(Values::getValue("ERROR_DATABASE"));
			}
			catch (PlanNotFoundException $exception) {
				$return = new ErrorResponse(Values::getText("ERROR_PLAN_NOT_FOUND"));
				Tools::setResponse(Values::getValue("ERROR_PLAN_NOT_FOUND"));
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