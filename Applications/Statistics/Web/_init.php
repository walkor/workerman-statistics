<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
define('ST_ROOT', realpath(__DIR__.'/../'));
require_once ST_ROOT .'/Lib/functions.php';
require_once ST_ROOT .'/Lib/Cache.php';
require_once ST_ROOT .'/Config/Config.php';
// 覆盖配置文件
foreach(glob(ST_ROOT . '/Config/Cache/*.php')  as $php_file)
{
    require_once $php_file;
}