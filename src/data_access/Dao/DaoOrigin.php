<?php
class DaoOrigin extends Dao {
	private const QUERY_GET_BY_PUBLIC_KEY = "CALL getOriginByPublicKey(:key)";
	private $_entity;

	/**
	 * DaoOrigin constructor.
	 *
	 * @param Origin $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}

	/**
	 * @return Origin
	 * @throws DatabaseConnectionException
	 * @throws OriginNotFoundException
	 */
	public function getOriginByPublicKey () {
		try {
			$publicKey = $this->_entity->getPublicKey();
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_PUBLIC_KEY);
			$stmt->bindParam(":key", $publicKey, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new OriginNotFoundException("There are no Origin found", 500);
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
	 * @param $dbObject
	 *
	 * @return Origin
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createOrigin($dbObject->id, $dbObject->name, $dbObject->private_key,
			$dbObject->public_key,
			$dbObject->active);
	}
}