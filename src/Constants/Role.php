<?php
/**
 * Created by PhpStorm.
 * File: Role.php
 * User: antoniodisanto
 * Date: 10/01/23
 * Time: 11:53
 */

namespace Antoniodisanto92\ModelHelpers\Constants;

use ReflectionClass;

class Role {
    public const ADMIN = "ADMIN",
        USER = "USER";

    static function list() : array {
        $klazz = new ReflectionClass(__CLASS__);
        return $klazz->getConstants();
    }
}
