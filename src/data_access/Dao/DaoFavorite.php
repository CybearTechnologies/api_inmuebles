<?php
class DaoFavorite extends Dao {
	private const QUERY_CREATE = "CALL insertFavorite(:property,:user,:dateCreated)";
	private const QUERY_GET_BY_USER_ID = "CALL getFavoritesByUserId(:id)";
	private const QUERY_DELETE = "CALL deleteFavorite(:id)";
	private $_entity;

	/**
	 * DaoRequest constructor.
	 *
	 * @param Favorite $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 *
	 * @return Favorite
	 * @throws DatabaseConnectionException
	 */
	public function createFavorite () {
		try {
			$property = $this->_entity->getProperty();
			$user = $this->_entity->getUserCreator();
			$dateCreated = $this->_entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":property", $property, PDO::PARAM_INT);
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
	 * @param $userId
	 *
	 * @return Favorite[]
	 * @throws DatabaseConnectionException
	 * @throws FavoriteNotFoundException
	 */
	public function getAllFavoriteByUserId ($userId) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_USER_ID);
			$stmt->bindParam(":id", $userId, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new FavoriteNotFoundException("There are no Favorite found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $userId
	 *
	 * @return Favorite[]
	 * @throws DatabaseConnectionException
	 * @throws FavoriteNotFoundException
	 */
	public function getAllRequestByUserId ($userId) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_USER_ID);
			$stmt->bindParam(":id", $userId, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new FavoriteNotFoundException("There are no Favorite found", 200);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
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
	 * @return Request
	 * @throws DatabaseConnectionException
	 */
	public function deleteFavorite ($id, $user) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
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
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createFavorite($dbObject->id, $dbObject->property, $dbObject->userCreator,
			$dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified, $dbObject->active,
			$dbObject->delete);
	}
}