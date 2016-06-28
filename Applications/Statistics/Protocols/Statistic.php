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
namespace Protocols;
/**
 *
 * struct statisticPortocol
 * {
 *     unsigned char module_name_len;
 *     unsigned char interface_name_len;
 *     float cost_time;
 *     unsigned char success;
 *     int code;
 *     unsigned short msg_len;
 *     unsigned int time;
 *     char[module_name_len] module_name;
 *     char[interface_name_len] interface_name;
 *     char[msg_len] msg;
 * }
 *
 * @author workerman.net
 */
class Statistic
{
    /**
     * 包头长度
     * @var integer
     */
    const PACKAGE_FIXED_LENGTH = 17;

    /**
     * udp 包最大长度
     * @var integer
     */
    const MAX_UDP_PACKGE_SIZE  = 65507;

    /**
     * char类型能保存的最大数值
     * @var integer
     */
    const MAX_CHAR_VALUE = 255;

    /**
     *  usigned short 能保存的最大数值
     * @var integer
     */
    const MAX_UNSIGNED_SHORT_VALUE = 65535;

    /**
     * input
     * @param string $recv_buffer
     */
    public static function input($recv_buffer)
    {
        if(strlen($recv_buffer) < self::PACKAGE_FIXED_LENGTH)
        {
            return 0;
        }
        $data = unpack("Cmodule_name_len/Cinterface_name_len/fcost_time/Csuccess/Ncode/nmsg_len/Ntime", $recv_buffer);
        return $data['module_name_len'] + $data['interface_name_len'] + $data['msg_len'] + self::PACKAGE_FIXED_LENGTH;
    }
    
    /**
     * 编码
     * @param string $module
     * @param string $interface
     * @param float $cost_time
     * @param int $success
     * @param int $code
     * @param string $msg
     * @return string
     */
    public static function encode($data)
    {
        $module = $data['module'];
        $interface = $data['interface'];
        $cost_time = $data['cost_time'];
        $success = $data['success'];
        $code = isset($data['code']) ? $data['code'] : 0;
        $msg = isset($data['msg']) ? $data['msg'] : '';
        
        // 防止模块名过长
        if(strlen($module) > self::MAX_CHAR_VALUE)
        {
            $module = substr($module, 0, self::MAX_CHAR_VALUE);
        }

        // 防止接口名过长
        if(strlen($interface) > self::MAX_CHAR_VALUE)
        {
            $interface = substr($interface, 0, self::MAX_CHAR_VALUE);
        }

        // 防止msg过长
        $module_name_length = strlen($module);
        $interface_name_length = strlen($interface);
        $avalible_size = self::MAX_UDP_PACKGE_SIZE - self::PACKAGE_FIXED_LENGTH - $module_name_length - $interface_name_length;
        if(strlen($msg) > $avalible_size)
        {
            $msg = substr($msg, 0, $avalible_size);
        }

        // 打包
        return pack('CCfCNnN', $module_name_length, $interface_name_length, $cost_time, $success ? 1 : 0, $code, strlen($msg), time()).$module.$interface.$msg;
    }
     
    /**
     * 解包
     * @param string $recv_buffer
     * @return array
     */
    public static function decode($recv_buffer)
    {
        // 解包
        $data = unpack("Cmodule_name_len/Cinterface_name_len/fcost_time/Csuccess/Ncode/nmsg_len/Ntime", $recv_buffer);
        $module = substr($recv_buffer, self::PACKAGE_FIXED_LENGTH, $data['module_name_len']);
        $interface = substr($recv_buffer, self::PACKAGE_FIXED_LENGTH + $data['module_name_len'], $data['interface_name_len']);
        $msg = substr($recv_buffer, self::PACKAGE_FIXED_LENGTH + $data['module_name_len'] + $data['interface_name_len']);
        return array(
                'module'          => $module,
                'interface'        => $interface,
                'cost_time' => $data['cost_time'],
                'success'           => $data['success'],
                'time'                => $data['time'],
                'code'               => $data['code'],
                'msg'                => $msg,
        );
    }
}
