<?php
class DaoPasswordToken extends Dao {
	private const QUERY_CREATE_PASSWORD_TOKEN = "CALL createPasswordToken(:token,:userCreator,:dateCreated)";
	private const QUERY_GET_BY_ID = "CALL getPasswordTokenById(:id)";
	private const QUERY_GET_BY_USER_ID = "CALL getAccessById(:userId)";
	private const QUERY_DELETE_BY_ID = "CALL deletePasswordToken(:id)";

	/**
	 * DaoAccess constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param $token
	 * @param $userCreator
	 * @param $dateCreated
	 *
	 * @return Access
	 * @throws DatabaseConnectionException
	 */
	public function createPasswordToken ($token, $userCreator, $dateCreated) {
		try {
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE_PASSWORD_TOKEN);
			$stmt->bindParam(":token", $token, PDO::PARAM_STR);
			$stmt->bindParam(":userCreator", $userCreator, PDO::PARAM_INT);
			$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $userId
	 *
	 * @return Access
	 * @throws DatabaseConnectionException
	 * @throws PasswordTokenNotFoundException
	 */
	public function getTokenPasswordByUserId ($userId) {
		try {
			$abbreviation = strtolower($this->_entity->getAbbreviation());
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_USER_ID);
			$stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PasswordTokenNotFoundException("There are no acces with this '{$abbreviation}' found", 404);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return Access
	 * @throws DatabaseConnectionException
	 * @throws PasswordTokenNotFoundException
	 */
	public function getPasswordTokenById ($id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PasswordTokenNotFoundException("There are no access found", 404);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 *
	 * @return Access
	 * @throws DatabaseConnectionException
	 * @throws PasswordTokenNotFoundException
	 */
	public function deletePasswordTokenById (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PasswordTokenNotFoundException("There are no access found", 404);
			else
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
	 * @return Access
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createAccess($dbObject->id, $dbObject->name, $dbObject->abbreviation,
			$dbObject->userCreator, $dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified,
			$dbObject->active, $dbObject->delete);
	}
}