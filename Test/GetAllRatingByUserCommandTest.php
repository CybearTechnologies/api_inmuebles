<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../src/logic/FactoryCommand.php';
require_once __DIR__ . './../src/logic/Command.php';
require_once __DIR__ . './../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../src/data_access/Dao/DaoRating.php';
require_once __DIR__ . './../src/logic/Rating/CommandGetAllRatingByUser.php';
/**
 * Class GetAllRatingByUserCommandTest
 * @covers CommandGetAllRatingByUser
 */
class GetAllRatingByUserCommandTest extends TestCase {
	private $_command;

	protected function setUp ():void {
		parent::setUp();
		$this->_command = FactoryCommand::createCommandGetAllRatingByUser(FactoryEntity::createUser(1));
	}
	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (RatingNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
