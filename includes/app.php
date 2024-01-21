<?php 

require 'functions.php';
require 'database.php';
require '../vendor/autoload.php';

// // The same database connection is used by all models
use Model\ActiveRecord;
ActiveRecord::setDB($db);