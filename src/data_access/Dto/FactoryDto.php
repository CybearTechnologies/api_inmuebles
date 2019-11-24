<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class FactoryDto {
	/**
	 * @param        $id
	 * @param string $name
	 *
	 * @return DtoPropertyType
	 */
	static function createDtoPropertyType (int $id, $name = ''):DtoPropertyType {
		return new DtoPropertyType($id, $name);
	}

	/**
	 * @param        $id
	 * @param string $name
	 * @param int    $price
	 *
	 * @return DtoPlan
	 */
	static function createDtoPlan ($id, $name = '', $price = 0):DtoPlan {
		return new DtoPlan($id, $name, $price);
	}

	/**
	 * @param int            $id
	 * @param string         $name
	 * @param DtoSeat[]|null $seats
	 *
	 * @return DtoAgency
	 */
	static function createDtoAgency (int $id, $name = '', $seats = null) {
		return new DtoAgency($id, $name, $seats);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 *
	 * @return DtoExtra
	 */
	static function createDtoExtra (int $id, $name = ""):DtoExtra {
		return new DtoExtra($id, $name);
	}

	static function createDtoLocation ($id, $name = "", $type = ""):DtoLocation {
		return new DtoLocation($id,$name,$type);
	}

	/**
	 * @param int    $id
	 * @param string $name
	 * @param string $rif
	 *
	 * @return DtoSeat
	 */
	static function createDtoSeat (int $id, $name = '', $rif = '') {
		return new DtoSeat($id, $name, $rif);
	}

	/**
	 * @param        $id
	 * @param string $date
	 *
	 * @return DtoRequest
	 */
	static function createDtoRequest (int $id, $date = '') {
		return new DtoRequest($id, $date);
	}

	/**
	 * @param int    $id
	 * @param int    $price
	 * @param string $date
	 * @param bool   $final
	 *
	 * @return DtoPropertyPrice
	 */
	static function createDtoPropertyPrice (int $id, $price = 0, $date = '', $final = false) {
		return new DtoPropertyPrice($id, $price, $date, $final);
	}
}