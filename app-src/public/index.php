<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Baubyte\App;

App::bootstrap(dirname(__DIR__))->run();