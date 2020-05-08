<?php
class DaoUser extends Dao {
	private const QUERY_CREATE = "CALL getUserById(:firstName,:lastName,:address,:email,:password,:seat,:rol,
	:plan,:location,:userCreator, :userModifier,:dateModified,:dateCreated)";
	private const QUERY_GET_BY_USERNAME = "CALL getUserByEmail(:email)";
	private const QUERY_GET_BY_ID = "CALL getUserById(:id)";
	private const QUERY_DELETE = "CALL deleteUser(:id,:user,:dateModified)";
	private const QUERY_ACTIVE = "CALL activeUser(:id,:user,:dateModified)";
	private const QUERY_INACTIVE = "CALL inactiveUser(:id,:user,:dateModified)";
	private const QUERY_BLOCK = "CALL blockUser(:id,:user,:dateModified)";
	private const QUERY_UNBLOCK = "CALL unblockUser(:id,:user,:dateModified)";
	private const QUERY_GET_ALL = "CALL getAllUsers()";
	private const QUERY_UPDATE = "CALL updateUser(:id,:firstName,:lastName,:address,:email,:password,:seat,:rol,:plan,
	:location,:user,:dateModified)";
	private const QUERY_SET_PLAN = "CALL setUserPlan(:id,:plan,:user,:dateModified)";
	private const QUERY_CHANGE_PASSWORD = "CALL changePassword(:id,:password,:user,:dateModified)";
	private const QUERY_CHANGE_ROL = "CALL changeRol(:id,:rol,:user,:dateModified)";
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
	 */
	public function updateUser () {
		try {
			$id = $this->_entity->getId();
			$firstName = $this->_entity->getFirstName();
			$lastName = $this->_entity->getLastName();
			$address = $this->_entity->getAddress();
			$email = $this->_entity->getEmail();
			$password = $this->_entity->getPassword();
			$seat = $this->_entity->getSeat();
			$rol = $this->_entity->getRol();
			$plan = $this->_entity->getPlan();
			$location = $this->_entity->getLocation();
			$userModifier = 1; /*TODO $this->_entity->getUserModifier();*/
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_UPDATE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
			$stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_INT);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":seat", $seat, PDO::PARAM_INT);
			$stmt->bindParam(":rol", $rol, PDO::PARAM_INT);
			$stmt->bindParam(":plan", $plan, PDO::PARAM_INT);
			$stmt->bindParam(":location", $location, PDO::PARAM_INT);
			$stmt->bindParam(":userModifier", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("Agency not found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return User
	 * @throws DatabaseConnectionException
	 */
	public function createUser () {
		try {
			$firstName = $this->_entity->getFirstName();
			$lastName = $this->_entity->getLastName();
			$address = $this->_entity->getAddress();
			$email = strtolower($this->_entity->getEmail());
			$password = $this->_entity->getPassword();
			$seat = $this->_entity->getSeat();
			$rol = $this->_entity->getRol();
			$plan = $this->_entity->getPlan();
			$location = $this->_entity->getLocation();
			$userCreator = 1; // TODO: replace for logged user
			$userModifier = 1;// TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			$dateCreated = $this->_entity->getDateCreated();
			$nullDate = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
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
			if ($dateCreated != "")
				$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_INT);
			else
				$stmt->bindParam(":dateCreated", $nullDate, PDO::PARAM_STR);
			if ($dateModified != "")
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
	 * @param string $username
	 *
	 * @return User
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function getUserByUsername (string $username) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_USERNAME);
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
	 * @param $id
	 *
	 * @return User
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function getUserById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
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
	 * @return User[]
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function getAllUser () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("No se encontraron usuarios", 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
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
	 */
	public function deleteUser () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("Usuario no encontrado", 404);

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
	 */
	public function activeUser () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("Usuario no encontrado", 404);

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
	 */
	public function inactiveUser () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_INACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("Usuario no encontrado", 404);

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
	 */
	public function blockUser () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_BLOCK);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("Usuario no encontrado", 404);

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
	 */
	public function unblockUser () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$stmt = $this->getDatabase()->prepare(self::QUERY_UNBLOCK);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("Usuario no encontrado", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $user
	 * @param $plan
	 *
	 * @return User
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function setUserPlan ($user, $plan) {
		try {
			$userModifier = 1; // TODO: replace for logged user
			$dateModified = null; //TODO dateModified is null
			$stmt = $this->getDatabase()->prepare(self::QUERY_SET_PLAN);
			$stmt->bindParam(":id", $user, PDO::PARAM_INT);
			$stmt->bindParam(":plan", $plan, PDO::PARAM_INT);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("Usuario no encontrado", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $user
	 * @param $password
	 *
	 * @return User
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function changePassword ($user, $password) {
		try {
			$userModifier = 1; //TODO: replace for logged user
			$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CHANGE_PASSWORD);
			$stmt->bindParam(":id", $user, PDO::PARAM_INT);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("Usuario no encontrado", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param      $id
	 * @param      $rol
	 * @param      $userModifier
	 * @param      $dateModified
	 *
	 * @return User
	 * @throws DatabaseConnectionException
	 * @throws UserNotFoundException
	 */
	public function changeRol ($id, $rol, $userModifier, $dateModified) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_CHANGE_ROL);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":rol", $rol, PDO::PARAM_INT);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new UserNotFoundException("Usuario no encontrado", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch
		(PDOException $exception) {
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
			$dbObject->blocked, $dbObject->delete, $dbObject->seat, $dbObject->rol, $dbObject->plan,
			$dbObject->location, $dbObject->dateCreated, $dbObject->dateModified);
	}
}