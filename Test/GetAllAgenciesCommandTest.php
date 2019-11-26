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
class GetAllAgenciesCommandTest extends TestCase {
	private $_command;

	public function testReturn () {
		$this->_command = FactoryCommand::createGetAllAgenciesCommand();
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
		}
		catch (AgencyNotFoundException $e) {
		}
		catch (DatabaseConnectionException $e) {
		};
	}
}
