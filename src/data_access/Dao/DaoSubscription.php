<?php
class DaoSubscription extends Dao {
	private const QUERY_GET_ALL = "CALL getAllSubscription()";
	private $_entity;
	private const QUERY_CREATE = "CALL createSubscription(:ci, :firstName , :lastName , :address, 
							:passport , :email , :password , :seat , :plan , :location ,
                            :dateCreated )";
	private const QUERY_GET_BY_ID = "CALL getSubscriptionById(:id)";
	private const QUERY_GET_BY_EMAIL = "CALL getSubscriptionByEmail(:email)";
	private const QUERY_DELETE = "CALL deleteSubscription(:id,:user,:dateModified)";
	private const QUERY_APPROVE = "CALL approveSubscription(:id,:user,:dateModified)";

	/**
	 * DaoSubscription constructor.
	 */
	public function __construct () {
		parent::__construct();
	}

	/**
	 * @param Subscription $entity
	 *
	 * @return Subscription
	 * @throws DatabaseConnectionException
	 */
	public function createSubscription ($entity) {
		try {
			$ci = $entity->getCi();
			$firstName = $entity->getFirstName();
			$lastName = $entity->getLastName();
			$address = $entity->getAddress();
			$passport = $entity->getPassport();
			$email = $entity->getEmail();
			$password = $entity->getPassword();
			$seat = $entity->getSeat();
			$plan = $entity->getPlan();
			$location = $entity->getLocation();
			$dateCreated = $entity->getDateCreated();
			if ($dateCreated == "")
				$dateCreated = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_CREATE);
			$stmt->bindParam(":ci", $ci, PDO::PARAM_INT);
			$stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
			$stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
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
		catch (PDOException $exception) {
			Logger::exception($exception, Logger::ERROR);
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
	 */
	public function deleteSubscription (int $id) {
		try {
			$dateModified = null;
			$user = 1;
			$stmt = $this->getDatabase()->prepare(self::QUERY_DELETE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
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
	 * @param int $id
	 *
	 * @return Subscription
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function approveSubscription (int $id) {
		try {
			$userModifier = 1; //TODO change for logged user
			$dateModified = null;
			$stmt = $this->getDatabase()->prepare(self::QUERY_APPROVE);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":user", $userModifier, PDO::PARAM_INT);
			$stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
			$stmt->execute();

			if ($stmt->rowCount() == 0)
				Throw new SubscriptionNotFoundException("There are no Subscription found", 200);
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
	 * @return array
	 * @throws DatabaseConnectionException
	 * @throws SubscriptionNotFoundException
	 */
	public function getAllSubscription () {
		try {
			$stmt = $this->getDatabase()->prepare(self::QUERY_GET_ALL);
			$stmt->execute();
			if ($stmt->rowCount() == 0)
				Throw new SubscriptionNotFoundException("There are no subscription found", 404);
			else
				return $this->extractAll($stmt->fetchAll(PDO::FETCH_OBJ));
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
		return FactoryEntity::createSubscription($dbObject->id, $dbObject->firstName,
			$dbObject-> lastName,$dbObject->address, $dbObject->ci, $dbObject->passport,
			$dbObject->email, $dbObject->password, $dbObject->plan, $dbObject->seat,
			$dbObject->location, $dbObject->status, $dbObject->userModifier,
			$dbObject->userModifier, $dbObject->dateCreated, $dbObject->dateModified,
			$dbObject->active, $dbObject->delete);
	}
}