<?php
class FileHandler {
	const ROOT = __DIR__ . '/../../';

	/**
	 * Check there are images uploaded
	 * @return bool True if there are files uploaded, false if not
	 */
	public static function hasFiles () {
		return !empty($_FILES);
	}

	/**
	 * Check if a file with the given name was uploaded
	 *
	 * @param string $variable Name of file variable Ex. $FILES['image']
	 *
	 * @return bool True if exist, otherwise false
	 */
	public static function 	fileExist (string $variable) {
		return file_exists($_FILES[$variable]['tmp_name']) || is_uploaded_file($_FILES[$variable]['tmp_name']);
	}

	/**
	 * Save file on the given variable name
	 *
	 * @param string $variable Name of file variable Ex. $FILES['image']
	 * @param string $filename New file's name
	 * @param string $path     New file's path
	 *
	 * @return string Path to the new file
	 */
	public static function save ($variable, $filename, $path = 'files') {
		$info = pathinfo($_FILES[$variable]['name']);
		$newFilePath = $path . '/' . self::slug($filename) . self::identifier() . $info['extension'];
		if (self::makeDirectory($path)
			&& move_uploaded_file($_FILES[$variable]['tmp_name'], self::ROOT . $newFilePath)) {
			return $newFilePath;
		}

		return null;
	}

	/**
	 * Save file on the given variable name
	 *
	 * @param string $old      Path to old image
	 * @param string $variable Name of file variable Ex. $FILES['image']
	 * @param string $filename New file's name
	 * @param string $path     New file's path
	 *
	 * @return string Path to the new file
	 */
	public static function replace ($old, $variable, $filename, $path = 'files') {
		$info = pathinfo($_FILES[$variable]['name']);
		$newFilePath = $path . self::slug($filename) . self::identifier() . $info['extension'];
		if (self::makeDirectory($path)
		&& move_uploaded_file($_FILES[$variable]['tmp_name'], self::ROOT . $newFilePath)
		&& self::remove($old)) {
			return $newFilePath;
		}

		return null;
	}

	/**
	 * Remove a file if exists
	 *
	 * @param string $filename
	 *
	 * @return bool True on success, false on failure
	 */
	public static function remove ($filename) {
		return self::fileExist(self::ROOT . $filename) ? unlink(self::ROOT . $filename) : true;
	}

	/**
	 * Create a unique identifier based on current date
	 * @return string Unique identifier
	 */
	private static function identifier () {
		$d = new DateTime();

		return '-' . $d->format("Ymd-Hisu");
	}

	/**
	 * Generates a URL friendly "slug" from the given string
	 *
	 * @param string $text
	 *
	 * @return string Slugged string
	 */
	public static function slug (string $text) {
		// Replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		// Transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// Remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		// Trim
		$text = trim($text, '-');
		// Remove duplicate -
		$text = preg_replace('~-+~', '-', $text);
		// Lowercase
		$text = strtolower($text);

		return empty($text) ? 'n-a' : $text;
	}

	/**
	 * @param string $directory The directory path from root
	 *
	 * @return bool True if exist or created, false on failure
	 */
	public static function makeDirectory (string $directory) {
		if (!file_exists(self::ROOT . $directory)) {
			return mkdir(self::ROOT . $directory . '/', 0777, true);
		}

		return true;
	}
}