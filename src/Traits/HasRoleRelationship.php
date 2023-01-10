<?php
/**
 * Created by PhpStorm.
 * File: HasRoleRelationship.php
 * User: antoniodisanto
 * Date: 10/01/23
 * Time: 12:00
 */

namespace Antoniodisanto92\ModelHelpers\Traits;

use Antoniodisanto92\ModelHelpers\Constants\Role;
use Antoniodisanto92\ModelHelpers\Facades\MacroableModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class HasRoleRelationship {

    protected string $method = "role";
    protected string $roleNameField = "name";

    public static function bootHasRoleRelationship() : void {
        // INIT
        $roles = with(new static())->getListOfRoles();
        $class = static::class;

        // ADD DYNAMICS
        foreach ($roles as $role) {
            $s = ucwords(Str::of(strtolower($role))->camel());
            MacroableModels::addMacro($class, sprintf("is%s", $s), function () use ($role) {
                $rel = $this->{$this->getRoleMethod()};
                if ($rel instanceof Collection) {
                    return $rel->pluck($this->getRoleNameField())->contains($role);
                }
                return $rel->{$this->getRoleNameField()} == $role;
            });
        }
    }

    public function getListOfRoles() : array {
        return Role::list();
    }

    public function getRoleMethod() : string {
        return $this->method;
    }

    public function getRoleNameField() : string {
        return $this->roleNameField;
    }

}
