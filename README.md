## First

`git clone https://github.com/xfjpeter/easyswoole-cli.git easyswoole-cli`

## Second

`cd easyswoole-cli`

## Third

`composer install`

## Fourth

- start easyswoole by dev
`php easyswoole start`
- start easyswoole by produce
`php easyswoole start produce`

## Fifth

- Vist [http://localhost:9501](http://localhost:9501) Return `Hello World` 
- Visit 
[http://localhost:9501/index/testSuccessApi](http://localhost:9501/index/testSuccessApi) 
Return 
`{"error_code":0,"message":"Success","result":{"name":"xfjpeter","age":26,"email":"fsyzxz@163.com"}}`
- Visit 
[http://localhost:9501/index/testFailApi](http://localhost:9501/index/testFailApi) 
Return 
`{"error_code":4004,"message":"Not Found","result":""}`

thus finished