<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../src/logic/FactoryCommand.php';
require_once __DIR__ . './../src/logic/Command.php';
require_once __DIR__ . './../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../src/data_access/Dao/DaoPlan.php';
require_once __DIR__ . './../src/logic/Plan/GetAllPlanCommand.php';
/**
 * Class GetPlanByIdCommandTest
 * @covers GetPlanByIdCommand
 */
class GetPlanByIdCommandTest extends TestCase {
	private $_command;
	private $_plan;

	protected function setUp ():void {
		parent::setUp();
		$this->_command = FactoryCommand::createGetPlanByIdCommand(3);
		$this->_plan = FactoryEntity::createPlan(3, "Premium", 15, 1);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_plan, $this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (PlanNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
