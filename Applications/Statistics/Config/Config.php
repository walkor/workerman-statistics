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
namespace Statistics;
class Config
{
    // 数据源端口，会向这个端口发送udp广播获取ip，然后从这个端口以tcp协议获取统计信息
    public static $ProviderPort = 55858;
    
    // 管理员用户名，用户名密码都为空字符串时说明不用验证
    public static $adminName = '';
    
    // 管理员密码，用户名密码都为空字符串时说明不用验证
    public static $adminPassword = '';
    
    public static $dataPath = '';
}

Config::$dataPath = __DIR__ . '/../data/';