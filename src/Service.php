<?php
declare(strict_types = 1);

namespace BusyPHP\install;

use BusyPHP\install\app\controller\InstallController;
use BusyPHP\Service as BaseService;
use think\Route;

/**
 * Server
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2019 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2020/6/18 下午10:45 上午 Service.php $
 */
class Service extends \think\Service
{
    public function boot()
    {
        $this->registerRoutes(function(Route $route) {
            $configFile = $this->app->getRootPath() . 'vendor' . DIRECTORY_SEPARATOR . 'busyphp_install.php';
            if (!is_file($configFile)) {
                return;
            }
            
            $config = include_once $configFile;
            $prefix = $config['prefix'] ?? '';
            if (!$prefix) {
                return;
            }
            
            
            // 控制器路由
            $route
                ->group(function() use ($route, $prefix) {
                    $action = sprintf("<%s>", BaseService::ROUTE_VAR_ACTION);
                    $route
                        ->rule(
                            sprintf("%s/install/%s", $prefix, $action),
                            sprintf("%s@%s", InstallController::class, $action)
                        );
                    $route
                        ->rule(
                            sprintf("%s/install", $prefix),
                            sprintf("%s@index", InstallController::class)
                        )
                        ->append([BaseService::ROUTE_VAR_ACTION => 'index']);
                })
                ->append([
                    BaseService::ROUTE_VAR_TYPE    => BaseService::ROUTE_TYPE_PLUGIN,
                    BaseService::ROUTE_VAR_CONTROL => 'Install'
                ]);
        });
    }
}
