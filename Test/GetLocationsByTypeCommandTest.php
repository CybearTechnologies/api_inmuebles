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
/**
 * Class GetLocationsByTypeCommandTest
 * @covers GetLocationsByTypeCommand
 */
class GetLocationsByTypeCommandTest extends TestCase {
	private $_command;
	private $_location;

	protected function setUp ():void {
		parent::setUp();
		$this->_location = FactoryEntity::createLocation(-1, '', 'Estado');
		$this->_command = FactoryCommand::createGetLocationsByTypeCommand($this->_location);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
			$this->_command = FactoryCommand::createGetLocationsByTypeCommand($this->_location);
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (LocationNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
