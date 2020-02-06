<?php
/**
 * Generated by Houston
 * Date: 19-Nov-19
 * Time: 12:29 PM
 */
class Validate {
	private const OPTIONS = array ('cost' => 10);

	/**
	 * Headers Control
	 *
	 * @param $string
	 */
	public static function sanitizeString (&$string) {
		$string = filter_var(strip_tags($string), FILTER_SANITIZE_STRING);
	}

	/**
	 * @param $string
	 *
	 * @return bool
	 */
	public static function isEmpty (string $string) {
		return empty($string) || $string == '' || is_null($string) || $string == 'null';
	}

	/**
	 * @param string $try
	 * @param string $actual
	 *
	 * @return bool
	 */
	static function verifyPassword (string $try, string $actual) {
		return password_verify($try, $actual);
	}

	/**
	 * @param string $password
	 *
	 * @return null|string
	 */
	static function verifyPasswordRehash (string $password) {
		if (password_needs_rehash($password, PASSWORD_DEFAULT, self::OPTIONS)) {
			return password_hash($password, PASSWORD_DEFAULT, self::OPTIONS);
		}

		return null;
	}

	/**
	 * @param string $password
	 *
	 * @return bool|string
	 */
	static function passwordHash (string $password) {
		return password_hash($password, PASSWORD_DEFAULT, self::OPTIONS);
	}

	static function id ($get) {
		return isset($get->id) && is_numeric($get->id);
	}

	/**
	 * @param $extra
	 *
	 * @return bool
	 */
	static function extra ($extra) {
		return isset($extra->name) && !empty($extra->name)
			&& isset($extra->icon) && !empty($extra->icon);
	}

	/**
	 * @param $propertyType
	 *
	 * @return bool
	 */
	static function propertyType ($propertyType) {
		return isset($propertyType->name) && !empty($propertyType->name)
			&& isset($propertyType->image) && !empty($propertyType->image);
	}

	/**
	 * @param $property
	 *
	 * @return bool
	 */
	static function property ($property) {
		return isset($property->name) && !empty($property->name)
			&& isset($property->area) && is_numeric($property->area)
			&& isset($property->description) && !empty($property->description)
			&& isset($property->floor) && is_numeric($property->area)
			&& isset($property->type) && is_numeric($property->type)
			&& isset($property->price) && is_array($property->price);
	}

	/**
	 * @param $seat
	 *
	 * @return bool
	 */
	static function seat ($seat) {
		return isset($seat->name) && !empty($seat->name)
			&& isset($seat->rif) && !empty($seat->rif)
			&& isset($seat->location) && is_numeric($seat->location)
			&& isset($seat->agency) && is_numeric($seat->agency);
	}

	/**
	 * @param $plan
	 *
	 * @return bool
	 */
	static function plan ($plan) {
		return isset($plan->name) && !empty($plan->name)
			&& isset($plan->price) && !empty($plan->price)
			&& is_numeric($plan->price) && isset($plan->id);
	}

	/**
	 * @param $agency
	 *
	 * @return bool
	 */
	static function agency ($agency) {
		return isset($agency->id)
			&& isset($agency->name) && !empty($agency->name);
	}

	/**
	 * @param $rating
	 *
	 * @return bool
	 */
	static function Rating ($rating) {
		return isset($rating->id) && is_numeric($rating->id)
			&& isset($rating->score);
	}
}