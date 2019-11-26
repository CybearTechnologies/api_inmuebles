<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../src/logic/FactoryCommand.php';
require_once __DIR__ . './../src/logic/Command.php';
require_once __DIR__ . './../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../src/data_access/Dao/DaoLocation.php';
require_once __DIR__ . './../src/logic/Location/GetLocationByIdCommand.php';
class GetLocationByIdCommandTest extends TestCase {
	private $_command;
	private $_location;

	public function testReturn () {
		$this->_command = FactoryCommand::createGetLocationByIdCommand(16);
		$this->_location = FactoryEntity::createLocation(16, "Monagas", "Estado");
		try {
			$this->_command->execute();
			$this->assertEquals($this->_location, $this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (LocationNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
