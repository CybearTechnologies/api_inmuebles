<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../src/logic/FactoryCommand.php';
require_once __DIR__ . './../src/logic/Command.php';
require_once __DIR__ . './../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../src/data_access/Dao/DaoSeat.php';
require_once __DIR__ . './../src/logic/Seat/CommandGetAllSeatsByAgency.php';
/**
 * Class GetAllSeatsByAgencyCommandTest
 * @covers CommandGetAllSeatsByAgency
 */
class GetAllSeatsByAgencyCommandTest extends TestCase {
	private $_command;

	protected function setUp ():void {
		parent::setUp();
		$this->_command = FactoryCommand::createCommandGetAllSeatsByAgency(FactoryEntity::createAgency(1));
	}

	public function test () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (SeatNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
