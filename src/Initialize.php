<?php
declare(strict_types = 1);

namespace BusyPHP\install;

use BusyPHP\App;
use BusyPHP\helper\FileHelper;
use BusyPHP\interfaces\PluginCommandInitializeInterface;
use think\console\Output;
use think\helper\Str;

/**
 * 初始化
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/10/22 下午上午9:14 Initialize.php $
 */
class Initialize implements PluginCommandInitializeInterface
{
    /**
     * @var App
     */
    protected App $app;
    
    /**
     * Vendor目录
     * @var string
     */
    protected string $dir;
    
    
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->dir = $this->app->getRootPath() . 'vendor' . DIRECTORY_SEPARATOR;
    }
    
    
    public function onPluginCommandInitialize(Output $output)
    {
        $lockFile = $this->dir . 'busyphp_install.lock';
        if (is_file($lockFile)) {
            return;
        }
        
        // 生成安装配置
        $random = Str::random(6);
        $header = sprintf("%s// This file is busyphp/install automatically generated at:%s%sdeclare (strict_types = 1);%s", PHP_EOL, date('Y-m-d H:i:s'), PHP_EOL, PHP_EOL);
        $config = var_export(['prefix' => $random], true);
        FileHelper::write(sprintf("%sbusyphp_install.php", $this->dir), "<?php {$header}return {$config};");
        
        $output->info("请访问 http://域名/{$random}/install 进行数据库安装.");
    }
}