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
require_once __DIR__ . './../src/logic/Agency/CreateAgencyCommand.php';
class CreateAgencyCommandTest extends TestCase {
	private $_command;
	private $_agency;

	/**
	 * CreateAgencyCommandTest constructor.
	 *
	 * @param $_command
	 */
	public function setUp ():void {
		$this->_agency = FactoryEntity::createAgency(-1, "Sensation", 1, 0, 1, 1);
		$this->_command = FactoryCommand::createCreateAgencyCommand($this->_agency);
	}

	public function testExecute () {
		try {
			$this->_command->execute();
			$agency = $this->_command->return();
			//GENERATED FIELDS
			$this->_agency->setId($agency->getId());
			$this->_agency->setDateCreated($agency->getDateCreated());
			$this->_agency->setDateModified($agency->getDateModified());
			//	Delete test row
			Environment::database()->exec('DELETE FROM agency WHERE ag_id =' . $agency->getId());
			$this->assertEquals($this->_agency, $agency);
		}
		catch (AgencyAlreadyExistException $exception) {
			echo $exception->getMessage();
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
	}
}
