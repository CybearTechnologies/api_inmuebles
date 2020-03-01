<?php
require_once "autoload.php";
Tools::headers();
$get = Tools::getObject();
$return = null;
switch ($_SERVER["REQUEST_METHOD"]) {
	case "POST":
		$paths = [];
		$photos = $_FILES['image']['tmp_name'];
		for ($i = 0; $i < 5; $i++) {
			if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
				try {
					$type = getimagesize($photos[$i]);
					$name = trim($_POST["name"]);
					$photos = $_FILES['image']['tmp_name'];
					$cleanName = Tools::cleanToFile($name);
					$ext = ExtensionHandler::getExtension($type[2]);
					$path = $cleanName . "-" . $i . "-" . date("YmdHis") . $ext;
					$resizeImage = FactoryEntity::createResizeImage($photos[$i]);
					$resizeImage->saveImage('./images/' . $path);
				}
				catch (FileIsNotImageException $exception) {
					$return = new ErrorResponse(Values::getText("ERROR_FILE_IS_NOT_IMAGE"));
					Tools::setResponse(Values::getValue("ERROR_FILE_IS_NOT_IMAGE"));
				}
				catch (ImageNotFoundException $exception) {
					$return = new ErrorResponse(Values::getText("ERROR_DATABASE"));
					Tools::setResponse(Values::getValue("ERROR_DATABASE"));
				}
				array_push($paths, $path);
			}
		}
		echo json_encode($return);
		break;
}