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
require_once __DIR__ . './../../src/logic/Access/GetAccessByAbbreviationCommand.php';
class GetAccessByAbbreviationCommandTest extends TestCase {
	private $_command;
	private $_access;

	protected function setUp ():void {
		parent::setUp();
		$this->_access = FactoryEntity::createAccess(1, "Usuario - Crear", "us_c", 1, 0, 1, 1, "2020-01-19 20:04:49",
			"2020-01-19 20:04:49");
		$this->_command = FactoryCommand::createGetAccessByAbbreviationCommand($this->_access);
	}

	public function testExecute () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_access, $this->_command->return());
		}
		catch (AccessNotFoundException $exception) {
			echo $exception->getMessage();
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
	}
}
