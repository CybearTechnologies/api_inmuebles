<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class FactoryMapper {
	/**
	 * @return MapperProperty
	 */
	static function createMapperProperty () {
		return new MapperProperty();
	}

	/**
	 * @return MapperPropertyPrice
	 */
	static function createMapperPropertyPrice () {
		return new MapperPropertyPrice();
	}

	/**
	 * @return MapperPropertyType
	 */
	static function createMapperPropertyType () {
		return new MapperPropertyType();
	}

	/**
	 * @return MapperPlan
	 */
	static function createMapperPlan () {
		return new MapperPlan();
	}

	/**
	 * @return MapperAgency
	 */
	static function createMapperAgency () {
		return new MapperAgency();
	}

	/**
	 * @return MapperExtra
	 */
	static function createMapperExtra ():MapperExtra {
		return new MapperExtra();
	}

	static function createMapperLocation () {
		return new MapperLocation();
	}

	/**
	 * @return MapperSeat
	 */
	static function createMapperSeat () {
		return new MapperSeat();
	}

	/**
	 * @return MapperRequest
	 */
	static function createMapperRequest () {
		return new MapperRequest();
	}
}