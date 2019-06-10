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
 * | Desc:
 * | ---------------------------------------------------------------------------------------------------
 */

namespace App\HttpController;

use App\Util\Code;
use EasySwoole\EasySwoole\Config;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;
use Throwable;

class Api extends Controller
{
    public function index()
    {
        // TODO: Implement index() method.
    }

    // 执行请求的拦截：放行返回true，拦截返回false
    protected function onRequest(?string $action): ?bool
    {
        return parent::onRequest($action);
    }

    /**
     * 方法没找到
     * @param string|null $action
     * @return bool|void
     */
    protected function actionNotFound(?string $action)
    {
        return $this->fail(Code::not_fount, Status::CODE_NOT_FOUND);
    }

    /**
     * 处理系统异常
     * @param Throwable $throwable
     */
    protected function onException(Throwable $throwable): void
    {
        if (Config::getInstance()->getConf('DEV')) {
            $message = $throwable->getMessage().'===>File: '.$throwable->getFile().':'.$throwable->getLine();
            $this->fail(Code::interval_server_error, Status::CODE_INTERNAL_SERVER_ERROR, $message);
        } else {
            $this->fail(Code::interval_server_error, Status::CODE_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * 成功返回
     * @param string $data
     * @param int    $errorCode
     * @param int    $statusCode
     * @param string $message
     * @return bool
     */
    protected function ok($data = '', int $errorCode = 0, int $statusCode = Status::CODE_OK, string $message = '')
    {
        return $this->result($errorCode, $statusCode, $data, $message);
    }

    /**
     * 错误
     * @param int    $errorCode
     * @param int    $statusCode
     * @param string $message
     * @return bool
     */
    protected function fail(int $errorCode, int $statusCode = Status::CODE_OK, string $message = '')
    {
        return $this->result($errorCode, $statusCode, '', $message);
    }

    /**
     * 返回接口数据
     * @param int          $errorCode  错误码
     * @param int          $statusCode http状态码
     * @param string|array $data       数据
     * @param string       $message    消息
     * @return bool
     */
    protected function result(int $errorCode = 0, int $statusCode = Status::CODE_OK, $data = '', string $message = '')
    {
        if (!$this->response()->isEndResponse()) {
            $result = [
                'error_code' => $errorCode,
                'message'    => $message ? $message : Code::getInstance()->getMessage($errorCode),
                'result'     => $data,
            ];
            $this->response()->write(json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $this->response()->withStatus($statusCode);
            $this->response()->withHeader('Content-Type', 'application/json; charset=utf-8');
            $this->response()->withHeader('Server', 'Johnxu Server');
            $this->response()->withHeader('Access-Control-Allow-Headers',
                'Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With');
            $this->response()->withHeader('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE');
            $this->response()->withHeader('Access-Control-Allow-Origin', '*');

            return true;
        }

        return false;
    }
}