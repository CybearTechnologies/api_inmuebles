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
require_once __DIR__ . './../src/logic/Seat/GetSeatByIdCommand.php';
/**
 * Class GetSeatByIdCommandTest
 * @covers GetSeatByIdCommand
 */
class GetSeatByIdCommandTest extends TestCase {
	private $_command;
	private $_seat;

	protected function setUp ():void {
		parent::setUp();
		$this->_seat = FactoryEntity::createSeat(1, "C21 Los palos grandes", "J-12306151", 1);
		$this->_command = FactoryCommand::createGetSeatByIdCommand($this->_seat);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_seat, $this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (SeatNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
