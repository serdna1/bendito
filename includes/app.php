<?php

use Model\ActiveRecord;
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'functions.php';
require 'database.php';

// // The same database connection is used by all models
ActiveRecord::setDB($db);