<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../src/logic/FactoryCommand.php';
require_once __DIR__ . './../src/logic/Command.php';
require_once __DIR__ . './../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../src/data_access/Dao/DaoAgency.php';
require_once __DIR__ . './../src/logic/Agency/GetAgencyByIdCommand.php';
/**
 * Class GetAgencyByIdCommandTest
 * @covers GetAgencyByIdCommand
 */
class GetAgencyByIdCommandTest extends TestCase {
	private $_command;
	private $_agency;

	protected function setUp ():void {
		parent::setUp();
		$this->_agency = FactoryEntity::createAgency(1, "Century21", 1);
		$this->_command = FactoryCommand::createGetAgencyByIdCommand($this->_agency);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_agency, $this->_command->return());
		}
		catch (AgencyNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		$this->_command->return();
	}
}
