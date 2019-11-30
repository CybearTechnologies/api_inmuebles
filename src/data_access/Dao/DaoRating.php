<?php
class DaoRating extends Dao
{
    private const QUERY_CREATE = "";
	private const QUERY_GET_ALL_BY_USER = "CALL getAllRatingByUser(:id)";
	private const QUERY_GET_BY_ID = "CALL getRatingById(:id)";


    /**
     * @param $id
     * @return Rating
     * @throws DatabaseConnectionException
     * @throws RatingNotFoundException
     */
    public function getRatingById ($id) {
        try {
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
        	Logger::error($exception,Logger::ERROR);
            Throw new DatabaseConnectionException("Database connection problem.", 500);
        }
    }

	/**
	 * @param $id
	 *
	 * @return Rating[]
	 * @throws DatabaseConnectionException
	 * @throws RatingNotFoundException
	 */
    public function getAllRatingByUser ($id) {
        try {
            $stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL_BY_USER);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() == 0)
                Throw new RatingNotFoundException("There are no Rating found", 200);
            else {
                return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
            }
        }
        catch (PDOException $exception) {
			Logger::error($exception,Logger::ERROR);
            Throw new DatabaseConnectionException("Database connection problem.", 500);
        }
    }
    /**
     * @param $dbObject
     *
     * @return Entity
     */
    protected function extract($dbObject)
    {
        return FactoryEntity::createRating($dbObject->id,$dbObject->score,$dbObject->message,$dbObject->active);
    }
}