<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../src/logic/FactoryCommand.php';
require_once __DIR__ . './../src/logic/Command.php';
require_once __DIR__ . './../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../src/data_access/Dao/DaoRequest.php';
require_once __DIR__ . './../src/logic/Request/GetRequestByIdCommand.php';
/**
 * Class GetRequestByIdCommandTest
 * @covers GetRequestByIdCommand
 */
class GetRequestByIdCommandTest extends TestCase {
	private $_command;
	private $_request;

	protected function setUp ():void {
		parent::setUp();
		$this->_command = FactoryCommand::createGetRequestByIdCommand(1);
		$this->_request = FactoryEntity::createRequest(1, "2019-11-24 00:00:00", 1);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_request, $this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (RequestNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
