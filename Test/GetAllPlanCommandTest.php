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
class GetAllPlanCommandTest extends TestCase {
	private $_command;

	public function testReturn () {
		$this->_command = FactoryCommand::createGetAllPlanCommand();
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (PlanNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
