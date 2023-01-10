<?php
/**
 * Created by PhpStorm.
 * File: ModelHelpers.php
 * User: antoniodisanto
 * Date: 10/01/23
 * Time: 11:18
 */

namespace Antoniodisanto92\ModelHelpers\Facades;

use Illuminate\Support\Facades\Facade;

class ModelHelpers extends Facade {

    protected static function getFacadeAccessor() {
        return 'model-helpers';
    }

}
