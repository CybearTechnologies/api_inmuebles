<?php
class DaoRating extends Dao {
	private const QUERY_CREATE = "CALL insertRating(:score,:message,:user,:userCreator,:dateCreated)"; //TODO
	private const QUERY_GET_BY_ID = "CALL getRatingById(:id)";
	private const QUERY_GET_ALL_RATING_BY_USER = "CALL getAllRatingByUser(:id)";
	private const QUERY_DELETE = "CALL deleteRatingById(:id,:user,:dateModified)";
	private const QUERY_GET_ALL = "CALL getAllRating()";
	private const QUERY_UPDATE = "CALL updateRating(:id,:score,:message,:user,:dateModified)";
	private const QUERY_ACTIVE = "";
	private const QUERY_INACTIVE = "";
	private $_entity;

	/**
	 * DaoRating constructor.
	 *
	 * @param Rating $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return Rating
	 * @throws DatabaseConnectionException
	 */
	public function createRating () {
		try {
			$score = $this->_entity->getScore();
			$user = $this->_entity->getUserTarget();
			$message = $this->_entity->getMessage();
			$userCreator = 1; //TODO setear usuario logeado
			$dateCreated = $this->_entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":score", $score, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":message", $message, PDO::PARAM_STR);
			$stmt->bindParam(":userCreator", $userCreator, PDO::PARAM_INT);
			$stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
			$stmt->execute();

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::error($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Rating[]
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function getAllRatingByUser () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL_RATING_BY_USER);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RatingNotFoundException("There are no Rating found", 200);
			else {
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::error($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Rating
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function getRatingById () {
		try {
			$id = $this->_entity->getId();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RatingNotFoundException("Rating found", 404);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::error($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Rating
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function updateRatingById () {
		try {
			$id = $this->_entity->getId();
			$score = $this->_entity->getScore();
			$message = $this->_entity->getMessage();
			$user = 1; // TODO: replace for logged user user modifier
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_UPDATE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":score", $score, PDO::PARAM_STR);
			$stmt->bindParam(":message", $message, PDO::PARAM_STR);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RatingNotFoundException("There are no plans found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Rating
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function activeRatingById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_ACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RatingNotFoundException("There are no rating found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Rating
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function inactiveRatingById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; // TODO: replace for logged user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_INACTIVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RatingNotFoundException("There are no rating found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return Rating
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function deleteRatingById () {
		try {
			$id = $this->_entity->getId();
			$user = 1; //TODO change for log user
			$dateModified = $this->_entity->getDateModified();
			if ($dateModified == "")
				$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RatingNotFoundException("Rating found", 404);

			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
		}
		catch (PDOException $exception) {
			Logger::error($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @return array
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
	public function getAllRating () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new RatingNotFoundException("There are no Rating found", 200);
			else {
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $exception) {
			Logger::error($exception, Logger::ERROR);
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return Rating
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createRating($dbObject->id, $dbObject->score, $dbObject->message,
			$dbObject->userTarget, $dbObject->userCreator, $dbObject->userModifier, $dbObject->dateCreated,
			$dbObject->dateModified, $dbObject->active, $dbObject->delete);
	}
}