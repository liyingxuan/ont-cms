## ONT CMS

#### 1. Language and framework
PHP >=7.0.0  
Laravel v5.5.*  
[laravel-admin v1.5.x-dev](http://laravel-admin.org/)    

#### 2. Install and run
[Deploy the server environment](http://www.jianshu.com/p/1f17a69f6dcf)

Reboot server.

Go in project path :
```bash
$ cd [project path]
$ chmod -R 777 storage/
$ chmod -R 777 public/

$ composer install
$ npm install

$ cp .env.example .env
$ php artisan key:generate 

$ php artisan admin:install
$ php artisan migrate:install
$ php artisan migrate

$ php artisan passport:install
# 将生成的两个CLIENT_Secret保存到.env中
```  
  
!! If you have problems you need to roll back to rebuild the database:    
!! 如果出现问题需要回滚重建数据库：  
```bash
$ php artisan migrate:refresh
$ php artisan migrate
```

#### 3. Develop
> 假设新建的数据为：xxx。  
注意s的默认用法，不用追求英语语法的正确与否。  
本地启动注意注释【./ont-cms/config/admin.php】45行：（'secure' => true,），提交代码需恢复。

##### 3.1 CMS部分
###### 3.1.1 创建数据库迁移
```bash
php artisan make:migration create_xxxs_table 
```
> 在文件中增加相关字段和属性等配置信息。

```bash
php artisan migrate
```

###### 3.1.2 增加Model
> 在app下新建xxx.php，可以参照已经建立好的model

###### 3.1.3 增加Controller
> ./ont-cms/app/Admin/Controllers下新建xxxController.php，可以参照已建。  
修改相应内容

###### 3.1.4 配置路由
> ./ont-cms/app/Admin/routes.php下添加类似行：  
```php
$router->resource('xxx', XxxController::class);
```

###### 3.1.5 页面上配置menu、permissions、roles

##### 3.2 API部分
###### 3.2.1 增加Controller
> ./ont-cms/app/Api/Controllers下新建xxxController.php，可以参照已建。  
修改相应内容

###### 3.2.2 配置路由
> ./ont-cms/routes/api.php下添加类似行：
```php
    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        $api->group(['prefix' => 'xxx'], function ($api) {
            $api->get('all', 'XxxController@index');
            $api->get('{id}', 'XxxController@show');
        });
    });
```

##### 3.2.3 更新api文档
> ./ont-cms/app/Api/Common/ApiDoc.php

搞定！

 
#### 4. 部署到生产环境
##### 4.1 获取代码
> 目前我使用的git直接管理代码，通过两条命令单向同步代码库中的代码。
 
```bash
git fetch --all
git reset --hard origin/master
```
 
##### 4.2 配置文件
> 分两种情况，有SQL文件：
```bash
$ cd [project path]
$ chmod -R 777 storage/
$ chmod -R 777 public/

$ composer install
$ npm install

$ cp .env.example .env
$ php artisan key:generate 
```
 
> ！！！没有SQL文件，再做此部署！！！
```bash
$ php artisan admin:install
$ php artisan migrate:install
$ php artisan migrate
```

> 最后
```bash
$ php artisan passport:install
# 将生成的两个CLIENT_Secret保存到.env中
```



未完待续...