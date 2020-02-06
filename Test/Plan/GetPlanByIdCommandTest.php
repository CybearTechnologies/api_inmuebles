<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../../vendor/autoload.php';
require_once __DIR__ . './../../src/logic/FactoryCommand.php';
require_once __DIR__ . './../../src/logic/Command.php';
require_once __DIR__ . './../../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../../src/data_access/Dao/DaoPlan.php';
require_once __DIR__ . './../../src/logic/Plan/CommandGetAllPlan.php';
/**
 * Class GetPlanByIdCommandTest
 * @covers CommandGetPlanById
 */
class GetPlanByIdCommandTest extends TestCase {
	private $_command;
	private $_plan;

	protected function setUp ():void {
		parent::setUp();
		$this->_plan = FactoryEntity::createPlan(3);
		$this->_command = FactoryCommand::createCommandGetPlanById($this->_plan);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
		catch (PlanNotFoundException $exception) {
			echo $exception->getMessage();
		}
	}
}
