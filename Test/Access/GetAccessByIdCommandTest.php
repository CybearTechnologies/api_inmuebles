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
require_once __DIR__ . './../../src/logic/Access/GetAccessByIdCommand.php';
class GetAccessByIdCommandTest extends TestCase {
	private $_command;
	private $_access;

	protected function setUp ():void {
		parent::setUp();
		$this->_access = FactoryEntity::createAccess(1, "Usuario - Crear", "us_c",
			1, 1, 1, 1, "2019-11-24 20:40:14", "2019-11-24 20:40:14");
		$this->_command = FactoryCommand::createGetAccessByIdCommand($this->_access);
	}

	public function testExecute () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_access, $this->_command->return());
		}
		catch (AccessNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}