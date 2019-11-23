<?php
/**
 * Created by Kevin Martinez
 * Date: 22-Nov-19
 * Time: 9:24 PM
 */
class DaoLog extends Dao {
	private $_pdo;
	private const QUERY_REGISTER_CREATE = "CALL insertCreate(:user, :table, :object);";
	private const QUERY_REGISTER_UPDATE = "CALL insertUpdate(:user, :table, :object_before, :object_after);";
	private const QUERY_REGISTER_DELETE = "CALL insertDelete(:user, :table, :object);";

	public function __construct () {
		parent::__construct();
		$PDO = new PDO("mysql:host=localhost;dbname=houstonlog", "root", "");
		$PDO->exec("set names utf8");
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->_pdo = $PDO;
	}

	/**
	 * @param int    $user
	 * @param string $table
	 * @param Entity $entity
	 *
	 * @throws DatabaseConnectionException
	 */
	public function registerCreate ($user, $table, $entity) {
		try {
			$stmt = $this->_pdo->prepare(self::QUERY_REGISTER_CREATE);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":table", $table, PDO::PARAM_STR);
			$stmt->bindParam(":object", base64_encode(serialize($entity)), PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $exception) {
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int    $user
	 * @param string $table
	 * @param Entity $entityBefore
	 * @param Entity $entityAfter
	 *
	 * @throws DatabaseConnectionException
	 */
	public function registerUpdate ($user, $table, $entityBefore, $entityAfter) {
		try {
			$stmt = $this->_pdo->prepare(self::QUERY_REGISTER_UPDATE);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":table", $table, PDO::PARAM_STR);
			$stmt->bindParam(":object_before", base64_encode(serialize($entityBefore)), PDO::PARAM_STR);
			$stmt->bindParam(":object_after", base64_encode(serialize($entityAfter)), PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $exception) {
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param int    $user
	 * @param string $table
	 * @param Entity $entity
	 *
	 * @throws DatabaseConnectionException
	 */
	public function registerDelete ($user, $table, $entity) {
		try {
			$stmt = $this->_pdo->prepare(self::QUERY_REGISTER_DELETE);
			$stmt->bindParam(":user", $user, PDO::PARAM_INT);
			$stmt->bindParam(":table", $table, PDO::PARAM_STR);
			$stmt->bindParam(":object", base64_encode(serialize($entity)), PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $exception) {
			throw new DatabaseConnectionException("Database connection problem.", 500);
		}
	}

	/**
	 * @param $dbObject
	 *
	 * @return mixed
	 */
	protected function extract ($dbObject) {
		return null;
	}
}