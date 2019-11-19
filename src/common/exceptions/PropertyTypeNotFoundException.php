<?php
/**
 * Created by Kevin Martinez
 * Date: 13-Nov-19
 * Time: 7:36 PM
 */
require_once __DIR__ . "/CustomException.php";

class PropertyTypeNotFoundException extends CustomException {
    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}