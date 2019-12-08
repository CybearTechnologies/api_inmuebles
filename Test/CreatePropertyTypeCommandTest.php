<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../src/logic/FactoryCommand.php';
require_once __DIR__ . './../src/logic/Command.php';
require_once __DIR__ . './../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../src/data_access/Dao/DaoPropertyType.php';
require_once __DIR__ . './../src/logic/PropertyType/CreatePropertyTypeCommand.php';
class CreatePropertyTypeCommandTest extends TestCase {
	private $_command;
	private $_propertyType;

	protected function setUp ():void {
		parent::setUp();
		$this->_propertyType = FactoryEntity::createPropertyType(-1, "Totona", true);
		$this->_command = FactoryCommand::createPropertyTypeCommand($this->_propertyType);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (PropertyTypeNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (PropetyTypeAlreadyExistException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		$this->assertEquals($this->_propertyType, $this->_command->return());
	}
}
