<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../../vendor/autoload.php';
require_once __DIR__ . './../../src/logic/FactoryCommand.php';
require_once __DIR__ . './../../src/logic/Command.php';
require_once __DIR__ . './../../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../../src/data_access/Dao/DaoAccess.php';
require_once __DIR__ . './../../src/logic/Access/CommandCreateAccess.php';
class CreateAccessCommandTest extends TestCase {
	private $_command;
	private $_access;

	public function testExecute () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
			$this->_access = $this->_command->return();
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
		catch (AccessAlreadyExistException $exception) {
			echo $exception->getMessage();
		}
	}

	protected function setUp ():void {
		parent::setUp();
		$this->_access = FactoryEntity::createAccess(-1, "Acceder a Google", "AC-GO");
		$this->_command = FactoryCommand::createCommandCreateAccess($this->_access);
	}

	protected function tearDown ():void {
		parent::tearDown();
		Environment::database()->exec('DELETE FROM access WHERE ac_id =' . $this->_access->getId());
	}
}
