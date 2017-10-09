<?php
/**
 * @desc 默认控制器
 * @link http://www.weicheche.cn/
 * @author Jacky Zhang <baolin.zhang@weicheche.cn>
 * Date: 1/18/16
 * Time: 10:03 PM
 */

class DefaultController extends BaseController
{
	public function indexAction()
	{
		echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <title>喂车车</title>
    </head>
    <body>
        <h1>Hello World!!!</h1>
    </body>
</html>
EOT;
	}
}
