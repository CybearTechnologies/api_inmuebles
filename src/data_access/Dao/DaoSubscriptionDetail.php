<?php
class DaoSubscriptionDetail extends Dao {
	private $_entity;
	private const QUERY_CREATE = "CALL createSubscriptionDetail(:subscription_id,
									:document,:dateCreated)";
	private const QUERY_GET_BY_ID = "CALL getSubscriptionDetailById(:id)";
	private const QUERY_GET_BY_SUBSCRIPTION = "CALL getSubscriptionDetailBySubscription(:subscriptionId)";
	private const QUERY_DELETE = "CALL deleteSubscriptionDetail(:id ,:dateModified , :userModified )";

	/**
	 * DaoSubscriptionDetail constructor.
	 *
	 * @param SubscriptionDetail $_entity
	 */
	public function __construct ($_entity) {
		parent::__construct();
		$this->_entity = $_entity;
	}

	/**
	 *
	 * @return SubscriptionDetail
	 * @throws DatabaseConnectionException
	 */
	public function createSubscriptionDetail () {
		try {
			$document = $this->_entity->getDocument();
			$subscription = $this->_entity->getSubscription();
			$dateCreated = $this->_entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":subscription_id", $subscription, PDO::PARAM_INT);
			$stmt->bindParam(":document", $document, PDO::PARAM_INT);
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
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int $subscription
	 *
	 * @return SubscriptionDetail
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
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int    $id
	 * @param int    $user
	 * @param string $dateModified
	 *
	 * @return SubscriptionDetail
	 * @throws DatabaseConnectionException
	 */
	public function deleteSubscriptionDetail (int $id,int $user, string $dateModified) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":userModified", $user, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();
			return $this->extract($stmt->fetch(PDO::FETCH_OBJ));

		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return SubscriptionDetail
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createSubscriptionDetail($dbObject->id,$dbObject->subscription,
			$dbObject->document,$dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified,
			$dbObject->active, $dbObject->delete);
	}
}
