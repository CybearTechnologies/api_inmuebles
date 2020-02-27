<?php
/**
 * Created by Kevin Martinez
 * Date: 24-Mar-19
 * Time: 7:22 PM
 */
class ExtensionHandler {
	/**
	 * @param int $extension
	 *
	 * @return string
	 */
	public static function getExtension ($extension) {
		$ext = null;
		if ($extension == 2)
			$ext = ".jpg";
		elseif ($extension == 3)
			$ext = ".png";
		elseif ($extension == 1)
			$ext = ".gif";

		return $ext;
	}
}