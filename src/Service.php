<?php

namespace BusyPHP\install;

use BusyPHP\helper\FileHelper;
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
            
            $config = include $configFile;
            $prefix = $config['prefix'] ?? '';
            if (!$prefix) {
                return;
            }
            
            
            // 控制器路由
            $route->group(function() use ($route, $prefix) {
                $actionPattern = '<' . BaseService::ROUTE_VAR_ACTION . '>';
                $route->rule("{$prefix}/install/{$actionPattern}", InstallController::class . "@{$actionPattern}");
                $route->rule("{$prefix}/install", InstallController::class . '@index')
                    ->append([BaseService::ROUTE_VAR_ACTION => 'index']);
            })->append([
                BaseService::ROUTE_VAR_TYPE    => 'plugin',
                BaseService::ROUTE_VAR_CONTROL => 'Install'
            ]);
            
            
            // 资源路由
            $route->rule('assets/plugins/install/<path>', function($path) {
                $parse = parse_url($path);
                $path  = $parse['path'] ?? '';
                
                return FileHelper::responseAssets(__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . ltrim($path, '/'));
            })->pattern(['path' => '.*']);
        });
    }
}
