<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../src/logic/FactoryCommand.php';
require_once __DIR__ . './../src/logic/Command.php';
require_once __DIR__ . './../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../src/data_access/Dao/DaoExtra.php';
require_once __DIR__ . './../src/logic/Extra/GetAllExtraCommand.php';
class GetExtraByIdCommandTest extends TestCase {
	private $_command;
	private $_extra;

	public function testReturn () {
		$this->_command = FactoryCommand::createGetExtraByIdCommand(1);
		$this->_extra = FactoryEntity::createExtra(1, "Piso", 1);
		try {
			$this->_command->execute();
			$this->assertEquals($this->_extra, $this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (ExtraNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
