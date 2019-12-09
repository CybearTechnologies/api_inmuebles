<?php
class DaoUser extends Dao {
	private const QUERY_GET_USER_BY_USERNAME = "SELECT * FROM user WHERE us_email=:username";

	/**
	 * DaoUser constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param string $username
	 *
	 * @return User
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function getUserByUsername (string $username) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_USER_BY_USERNAME);
			$stmt->execute();
			switch ($stmt->rowCount()){
				case 0:
					Throw new UserNotFoundException("The user {$username} doesn't exist.", 404);
					break;
				case 1:
					return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
					break;
				default:
					Throw new MultipleUserException("The user {$username} appear more than one time.", 500);
					break;
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return User
	 */
	protected function extract ($dbObject):User {
		return FactoryEntity::createUser($dbObject->id, $dbObject->first_name, $dbObject->last_name, $dbObject->address,
			$dbObject->email,$dbObject->password,$dbObject->deleted, $dbObject->blocked);
	}
}