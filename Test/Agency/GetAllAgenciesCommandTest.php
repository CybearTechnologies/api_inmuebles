<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../../vendor/autoload.php';
require_once __DIR__ . './../../src/logic/FactoryCommand.php';
require_once __DIR__ . './../../src/logic/Command.php';
require_once __DIR__ . './../../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../../src/data_access/Dao/DaoAgency.php';
require_once __DIR__ . './../../src/logic/Agency/GetAgencyByIdCommand.php';
/**
 * Class GetAllAgenciesCommandTest
 * @covers GetAllAgenciesCommand
 */
class GetAllAgenciesCommandTest extends TestCase {
	private $_command;

	protected function setUp ():void {
		parent::setUp();
		$this->_command = FactoryCommand::createGetAllAgenciesCommand();
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
		}
		catch (AgencyNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		};
	}
}
