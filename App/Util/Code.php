<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | ProjectName: easyswoole
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.xfjpeter.cn
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 201906102019-06-10
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 错误码
 * | ---------------------------------------------------------------------------------------------------
 */

namespace App\Util;

use EasySwoole\Component\Singleton;

/**
 * 错误码集合
 * Class Code
 * @package App\Util
 */
class Code
{
    use Singleton;

    const interval_server_error = 5000;
    const not_fount             = 4004;

    private $message = [
        4004 => 'Not Found',
        5000 => 'Interval Server Error',
    ];

    /**
     * @param int $code
     * @return array|mixed
     */
    public function get(int $code)
    {
        $message = $this->message;

        return $message[$code] ?? '未知错误';
    }

    /**
     * @param int $code
     * @return array|mixed
     */
    public function getMessage(int $code)
    {
        return $this->get($code);
    }
}