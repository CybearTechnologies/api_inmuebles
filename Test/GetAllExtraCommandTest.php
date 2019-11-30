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
/**
 * Class GetAllExtraCommandTest
 * @covers GetAllExtraCommand
 */
class GetAllExtraCommandTest extends TestCase {
	private $_command;

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
		}
		catch (DatabaseConnectionException $e) {
		}
		catch (ExtraNotFoundException $e) {
		}
	}

	protected function setUp ():void {
		parent::setUp();
		$this->_command = FactoryCommand::createGetAllExtraCommand();
	}
}
