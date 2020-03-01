<?php
/**
 * Resize image class will allow you to resize an image
 * Can resize to exact size
 * Max width size while keep aspect ratio
 * Max height size while keep aspect ratio
 * Automatic while keep aspect ratio
 */
class ResizeImage {
	private $_ext;
	private $_image;
	private $_newImage;
	private $_originalWidth;
	private $_originalHeight;
	private $_resizeWidth;
	private $_resizeHeight;
	public const OPTION_EXACT = 'exact';
	public const OPTION_MAX_WIDTH = 'maxWidth';
	public const OPTION_MAX_HEIGHT = 'maxHeight';

	/**
	 * Class constructor requires to send through the image filename
	 *
	 * @param string $fileName - Filename of the image you want to resize
	 *
	 * @throws FileIsNotImageException
	 * @throws ImageNotFoundException
	 */
	public function __construct ($fileName) {
		if (file_exists($fileName))
			$this->setImage($fileName);
		else
			throw new ImageNotFoundException('Image ' . $fileName . ' can not be found, try another image.');
	}

	/**
	 * Set the image variable by using image create
	 *
	 * @param string $fileName - The image filename
	 *
	 * @throws FileIsNotImageException
	 */
	private function setImage ($fileName) {
		$size = getimagesize($fileName);
		$this->_ext = $size['mime'];
		switch ($this->_ext) {
			// Image is a JPG
			case 'image/jpg':
			case 'image/jpeg':
				// create a jpeg extension
				$this->_image = imagecreatefromjpeg($fileName);
				break;
			// Image is a GIF
			case 'image/gif':
				$this->_image = @imagecreatefromgif($fileName);
				break;
			// Image is a PNG
			case 'image/png':
				$this->_image = @imagecreatefrompng($fileName);
				break;
			// Mime type not found
			default:
				throw new FileIsNotImageException("File is not an image, please use another file type. Current Type: ".$this->_ext, 1);
		}
		$this->_originalWidth = imagesx($this->_image);
		$this->_originalHeight = imagesy($this->_image);
	}

	/**
	 * Save the image as the image type the original image was
	 *
	 * @param string $savePath
	 * @param string $imageQuality - The quality level of image to create
	 * @param bool   $download
	 *
	 * @return void the image
	 */
	public function saveImage ($savePath, $imageQuality = "100", $download = false) {
		switch ($this->_ext) {
			case 'image/jpg':
			case 'image/jpeg':
				// Check PHP supports this file type
				if (imagetypes() & IMG_JPG) {
					imagejpeg($this->_newImage, $savePath, $imageQuality);
				}
				break;
			case 'image/gif':
				// Check PHP supports this file type
				if (imagetypes() & IMG_GIF) {
					imagegif($this->_newImage, $savePath);
				}
				break;
			case 'image/png':
				$invertScaleQuality = 9 - round(($imageQuality / 100) * 9);
				// Check PHP supports this file type
				if (imagetypes() & IMG_PNG) {
					imagepng($this->_newImage, $savePath, $invertScaleQuality);
				}
				break;
		}
		if ($download) {
			header('Content-Description: File Transfer');
			header("Content-type: application/octet-stream");
			header("Content-disposition: attachment; filename= " . $savePath . "");
			readfile($savePath);
		}
		imagedestroy($this->_newImage);
	}

	/**
	 * Resize the image to these set dimensions
	 *
	 * @param  int    $width        - Max width of the image
	 * @param  int    $height       - Max height of the image
	 * @param  string $resizeOption - Scale option for the image
	 *
	 * @return void new image
	 */
	public function resizeTo ($width = 0, $height = 0, $resizeOption = 'default') {
		if ($width == 0 | $height == 0){
			$width = $this->_originalWidth;
			$height = $this->_originalHeight;
		}
		switch ($resizeOption) {
			case self::OPTION_EXACT:
				$this->_resizeWidth = $width;
				$this->_resizeHeight = $height;
				break;
			case self::OPTION_MAX_WIDTH:
				$this->_resizeWidth = $width;
				$this->_resizeHeight = $this->resizeHeightByWidth($width);
				break;
			case self::OPTION_MAX_HEIGHT:
				$this->_resizeWidth = $this->resizeWidthByHeight($height);
				$this->_resizeHeight = $height;
				break;
			default:
				if ($this->_originalWidth > $width || $this->_originalHeight > $height) {
					if ($this->_originalWidth > $this->_originalHeight) {
						$this->_resizeHeight = $this->resizeHeightByWidth($width);
						$this->_resizeWidth = $width;
					}
					elseif ($this->_originalWidth < $this->_originalHeight) {
						$this->_resizeWidth = $this->resizeWidthByHeight($height);
						$this->_resizeHeight = $height;
					}
				}
				else {
					$this->_resizeWidth = $width;
					$this->_resizeHeight = $height;
				}
				break;
		}
		$this->_newImage = imagecreatetruecolor($this->_resizeWidth, $this->_resizeHeight);
		imagecopyresampled($this->_newImage, $this->_image, 0, 0, 0, 0, $this->_resizeWidth, $this->_resizeHeight,
			$this->_originalWidth, $this->_originalHeight);
	}

	/**
	 * Get the resize height from the width keeping the aspect ratio
	 *
	 * @param  int $width - Max image width
	 *
	 * @return float height keeping aspect ratio
	 */
	private function resizeHeightByWidth ($width) {
		return floor(($this->_originalHeight / $this->_originalWidth) * $width);
	}

	/**
	 * Get the resize width from the height keeping the aspect ratio
	 *
	 * @param  int $height - Max image height
	 *
	 * @return float width keeping aspect ratio
	 */
	private function resizeWidthByHeight ($height) {
		return floor(($this->_originalWidth / $this->_originalHeight) * $height);
	}

	/**
	 * @return mixed
	 */
	public function getOriginalWidth () {
		return $this->_originalWidth;
	}

	/**
	 * @return mixed
	 */
	public function getOriginalHeight () {
		return $this->_originalHeight;
	}

}