<?php
/**
 * Created by PhpStorm.
 * File: HasRoleField.php
 * User: antoniodisanto
 * Date: 10/01/23
 * Time: 11:50
 */

namespace Antoniodisanto92\ModelHelpers\Traits;

use Antoniodisanto92\ModelHelpers\Constants\Role;
use Antoniodisanto92\ModelHelpers\Facades\MacroableModels;
use Illuminate\Support\Str;

trait HasRoleField {

    protected string $field = "role";

    public static function bootHasRoleField() : void {
        // INIT
        $roles = with(new static())->getListOfRoles();
        $class = static::class;

        // ADD DYNAMICS
        foreach ($roles as $role) {
            $s = ucwords(Str::of(strtolower($role))->camel());
            MacroableModels::addMacro($class, sprintf("is%s", $s), function () use ($role) {
                return $this->{$this->getRoleField()} == $role;
            });
        }
    }

    public function getListOfRoles() : array {
        return Role::list();
    }

    public function getRoleField() : string {
        return $this->field;
    }

}
