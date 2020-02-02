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
		$this->_propertyType = FactoryEntity::createPropertyType(-1, "fefwtw", 1, 1);
		$this->_command = FactoryCommand::createPropertyTypeCommand($this->_propertyType);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$propertyType = $this->_command->return();
			Environment::database()->exec('DELETE FROM property_type WHERE pt_id =' . $propertyType->getId());
			$this->assertEquals($this->_propertyType->getName(), $propertyType->getName());
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
		catch (PropetyTypeAlreadyExistException $exception) {
			echo $exception->getMessage();
		}
		catch (PropertyTypeNotFoundException $exception) {
			echo $exception->getMessage();
		}
	}
}
