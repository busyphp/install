<?php

namespace BusyPHP\install;

use BusyPHP\install\app\controller\InstallController;
use BusyPHP\Service as BaseService;
use think\Response;
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
            $route->rule('assets/install/<path>', function($path) {
                $parse = parse_url($path);
                $path  = $parse['path'] ?? '';
                $file  = __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . ltrim($path, '/');
                if (!$path || !is_file($file)) {
                    return Response::create('资源不存在', 'html', 200)->contentType('text/plain');
                }
                
                // 判断类型
                switch (strtolower((string) pathinfo($path, PATHINFO_EXTENSION))) {
                    case 'css':
                        $mimeType = 'text/css';
                    break;
                    case 'js':
                        $mimeType = 'application/x-javascript';
                    break;
                    case 'png':
                        $mimeType = 'image/png';
                    break;
                    default:
                        $mimeType = 'application/octet-stream';
                }
                
                return Response::create(file_get_contents($file), 'html', 200)->contentType($mimeType);
            })->pattern(['path' => '.*']);
        });
    }
}
