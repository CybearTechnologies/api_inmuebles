<?php
class ImageProcessor {
	/**
	 * Create and save image on server
	 *
	 * @param mixed  $file
	 * @param string $fileName
	 * @param string $destination
	 *
	 * @return string
	 * @throws FileIsNotImageException
	 * @throws ImageNotFoundException
	 */
	public static function saveImage ($file, $fileName, $destination = '/') {
		if (!file_exists($file))
			throw new ImageNotFoundException('Image ' . $file . ' can\'t not be found, try another image.', 403);
		$info = getimagesize($file);
		switch ($info['mime']) {
			// Image is a JPG
			case 'image/jpg':
			case 'image/jpeg':
				// create a jpeg extension
				$image = imagecreatefromjpeg($file);
				break;
			// Image is a GIF
			case 'image/gif':
				$image = imagecreatefromgif($file);
				break;
			// Image is a PNG
			case 'image/png':
				$image = imagecreatefrompng($file);
				break;
			// Mime type not found
			default:
				Throw new FileIsNotImageException("File is not an image, please use another file type. Current Type: " . $info['mime'],
					403);
		}
		$name = self::cleanString(trim($fileName)) . "-" . date("YmdHis") . ExtensionHandler::getExtension($info[2]);
		if (!file_exists(__DIR__ . '/../../' . $destination)) {
			mkdir(__DIR__ . '/../../' . $destination . '/', 0777, true);
		}
		imagejpeg($image, __DIR__ . '/../../' . $destination . '/' . $name, 60);
		imagedestroy($image);

		return $destination . '/' . $name;
	}

	public static function removeImage ($fileName) {
		unlink($fileName);
	}

	public static function imageFileExist ($inputName = 'image') {
		return isset($_FILES[$inputName]) && $_FILES[$inputName]['size'] > 0;
	}

	private static function cleanString ($name) {
		$string = str_replace(array ('&aacute;', 'á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array ('a', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $name);
		$string = str_replace(array ('&eacute;', 'é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array ('e', 'e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string);
		$string = str_replace(array ('&iacute;', 'í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array ('i', 'i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string);
		$string = str_replace(array ('&oacute;', 'ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array ('o', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string);
		$string = str_replace(array ('&uacute;', 'ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array ('u', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string);
		$string = str_replace(array ('ç', 'Ç'), array ('c', 'C'), $string);
		$cleanName = str_replace(array ("/", "\\", "-", "+", "'", '"', '(', ')', '{', '}', '[', ']',
			'.', ',', '?', ';', ':', '#', '@', '~', '`', '|', '&', '%', '^', '*', '_', '='), "", strtolower($string));

		return str_replace(" ", "-", strtolower($cleanName));
	}
}