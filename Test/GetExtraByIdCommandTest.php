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
require_once __DIR__ . './../src/logic/Extra/CommandGetAllExtra.php';
/**
 * Class GetExtraByIdCommandTest
 * @covers CommandGetExtraById
 */
class GetExtraByIdCommandTest extends TestCase {
	private $_command;
	private $_extra;

	protected function setUp ():void {
		parent::setUp();
		$this->_extra = FactoryEntity::createExtra(1, "Piso", 1);
		$this->_command = FactoryCommand::createGetExtraByIdCommand($this->_extra);
	}

	public function testReturn () {
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
