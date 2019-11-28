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
require_once __DIR__ . './../src/logic/Seat/GetAllSeatsByAgencyCommand.php';
/**
 * Class GetAllSeatsByAgencyCommandTest
 * @covers GetAllSeatsByAgencyCommand
 */
class GetAllSeatsByAgencyCommandTest extends TestCase {
	private $_commandToTest;

	protected function setUp ():void {
		parent::setUp();
		$this->_commandToTest = FactoryCommand::createGetAllSeatsByAgencyCommand(1);
	}

	public function test () {
		try {
			$this->_commandToTest->execute();
			$this->assertNotEmpty($this->_commandToTest->return(), 'This agency has seats!');
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (SeatNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
