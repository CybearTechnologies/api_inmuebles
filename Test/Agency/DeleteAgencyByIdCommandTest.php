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
require_once __DIR__ . './../../src/logic/Agency/CommandDeleteAgencyById.php';
/**
 * Class DeleteAgencyByIdCommandTest
 * @covers CommandDeleteAgencyById
 */
class DeleteAgencyByIdCommandTest extends TestCase {
	private $_command;
	private $_agency;

	public function testExecute () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
			$this->_command = FactoryCommand::createCommandDeleteAgencyById($this->_command->return());
			$this->_command->execute();
			$this->_agency = $this->_command->return();
			$this->assertEquals(true, $this->_agency->isDelete());
		}
		catch (AgencyAlreadyExistException $exception) {
			echo $exception->getMessage();
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
	}

	protected function setUp ():void {
		parent::setUp();
		$this->_agency = FactoryEntity::createAgency(1, "Keviniano", 1, 0, 1, 1);
		$this->_command = FactoryCommand::createCommandCreateAgency($this->_agency);
	}

	protected function tearDown ():void {
		parent::tearDown();
		Environment::database()->exec('DELETE FROM agency WHERE ag_id =' . $this->_agency->getId());
	}
}
