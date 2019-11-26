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
require_once __DIR__ . './../src/logic/Seat/GetAllSeatsCommand.php';
class GetAllSeatsCommandTest extends TestCase {
	private $_command;

	public function testReturn () {
		$this->_command = FactoryCommand::createGetAllSeatCommand();
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
