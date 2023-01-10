<?php
/**
 * Created by PhpStorm.
 * File: MacroableModels.php
 * User: antoniodisanto
 * Date: 10/01/23
 * Time: 11:18
 */

namespace Antoniodisanto92\ModelHelpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method array getAllMacros() Return all macros installed
 * @method void addMacro(string $model, string $name, \Closure $closure) Define a macro in the model with specified name
 * @method bool removeMacro(string $model, string $name) Remove a previously defined Macro
 * @method bool modelHasMacro(string $model, string $name) Remove a previously defined Macro
 * @method array modelsThatImplement(string $name) Return an array of all models that has this Macro
 * @method array macrosForModel(string $model) Return an array of all macros in requested model
 */
class MacroableModels extends Facade {

    protected static function getFacadeAccessor() {
        return 'macroable-models';
    }

}
