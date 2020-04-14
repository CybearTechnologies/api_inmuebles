<?php
class DaoSubscriptionDetail extends Dao {
	private const QUERY_CREATE = "CALL createSubscriptionDetail(:subscription_id,
									:document,:dateCreated)";
	private const QUERY_GET_BY_ID = "CALL getSubscriptionDetailById(:id)";
	private const QUERY_GET_BY_SUBSCRIPTION = "CALL getSubscriptionDetailBySubscription(:subscriptionId)";
	private const QUERY_DELETE = "CALL deleteSubscriptionDetail(:id ,:dateModified , :userModified )";

	/**
	 * DaoSubscriptionDetail constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param SubscriptionDetail $entity
	 *
	 * @return SubscriptionDetail
	 * @throws DatabaseConnectionException
	 */
	public function createSubscriptionDetail ($entity) {
		try {
			$document = $entity->getDocument();
			$subscription = $entity->getSubscription();
			$dateCreated = $entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":subscription_id", $subscription, PDO::PARAM_INT);
			$stmt->bindParam(":document", $document, PDO::PARAM_STR);
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
	 * @param int $id
	 *
	 * @return SubscriptionDetail
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionDetailNotFoundException
	 */
	public function getSubscriptionDetailById (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SubscriptionDetailNotFoundException("There are no Location found", 200);
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
	 * @param int $subscription
	 *
	 * @return SubscriptionDetail[]
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionDetailNotFoundException
	 */
	public function getSubscriptionDetailBySubscription (int $subscription) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_SUBSCRIPTION);
			$stmt->bindParam(":subscriptionId", $subscription, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SubscriptionDetailNotFoundException("There are no Location found", 200);
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
	 *
	 * @return SubscriptionDetail
	 * @throws DatabaseConnectionException
	 */
	public function deleteSubscriptionDetail (int $id) {
		try {
			$dateModified = null;
			$user = 1;
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":userModified", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
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
	 * @return SubscriptionDetail
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createSubscriptionDetail($dbObject->id, $dbObject->subscription, $dbObject->document,
			$dbObject->userModifier, $dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified,
			$dbObject->active, $dbObject->delete);
	}
}
