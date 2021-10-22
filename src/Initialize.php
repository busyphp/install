<?php

namespace BusyPHP\install;

use BusyPHP\App;
use BusyPHP\contract\interfaces\PluginCommandInitialize;
use BusyPHP\helper\FileHelper;
use think\console\Output;
use think\helper\Str;

/**
 * 初始化
 * @author busy^life <busy.life@qq.com>
 * @copyright (c) 2015--2021 ShanXi Han Tuo Technology Co.,Ltd. All rights reserved.
 * @version $Id: 2021/10/22 下午上午9:14 Initialize.php $
 */
class Initialize implements PluginCommandInitialize
{
    /**
     * @var App
     */
    protected $app;
    
    /**
     * Vendor目录
     * @var string
     */
    protected $dir;
    
    
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->dir = $this->app->getRootPath() . 'vendor' . DIRECTORY_SEPARATOR;
    }
    
    
    /**
     * 执行初始化
     * @param Output $output
     */
    public function initialize(Output $output)
    {
        $lockFile = $this->dir . 'busyphp_install.lock';
        if (is_file($lockFile)) {
            return;
        }
        
        // 生成安装配置
        $random = Str::random(6);
        $header = PHP_EOL . '// This file is busyphp/install automatically generated at:' . date('Y-m-d H:i:s') . PHP_EOL . 'declare (strict_types = 1);' . PHP_EOL;
        $config = var_export(['prefix' => $random], true);
        FileHelper::write($this->dir . 'busyphp_install.php', "<?php {$header}return {$config};");
        
        $output->info("请访问 http://域名/{$random}/install 进行数据库安装.");
    }
}