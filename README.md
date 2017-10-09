# 授权子系统


### 目录结构

```
app_auth/
  |-- console
  |   `-- cli.php
  |-- v1.0
  |   |-- config
  |   |   |-- bootstrap.php
  |   |   |-- config.php
  |   |   |-- environ
  |   |   |   |-- develop.php
  |   |   |   |-- production.php
  |   |   |   `-- test.php
  |   |   |-- loader.php
  |   |   `-- services.php
  |   |-- controllers
  |   |   |-- BaseController.php
  |   |   `-- DefaultController.php
  |   |-- logics
  |   |-- models
  |   |   `-- Mongo
  |   |       `-- Counters.php
  |   `-- tasks
  `-- webroot
      |-- favicon.ico
      `-- index.php
```

#### 路由设置

##### 修改config/router.php文件


### MongoDB的使用

#### Model定义

> 为区分Mysql与Mongo，Mongo模型使用命名空间Mongo

```
<?php

/**
 *
 * @author Jacky Zhang <myself.fervor@gmail.com>
 * @copyright 2014-2016 深圳市喂车科技有限公司 <http://www.weicheche.cn/>
 * Date: 2/19/16
 * Time: 11:25 AM
 */

namespace Mongo;

use WPLib\Mvc\Collection;

class LogSystemLogs extends Collection
{
    public function getSource()
    {
        return "wei_log_system_logs";
    }
}
```

#### Model使用

> 定义好Model以后，可以使用跟Mysql模型的大部分方法，如：find/findFirst/save/update/delete等，更多请[查看手册](http://docs.iphalcon.com/zh/latest/index.html)