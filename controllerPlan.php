<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
$mapper = FactoryMapper::createMapperPlan();
$plan = FactoryEntity::createPlan(0);
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		if (isset($get->id) && is_numeric($get->id)) {
			$plan->setId($get->id);
			$command = FactoryCommand::createGetPlanByIdCommand($plan);
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityToDTO($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (PlanNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_PLAN_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		else {
			$command = FactoryCommand::createGetAllPlanCommand();
			try {
				$command->execute();
				$return = new Result(true, $mapper->fromEntityArrayToDTOArray($command->return()));
				Result::setResponse();
			}
			catch (DatabaseConnectionException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_DATABASE"));
				Result::setResponse($exception->getCode());
			}
			catch (PlanNotFoundException $exception) {
				$return = new Result(false, [], Values::getText("ERROR_PLANS_NOT_FOUND"));
				Result::setResponse($exception->getCode());
			}
			echo json_encode($return);
		}
		break;
}