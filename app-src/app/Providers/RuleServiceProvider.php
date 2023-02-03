<?php
namespace App\Providers;

use Baubyte\Providers\ServiceProvider;
use Baubyte\Validation\Rule;

class RuleServiceProvider implements ServiceProvider{

  public function registerServices(){
    Rule::loadDefaultRules();
  }
}