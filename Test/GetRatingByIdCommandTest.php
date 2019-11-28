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
require_once __DIR__ . './../src/logic/Rating/GetRatingByIdCommand.php';
/**
 * Class GetRatingByIdCommandTest
 * @covers GetRatingByIdCommand
 */
class GetRatingByIdCommandTest extends TestCase {
	private $_command;
	private $_rating;

	protected function setUp ():void {
		parent::setUp();
		$this->_command = FactoryCommand::createGetRatingByIdCommand(1);
		$this->_rating = FactoryEntity::createRating(1, 4, "Buen trabajo", 1);
	}

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_rating, $this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
		catch (RatingNotFoundException $exception) {
			Logger::exception($exception, Logger::NOTICE);
		}
	}
}
