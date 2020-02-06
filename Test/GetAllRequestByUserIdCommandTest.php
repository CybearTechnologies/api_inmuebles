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
require_once __DIR__ . './../src/logic/Request/CommandGetAllRequestByUserId.php';
/**
 * Class GetAllRequestByUserIdCommandTest
 * @covers CommandGetAllRequestByPropertyId
 */
class GetAllRequestByUserIdCommandTest extends TestCase {
	private $_command;

	protected function setUp ():void {
		parent::setUp();
		$this->_command = FactoryCommand::createCommandGetAllRequestByUserId(FactoryEntity::createUser(1));
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (RequestNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
