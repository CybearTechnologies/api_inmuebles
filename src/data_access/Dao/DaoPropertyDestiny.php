<?php
class DaoPropertyDestiny extends Dao {
	private const QUERY_CREATE = "call createPropertyDestiny(:name,:user,:dateCreated)";
	private const QUERY_GET_ALL = "CALL getAllPropertyDestiny()";
	private const QUERY_DELETE_BY_ID = "CALL deletePropertyDestiny(:id,:user)";

	/**
	 * @param String $name
	 * @param int    $user
	 * @param String $dateCreated
	 *
	 * @return Property
	 * @throws DatabaseConnectionException
	 */
	public function createPropertyDestiny (String $name, int $user, String $dateCreated) {
		try {
			if ($dateCreated() == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
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
	 * @return PropertyDestiny[]
	 * @throws DatabaseConnectionException
	 * @throws PropertyDestinyNotFoundException
	 */
	public function getAllPropertyDestiny () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new PropertyDestinyNotFoundException("There are no property found", 404);
			else {
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $id
	 * @param int $user
	 *
	 * @return void
	 * @throws DatabaseConnectionException
	 */
	public function deletePropertyDestiny (int $id, int $user) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->execute();
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}


	/**
	 * @param $dbObject
	 *
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createPropertyDestiny($dbObject->id,$dbObject->name,$dbObject->userCreator,$dbObject->userModifier,$dbObject->dateCreated,
			$dbObject->dateModified,$dbObject->active,$dbObject->delete);
	}
}