<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../../vendor/autoload.php';
require_once __DIR__ . './../../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../../core/Environment.php';

class QueryGenericGet extends TestCase {
	private $_dao;
	private $_keyWord;
	private $_extraList;
	private $_minPrice;
	private $_maxPrice;
	private $_municipality;
	private $_state;

	protected function setUp ():void {
		$this->_dao = FactoryDao::createDaoProperty();
		$this->_keyWord = "apartamento";
		$this->_minPrice=200;
		$this->_maxPrice=800;
		$this->_extraList = array();
		$this->_municipality = "Atures";
		$this->_state = "Bolivar";
		array_push($this->_extraList,"Piscina");
		array_push($this->_extraList,"Estacionamiento");
	}

	public function testReturn () {
		try {
			echo $this->_dao->genericGetProperty($this->_keyWord,$this->_extraList,$this->_minPrice,$this->_maxPrice,$this->_municipality,null);
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
		catch (PropetyTypeAlreadyExistException $exception) {
			echo $exception->getMessage();
		}
		catch (PropertyTypeNotFoundException $exception) {
			echo $exception->getMessage();
		}
		catch (Exception $exception){
			echo $exception->getMessage();
		}
	}

}