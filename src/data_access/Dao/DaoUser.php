<?php
class DaoUser extends Dao {
	private const QUERY_GET_USER_BY_USERNAME = "CALL getUserByEmail(:email)";
	private $_entity;

	/**
	 * DaoUser constructor.
	 *
	 * @param User $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return User
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 * @throws MultipleUserException
	 */
	public function getUserByUsername () {
		try {
			$username = strtolower($this->_entity->getEmail());
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_USER_BY_USERNAME);
			$stmt->bindParam(":email", $username, PDO::PARAM_STR);
			$stmt->execute();
			switch ($stmt->rowCount()) {
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
			$dbObject->email, $dbObject->password, $dbObject->user_created, $dbObject->user_modified, $dbObject->active,
			$dbObject->blocked, $dbObject->deleted, $dbObject->seat, $dbObject->rol, $dbObject->plan,
			$dbObject->location, $dbObject->date_created, $dbObject->date_modified);
	}
}