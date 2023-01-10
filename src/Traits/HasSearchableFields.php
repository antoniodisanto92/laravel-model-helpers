<?php
/**
 * Created by PhpStorm.
 * File: HasSearchableFields.php
 * User: antoniodisanto
 * Date: 10/01/23
 * Time: 11:24
 */

namespace Antoniodisanto92\ModelHelpers\Traits;

use Antoniodisanto92\ModelHelpers\Facades\MacroableModels;

trait HasSearchableFields {

    public static function bootHasSearchableFields() : void {
        // INIT
        $fields = with(new static())->getSearchableFields();
        $class = static::class;

        // ADD DYNAMICS
        foreach ($fields as $field) {
            MacroableModels::addMacro($class, sprintf("find_by_%s", $field), function ($value) use ($class, $field) {
                return $class::where($field, $value)->first();
            });
        }
    }

    public function getSearchableFields() {
        return with(new static())->getFillable();
    }

}
