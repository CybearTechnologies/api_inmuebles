<?php
class DaoSubscription extends Dao {
	private $_entity;
	private const QUERY_CREATE = "CALL insertFavorites(:ci,:passport,:email,
                            :password, :seat, :plan, :location,
                            :dateCreated)";
	private const QUERY_GET_BY_ID = "CALL getSubscriptionById(:id)";
	private const QUERY_GET_BY_EMAIL = "CALL getSubscriptionByEmail(:email)";
	private const QUERY_DELETE = "CALL deleteSubscription(:id,:user,:dateModified)";

	/**
	 * DaoSubscription constructor.
	 *
	 * @param Subscription $entity
	 */
	public function __construct ($entity) {
		parent::__construct();
		$this->_entity = $entity;
	}
	/**
	 *
	 * @return Subscription
	 * @throws DatabaseConnectionException
	 */
	public function createSubscription () {
		try {
			$ci = $this->_entity->getCi();
			$passport = $this->_entity->getPassport();
			$email = $this->_entity->getEmail();
			$password = $this->_entity->getPassword();
			$seat = $this->_entity->getSeat();
			$plan = $this->_entity->getPlan();
			$location = $this->_entity->getLocation();
			$dateCreated = $this->_entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":ci", $ci, PDO::PARAM_INT);
			$stmt->bindParam(":passport", $passport, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":seat", $seat, PDO::PARAM_INT);
			$stmt->bindParam(":plan", $plan, PDO::PARAM_INT);
			$stmt->bindParam(":location", $location, PDO::PARAM_INT);
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
	 * @return Subscription
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function getSubscriptionById (int $id) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_ID);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SubscriptionNotFoundException("There are no Subscription found", 200);
			else {
				return $this->extract($stmt->fetch(PDO::FETCH_OBJ));
			}
		}
		catch (PDOException $e) {
			Throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param string $email
	 *
	 * @return Subscription
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function getSubscriptionByEmail (string $email) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_BY_EMAIL);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SubscriptionNotFoundException("There are no Subscription found", 200);
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
	 * @return Subscription
	 * @throws DatabaseConnectionException
	 */
	public function deleteSubscription (int $id, int $user, string $dateModified) {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $id, PDO::PARAM_INT);
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
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		return FactoryEntity::createSubscription($dbObject->id, $dbObject->plan,$dbObject->seat,$dbObject->location,
			$dbObject->ci,$dbObject->passport,$dbObject->email,$dbObject->password,
			$dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified, $dbObject->active,
			$dbObject->delete);
	}
}