<?php
class DaoUser extends Dao {
	private const QUERY_CREATE_USER = "CALL getUserById(:firstName,:lastName,:address,:email,:password,:seat,:rol,
	:plan,:location,:userCreator, :userModifier,:dateModified,:dateCreated)";
	private const QUERY_GET_USER_BY_USERNAME = "CALL getUserByEmail(:email)";
	private const QUERY_GET_USER_BY_ID = "CALL getUserById(:id)";
	private const QUERY_DELETE_USER = "CALL deleteUser(:id,:user)";
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
	 */
	public function createUser () {
		try {
			$firstName= $this->_entity->getFirstName();
			$lastName=$this->_entity->getLastName();
			$address = $this->_entity->getAddress();
			$email = $this->_entity->getEmail();
			$password = $this->_entity->getPassword();
			$seat = $this->_entity->getSeat();
			$rol = $this->_entity->getRol();
			$plan = $this->_entity->getPlan();
			$location = $this->_entity->getLocation();
			$userCreator = $this->_entity->getUserCreator();
			$userModifier = $this->_entity->getUserModifier();
			$dateModified = $this->_entity->getDateModified();
			$dateCreated = $this->_entity->getDateCreated();
			$nullDate=null;
			$username = strtolower($this->_entity->getEmail());
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE_USER);
			$stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
			$stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":seat", $seat, PDO::PARAM_INT);
			$stmt->bindParam(":rol", $rol, PDO::PARAM_INT);
			$stmt->bindParam(":plan", $plan, PDO::PARAM_INT);
			$stmt->bindParam(":location", $location, PDO::PARAM_INT);
			$stmt->bindParam(":userCreator", $userCreator, PDO::PARAM_INT);
			$stmt->bindParam(":userModifier", $userModifier, PDO::PARAM_INT);
			if($dateCreated!="")
				$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_INT);
			else
				$stmt->bindParam(":dateCreated", $nullDate, PDO::PARAM_STR);
			if($dateModified!="")
				$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_INT);
			else
				$stmt->bindParam(":dateModified", $nullDate
					, PDO::PARAM_INT);
			$stmt->bindParam(":rol", $rol, PDO::PARAM_INT);
			$stmt->execute();
			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));

		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
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
	 * @return User
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 * @throws MultipleUserException
	 */
	public function getUserById () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_USER_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			switch ($stmt->rowCount()) {
				case 0:
					Throw new UserNotFoundException("The user {$id} doesn't exist.", 404);
					break;
				case 1:
					return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
					break;
				default:
					Throw new MultipleUserException("The user {$id} appear more than one time.", 500);
					break;
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return User
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function DeleteUser () {
		try {
			$id = $this->_entity->getId();
			$user= $this->_entity->getUserModifier();
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_USER);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();
			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
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
			$dbObject->email, $dbObject->password, $dbObject->userCreator, $dbObject->userModifier, $dbObject->active,
			$dbObject->blocked, $dbObject->deleted, $dbObject->seat, $dbObject->rol, $dbObject->plan,
			$dbObject->location, $dbObject->dateCreated, $dbObject->dateModified);
	}
}