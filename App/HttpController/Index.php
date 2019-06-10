<?php

namespace App\HttpController;

use App\Util\Code;
use EasySwoole\Http\Message\Status;

class Index extends Api
{
    protected $data;

    public function index()
    {
        $this->response()->write('Hello World');
    }

    // test api return success
    public function testSuccessApi()
    {
        return $this->ok([
            'name'  => 'xfjpeter',
            'age'   => 26,
            'email' => 'fsyzxz@163.com',
        ]);
    }

    // test api return fail
    public function testFailAPi()
    {
        return $this->fail(Code::not_fount, Status::CODE_NOT_FOUND);
    }
}
