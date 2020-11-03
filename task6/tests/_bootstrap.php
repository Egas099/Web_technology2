<?php
use Codeception\Util\Fixtures;
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('YII_DEBUG') or define('YII_DEBUG', true);
define("FIXTURES_DIR", __DIR__ . '/_fixtures/data/');

/*
 * Используем класс Fixtures для хранения фикстур
 * FIXTURES_DIR - константа заданная в главном файле _bootstrap
 */
Fixtures::add('imgRightData', require(FIXTURES_DIR . 'imgRightData.php'));
Fixtures::add('imgWrongData', require(FIXTURES_DIR . 'imgWrongData.php'));
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ .'/../vendor/autoload.php';