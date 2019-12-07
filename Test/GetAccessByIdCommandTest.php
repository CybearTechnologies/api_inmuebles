<?php

use PHPUnit\Framework\TestCase;

class GetAccessByIdCommandTest extends TestCase {
	private $_command;
	private $_access;

	protected function setUp ():void {
		parent::setUp();
		$this->_access = FactoryEntity::createAccess(1, "Usuario - Crear", "us_c",
			"UNKNOW", "UNKNOW");
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