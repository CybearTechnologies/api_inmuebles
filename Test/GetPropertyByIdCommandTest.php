<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../src/logic/FactoryCommand.php';
require_once __DIR__ . './../src/logic/Command.php';
require_once __DIR__ . './../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../src/data_access/Dao/DaoProperty.php';
require_once __DIR__ . './../src/logic/Property/GetPropertyByIdCommand.php';
/**
 * Class GetPropertyByIdCommandTest
 * @covers GetPropertyByIdCommand
 */
class GetPropertyByIdCommandTest extends TestCase {
	private $_command;
	private $_property;

	protected function setUp ():void {
		parent::setUp();
		$this->_property = FactoryEntity::createProperty(1, "Apartamento en los palos grandes", 125.23,
			"bonito apartamento", "2019-11-24 00:00:00", 1, 0);
		$this->_command = FactoryCommand::createGetPropertyByIdCommand($this->_property);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_property, $this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (PropertyNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
