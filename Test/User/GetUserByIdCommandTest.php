<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../../vendor/autoload.php';
require_once __DIR__ . './../../src/logic/FactoryCommand.php';
require_once __DIR__ . './../../src/logic/Command.php';
require_once __DIR__ . './../../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../../src/data_access/Dao/DaoUser.php';
require_once __DIR__ . './../../src/logic/User/CommandGetUserById.php';
class GetUserByIdCommandTest extends TestCase {
	private $_command;
	private $_user;

	public function testExecute () {
		try {
			$this->_command->execute();
			$this->assertEquals($this->_user, $this->_command->return());
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
		catch (MultipleUserException $exception) {
			echo $exception->getMessage();
		}
		catch (UserNotFoundException $exception) {
			echo $exception->getMessage();
		}
	}

	protected function setUp ():void {
		parent::setUp();
		$this->_user = FactoryEntity::createUser(2, "Ramiro", "Vargas", "La candelaria", "ramiroavch@gmail.com",
			"123456", 1, 1, 1, 0, 0, 1, 1, 1, 1, "2019-11-24 20:40:37", "2019-11-24 20:40:37");
		$this->_command = FactoryCommand::createCommandGetUserById($this->_user);
	}
}
