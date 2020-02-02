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
require_once __DIR__ . './../src/logic/PropertyType/GetPropertyTypeByNameCommand.php';
class GetPropertyTypeByNameCommandTest extends TestCase {
	private $_command;
	private $_propertyType;

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_propertyType, $this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (PropertyTypeNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}

	protected function setUp ():void {
		parent::setUp();
		$this->_propertyType = FactoryEntity::createPropertyType(1, "Apartamento", 1, 1);
		$this->_command = FactoryCommand::createGetPropertyTypeByNameCommand($this->_propertyType);
	}
}
