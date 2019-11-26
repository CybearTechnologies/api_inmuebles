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
class GetAgencyByIdCommandTest extends TestCase {
	private $_command;
	private $_agency;

	public function testReturn () {
		$this->_command = FactoryCommand::createGetAgencyByIdCommand(1);
		$this->_agency = FactoryEntity::createAgency(1, "Century21", 1);
		try {
			$this->_command->execute();
			$this->assertEquals($this->_agency, $this->_command->return());
		}
		catch (AgencyNotFoundException $e) {
		}
		catch (DatabaseConnectionException $e) {
		}
		$this->_command->return();
	}
}
