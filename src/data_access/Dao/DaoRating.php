<?php
class DaoRating extends Dao {
	private const QUERY_CREATE = "CALL insertRating(:score,:message,:user)"; //TODO
	private const QUERY_GET_BY_ID = "CALL getRatingById(:id)";
	private const QUERY_GET_ALL_RATING_BY_USER = "CALL getAllRatingByUser(:id)";
	private $_entity;

	/**
	 * DaoRating constructor.
	 *
	 * @param Rating|User $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
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
				Throw new RatingNotFoundException("There are no Rating found", 200);
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
	 * @param $dbObject
	 *
	 * @return Rating
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createRating($dbObject->id, $dbObject->score, $dbObject->message, $dbObject->active);
	}
}