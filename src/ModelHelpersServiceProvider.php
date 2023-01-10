<?php
/**
 * Created by PhpStorm.
 * File: ModelHelpersServiceProvider.php
 * User: antoniodisanto
 * Date: 10/01/23
 * Time: 11:12
 */

namespace Antoniodisanto92\ModelHelpers;

use Illuminate\Support\ServiceProvider;

class ModelHelpersServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton('model-helpers', function() {
            return new ModelHelpers();
        });
        $this->app->singleton('macroable-models', function() {
            return new MacroableModels();
        });
    }

}
