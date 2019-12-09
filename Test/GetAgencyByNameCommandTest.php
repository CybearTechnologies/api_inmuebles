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
require_once __DIR__ . './../src/logic/Agency/GetAgencyByNameCommand.php';
class GetAgencyByNameCommandTest extends TestCase {
	private $_command;
	private $_agency;

	public function testExecute () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_agency, $this->_command->return());
		}
		catch (AgencyNotFoundException $exception) {
			echo $exception->getMessage();
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
	}

	protected function setUp ():void {
		parent::setUp();
		$this->_agency = FactoryEntity::createAgency(1, "Century21", 1, 0, 1, 1, "2019-11-24 20:40:14",
			"2019-11-24 20:40:14");
		$this->_command = FactoryCommand::createGetAgencyByNameCommand($this->_agency);
	}
}
