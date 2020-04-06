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

	/**
	 * @param $get
	 *
	 * @return bool
	 */
	static function id ($get) {
		return isset($get->id) && is_numeric($get->id);
	}

	/**
	 * @param $post
	 *
	 * @return bool
	 */
	static function rol ($post) {
		return isset($post->name) && !empty($post->name);
	}

	/**
	 * @param $extra
	 *
	 * @return bool
	 */
	static function extra ($extra) {
		return isset($extra->name) && !empty($extra->name);
	}

	/**
	 * @param object
	 *
	 * @return bool
	 */
	static function propertyType ($propertyType) {
		return isset($propertyType->name) && !empty($propertyType->name);
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
		return isset($agency->name) && !empty($agency->name);
	}

	/**
	 * @param $rating
	 *
	 * @return bool
	 */
	static function Rating ($rating) {
		return isset($rating->id) && is_numeric($rating->id)
			&& isset($rating->score) && is_numeric($rating->score)
			&& isset($rating->message) && !empty($rating->message)
			&& isset($rating->target) && is_numeric($rating->target);
	}

	/**
	 * @param $rolAccess
	 *
	 * @return bool
	 */
	static function rolAccess ($rolAccess) {
		return isset($rolAccess->id) && is_numeric($rolAccess->id)
			&& isset($rolAccess->access) && is_numeric($rolAccess->access)
			&& isset($rolAccess->rol) && is_numeric($rolAccess->rol);
	}

	/**
	 * @param $rolAccess
	 *
	 * @return bool
	 */
	static function activateRolAccess ($rolAccess) {
		return isset($rolAccess->rol) && is_numeric($rolAccess->rol)
			&& isset($rolAccess->access) && is_numeric($rolAccess->access)
			&& strtolower($rolAccess->action) == "active";
	}

	/**
	 * @param $rolAccess
	 *
	 * @return bool
	 */
	static function inactivateRolAccess ($rolAccess) {
		return isset($rolAccess->rol) && is_numeric($rolAccess->rol)
			&& isset($rolAccess->access) && is_numeric($rolAccess->access)
			&& strtolower($rolAccess->action) == "inactive";
	}

	/**
	 * @param $property
	 *
	 * @return bool
	 */
	static function activeProperty ($property) {
		return isset($property->id) && is_numeric($property->id)
			&& strtolower($property->action) == "active";
	}

	/**
	 * @param $property
	 *
	 * @return bool
	 */
	static function inactiveProperty ($property) {
		return isset($property->id) && is_numeric($property->id)
			&& strtolower($property->action) == "inactive";
	}

	/**
	 * @param $agency
	 *
	 * @return bool
	 */
	static function putAgency ($agency) {
		return isset($agency->id) && is_numeric($agency->id)
			&& isset($agency->name) && !empty($agency->name);
	}

	/**
	 * @param $rol
	 *
	 * @return bool
	 */
	static function putRol ($rol) {
		return isset($rol->id) && is_numeric($rol->id)
			&& isset($rol->name) && !empty($rol->name);
	}

	/**
	 * @param $extra
	 *
	 * @return bool
	 */
	static function putExtra ($extra) {
		return isset($extra->id) && is_numeric($extra->id)
			&& isset($extra->name) && !empty($extra->name)
			&& isset($extra->icon) && !empty($extra->icon);
	}

	/**
	 * @param $plan
	 *
	 * @return bool
	 */
	static function putPlan ($plan) {
		return isset($plan->id) && is_numeric($plan->id)
			&& isset($plan->name) && !empty($plan->name)
			&& isset($plan->price) && is_numeric($plan->price);
	}

	/**
	 * @param $rating
	 *
	 * @return bool
	 */
	static function putRating ($rating) {
		return isset($rating->id) && is_numeric($rating->id)
			&& isset($rating->score) && is_numeric($rating->score)
			&& isset($rating->message) && !empty($rating->message);
	}

	/**
	 * @param $seat
	 *
	 * @return bool
	 */
	static function putSeat ($seat) {
		return isset($seat->id) && is_numeric($seat->id)
			&& isset($seat->name) && !empty($seat->name)
			&& isset($seat->rif) && !empty($seat->rif)
			&& isset($seat->location) && is_numeric($seat->location)
			&& isset($seat->agency) && is_numeric($seat->agency);
	}

	/**
	 * @param $post
	 *
	 * @return bool
	 */
	public static function favorite ($post) {
		return isset($post->id) && is_numeric($post->id)
			&& isset($post->property) && is_numeric($post->property);
	}

	/**
	 * @param $post
	 *
	 * @return bool
	 */
	static function subscription ($post) {
		return isset($post->ci) && !empty($post->ci)
			&& isset($post->firstName) && !empty($post->firstName)
			&& isset($post->lastName) && !empty($post->lastName)
			&& isset($post->address) && !empty($post->address)
			&& isset($post->passport) && !empty($post->passport)
			&& isset($post->password) && !empty($post->password)
			&& isset($post->email) && !empty($post->email)
			&& isset($post->plan) && is_numeric($post->plan)
			&& isset($post->seat) && is_numeric($post->seat)
			&& isset($post->location) && is_numeric($post->location);
	}
}