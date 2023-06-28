<?php
return [
    <<<SQL
CREATE TABLE `busy_admin_group` (
    `id`              int(11)      NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `parent_id`       int(11)      NOT NULL DEFAULT '0' COMMENT '上级权限ID',
    `name`            varchar(30)  NOT NULL DEFAULT '' COMMENT '权限名称',
    `default_menu_id` varchar(100) NOT NULL DEFAULT '0' COMMENT '默认菜单',
    `system`          tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否系统权限',
    `rule`            text         NOT NULL COMMENT '权限规则集合，英文逗号分割，左右要有逗号',
    `status`          tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否启用',
    `sort`            smallint(6)  NOT NULL DEFAULT '50' COMMENT '排序',
    `remark`          varchar(500) NOT NULL DEFAULT '' COMMENT '描述',
    PRIMARY KEY (`id`),
    KEY `parent_id` (`parent_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统角色'
SQL,
    
    <<<SQL
CREATE TABLE `busy_admin_user` (
    `id`               int(11)      NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `username`         varchar(30)  NOT NULL DEFAULT '' COMMENT '账号',
    `password`         varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
    `email`            varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
    `phone`            varchar(30)  NOT NULL DEFAULT '' COMMENT '手机号',
    `tel`              varchar(100) NOT NULL DEFAULT '' COMMENT '电话号',
    `qq`               varchar(30)  NOT NULL DEFAULT '' COMMENT 'QQ号码',
    `nickname`         varchar(100) NOT NULL DEFAULT '' COMMENT '昵称',
    `name`             varchar(100) NOT NULL DEFAULT '' COMMENT '姓名',
    `sex`              tinyint(1)   NOT NULL DEFAULT '0' COMMENT '性别',
    `birthday`         date                  DEFAULT NULL COMMENT '出生日期',
    `card_no`          varchar(30)  NOT NULL DEFAULT '' COMMENT '证件号码',
    `avatar`           varchar(500) NOT NULL DEFAULT '' COMMENT '头像',
    `group_ids`        varchar(255) NOT NULL DEFAULT '' COMMENT '权限组ID集合，英文逗号分割，左右要有逗号',
    `default_group_id` int(11)      NOT NULL DEFAULT '0' COMMENT '默认角色组',
    `last_ip`          varchar(40)  NOT NULL DEFAULT '' COMMENT '最后一次登录IP地址',
    `last_time`        int(11)      NOT NULL DEFAULT '0' COMMENT '最后一次登录时间',
    `login_ip`         varchar(40)  NOT NULL DEFAULT '' COMMENT '本次登录IP',
    `login_time`       int(11)      NOT NULL DEFAULT '0' COMMENT '本次登录时间',
    `login_total`      int(11)      NOT NULL DEFAULT '0' COMMENT '登录次数',
    `create_time`      int(11)      NOT NULL DEFAULT '0' COMMENT '创建时间',
    `update_time`      int(11)      NOT NULL DEFAULT '0' COMMENT '更新时间',
    `checked`          tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否审核',
    `system`           tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否系统管理员',
    `error_total`      int(11)      NOT NULL DEFAULT '0' COMMENT '密码错误次数统计',
    `error_time`       int(11)      NOT NULL DEFAULT '0' COMMENT '密码错误开始时间',
    `error_release`    int(11)      NOT NULL DEFAULT '0' COMMENT '密码错误锁定释放时间',
    `theme`            json         DEFAULT NULL COMMENT '主题配置',
    `remark`           varchar(500) NOT NULL DEFAULT '' COMMENT '简介',
    PRIMARY KEY (`id`),
    KEY `username` (`username`),
    KEY `email` (`email`),
    KEY `phone` (`phone`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统用户';
SQL,
    
    <<<SQL
CREATE TABLE `busy_admin_message` (
    `id`          int(11)      NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `user_id`     int(11)      NOT NULL DEFAULT '0' COMMENT '用户ID',
    `user_type`   tinyint(1)   NOT NULL DEFAULT '0' COMMENT '用户类型',
    `type`        tinyint(1)   NOT NULL DEFAULT '0' COMMENT '消息类型',
    `business`    varchar(32)  NOT NULL DEFAULT '' COMMENT '业务参数',
    `create_time` int(11)      NOT NULL DEFAULT '0' COMMENT '创建时间',
    `read`        tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否已读',
    `read_time`   int(11)      NOT NULL DEFAULT '0' COMMENT '阅读时间',
    `content`     json         DEFAULT NULL COMMENT '消息内容',
    `subject`     varchar(255) NOT NULL DEFAULT '' COMMENT '消息描述',
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    KEY `user_type` (`user_type`),
    KEY `type` (`type`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='后台系统消息表';
SQL,
    
    <<<SQL
CREATE TABLE `busy_system_config` (
    `id` varchar(32) NOT NULL COMMENT 'ID',
    `content` json DEFAULT NULL COMMENT '配置',
    `name` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
    `type` varchar(64) NOT NULL DEFAULT '' COMMENT '类型',
    `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '系统配置',
    `append` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否加入全局配置',
    `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
    `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统键值对配置表';
SQL,
    
    <<<SQL
CREATE TABLE `busy_system_file` (
    `id`          int(11)      NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `create_time` int(11)      NOT NULL DEFAULT '0' COMMENT '上传时间',
    `user_id`     int(11)      NOT NULL DEFAULT '0' COMMENT '会员ID',
    `pending`     tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否上传中',
    `fast`        tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否秒传',
    `type`        varchar(20)  NOT NULL DEFAULT '' COMMENT '文件类型',
    `class_type`  varchar(30)  NOT NULL DEFAULT '' COMMENT '文件分类',
    `class_value` varchar(64)  NOT NULL DEFAULT '' COMMENT '文件分类对应的业务值',
    `client`      varchar(32)  NOT NULL DEFAULT '' COMMENT '所属客户端',
    `url`         varchar(255) NOT NULL DEFAULT '' COMMENT '文件地址',
    `url_hash`    varchar(32)  NOT NULL DEFAULT '' COMMENT 'URL HASH',
    `path`        varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
    `disk`        varchar(32)  NOT NULL DEFAULT '' COMMENT '磁盘名称',
    `size`        bigint(20)   NOT NULL DEFAULT '0' COMMENT '文件大小(字节)',
    `mime_type`   varchar(255) NOT NULL DEFAULT '' COMMENT '文件MimeType',
    `extension`   varchar(30)  NOT NULL DEFAULT '' COMMENT '文件扩展名',
    `name`        varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
    `hash`        varchar(32)  NOT NULL DEFAULT '' COMMENT '文件的哈希值',
    `unique_id`   varchar(32)  NOT NULL DEFAULT '' COMMENT '文件唯一码',
    `width`       int(11)      NOT NULL DEFAULT '0' COMMENT '文件宽度(像素)',
    `height`      int(11)      NOT NULL DEFAULT '0' COMMENT '文件高度(像素)',
    PRIMARY KEY (`id`),
    KEY `url_hash` (`url_hash`),
    KEY `hash` (`hash`),
    KEY `user_id` (`user_id`),
    KEY `type` (`type`),
    KEY `class_type` (`class_type`),
    KEY `class_value` (`class_value`),
    KEY `client_type` (`client`),
    KEY `pending` (`pending`),
    KEY `fast` (`fast`),
    KEY `unique_id` (`unique_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统文件表';
SQL,
    
    <<<SQL
CREATE TABLE `busy_system_file_class`
(
    `id`         int(11)       NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `name`       varchar(30)   NOT NULL DEFAULT '' COMMENT '分类名称',
    `var`        varchar(30)   NOT NULL DEFAULT '' COMMENT '分类标识',
    `type`       char(20)      NOT NULL DEFAULT '' COMMENT '附件类型',
    `sort`       smallint(6)   NOT NULL DEFAULT '50' COMMENT '自定义排序',
    `extensions` varchar(255)  NOT NULL DEFAULT '' COMMENT '限制文件格式',
    `max_size`   int(11)       NOT NULL DEFAULT '0' COMMENT '限制文件大小',
    `mimetype`   varchar(1000) NOT NULL DEFAULT '' COMMENT '限制文件mimetype',
    `style`      json                   DEFAULT NULL COMMENT '样式',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统文件分类表';
SQL,
    
    <<<SQL
CREATE TABLE `busy_system_file_image_style`
(
    `id`      varchar(32) NOT NULL COMMENT '样式名',
    `content` json DEFAULT NULL COMMENT '样式内容',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统图片样式表';
SQL,
    
    <<<SQL
CREATE TABLE `busy_system_lock`
(
    `id`     varchar(32)  NOT NULL COMMENT 'ID',
    `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统锁表';
SQL,
    
    <<<SQL
CREATE TABLE `busy_system_logs`
(
    `id`          bigint(20)   NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `create_time` int(11)      NOT NULL DEFAULT '0' COMMENT '操作时间',
    `type`        tinyint(1)   NOT NULL DEFAULT '0' COMMENT '操作类型',
    `level`       tinyint(1)   NOT NULL DEFAULT '0' COMMENT '日志级别',
    `name`        varchar(255) NOT NULL DEFAULT '' COMMENT '操作名称',
    `user_id`     int(11)      NOT NULL DEFAULT '0' COMMENT '操作用户ID',
    `username`    varchar(60)  NOT NULL DEFAULT '' COMMENT '操作用户名',
    `class_type`  varchar(32)  NOT NULL DEFAULT '' COMMENT '日志分类',
    `class_value` varchar(32)  NOT NULL DEFAULT '' COMMENT '日志分类业务参数',
    `client`      varchar(32)  NOT NULL DEFAULT '' COMMENT '操作客户端',
    `ip`          varchar(40)  NOT NULL DEFAULT '' COMMENT '客户端IP',
    `method`      varchar(20)  NOT NULL DEFAULT '' COMMENT '请求方式',
    `url`         text         NOT NULL COMMENT '请求URL',
    `params`      text         NOT NULL COMMENT '请求参数',
    `headers`     text         NOT NULL COMMENT '请求头',
    `result`      text         NOT NULL COMMENT '操作结果',
    PRIMARY KEY (`id`),
    KEY `type` (`type`),
    KEY `class_value` (`class_value`),
    KEY `class_type` (`class_type`),
    KEY `level` (`level`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COMMENT ='操作记录表';
SQL,
    
    <<<SQL
CREATE TABLE `busy_system_menu`
(
    `id`          int(11)      NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `name`        varchar(30)  NOT NULL DEFAULT '' COMMENT '名称',
    `path`        varchar(255) NOT NULL DEFAULT '' COMMENT '路由地址',
    `parent_path` varchar(255) NOT NULL DEFAULT '' COMMENT '上级路由',
    `top_path`    varchar(255) NOT NULL DEFAULT '' COMMENT '顶级菜单默认访问路由地址',
    `params`      varchar(255) NOT NULL DEFAULT '' COMMENT '附加参数',
    `icon`        varchar(128) NOT NULL DEFAULT '' COMMENT '图标',
    `target`      varchar(10)  NOT NULL DEFAULT '' COMMENT '打开方式',
    `hide`        tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否隐藏',
    `disabled`    tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否禁用',
    `sort`        smallint(6)  NOT NULL DEFAULT '50' COMMENT '自定义排序',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统菜单表';
SQL,
    
    <<<SQL
CREATE TABLE `busy_system_plugin`
(
    `id`          varchar(32)  NOT NULL COMMENT '包名HASH',
    `package`     varchar(255) NOT NULL DEFAULT '' COMMENT '包名',
    `create_time` int(11)      NOT NULL DEFAULT '0' COMMENT '创建时间',
    `update_time` int(11)      NOT NULL DEFAULT '0' COMMENT '更新时间',
    `install`     tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否已安装',
    `panel`       tinyint(1)   NOT NULL DEFAULT '0' COMMENT '是否在主页展示',
    `setting`     text         NOT NULL COMMENT '设置参数',
    `sort`        int(11)      NOT NULL DEFAULT '50' COMMENT '排序',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统插件表'
SQL,

    <<<SQL
CREATE TABLE `busy_system_task`
(
    `id`          varchar(32)    NOT NULL COMMENT 'ID',
    `title`       varchar(100)   NOT NULL DEFAULT '' COMMENT '任务名称',
    `command`     varchar(500)   NOT NULL DEFAULT '' COMMENT '执行指令',
    `pid`         int(11)        NOT NULL DEFAULT '0' COMMENT '进程ID',
    `loops`       int(11)        NOT NULL DEFAULT '0' COMMENT '重复间隔秒数',
    `attempts`    int(11)        NOT NULL DEFAULT '0' COMMENT '累计执行次数',
    `status`      tinyint(1)     NOT NULL DEFAULT '0' COMMENT '任务状态:0待执行,1执行中,2已完成,3待重执',
    `plan_time`   int(11)        NOT NULL DEFAULT '0' COMMENT '计划执行时间',
    `start_time`  decimal(14, 4) NOT NULL DEFAULT '0.0000' COMMENT '开始执行时间',
    `end_time`    decimal(14, 4) NOT NULL DEFAULT '0.0000' COMMENT '结束执行时间',
    `create_time` int(11)        NOT NULL DEFAULT '0' COMMENT '创建时间',
    `data`        longtext COMMENT '执行数据',
    `success`     tinyint(1)     NOT NULL DEFAULT '0' COMMENT '是否执行成功',
    `operate`     json                    DEFAULT NULL COMMENT '成功操作',
    `result`      varchar(500)   NOT NULL DEFAULT '' COMMENT '执行结果',
    `remark`      varchar(500)   NOT NULL DEFAULT '' COMMENT '执行备注',
    PRIMARY KEY (`id`),
    KEY `status` (`status`),
    KEY `plan_time` (`plan_time`),
    KEY `scan` (`status`, `plan_time`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统任务表'
SQL,

    <<<SQL
CREATE TABLE `busy_system_token`
(
    `id`          varchar(32) NOT NULL COMMENT 'ID',
    `user_type`   tinyint(1)  NOT NULL DEFAULT '0' COMMENT '用户类型',
    `user_id`     int(11)     NOT NULL DEFAULT '0' COMMENT '用户ID',
    `token`       varchar(64) NOT NULL DEFAULT '' COMMENT '密钥',
    `type`        tinyint(1)  NOT NULL DEFAULT '0' COMMENT '登录类型',
    `create_time` int(11)     NOT NULL DEFAULT '0' COMMENT '创建时间',
    `login_time`  int(11)     NOT NULL DEFAULT '0' COMMENT '本次登录时间',
    `login_ip`    varchar(64) NOT NULL DEFAULT '' COMMENT '本次登录IP',
    `last_time`   int(11)     NOT NULL DEFAULT '0' COMMENT '上次登录时间',
    `last_ip`     varchar(64) NOT NULL DEFAULT '' COMMENT '上次登录IP',
    `login_total` int(11)     NOT NULL DEFAULT '0' COMMENT '登录次数',
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    KEY `type` (`type`),
    KEY `user_type` (`user_type`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COMMENT ='系统任务表'
SQL,
    
    <<<SQL
INSERT INTO `busy_admin_group` (`parent_id`, `name`, `default_menu_id`, `system`, `rule`, `status`, `sort`, `remark`) VALUES (0, '超级管理员', '0efec22100364a634ea2019a3327a051', 1, '', 1, 0, '超级管理员角色，拥有所有操作权限')
SQL,
    
    <<<SQL
INSERT INTO `busy_admin_user` (`username`, `password`, `group_ids`, `default_group_id`, `create_time`, `update_time`, `checked`, `system`) VALUES ('#__username__#', '#__password__#', ',1,', 1, '#__create_time__#', '#__create_time__#', 1, 1)
SQL,
    
    <<<SQL
INSERT INTO `busy_system_config` (`id`, `content`, `name`, `type`, `system`, `append`, `create_time`, `update_time`) VALUES
('4c9184f37cff01bcdc32dc486ec36961', '{\"title\": \"\", \"icp_no\": \"\", \"favicon\": \"\", \"copyright\": \"\", \"police_no\": \"\", \"image_placeholder\": \"\", \"avatar_placeholder\": \"\"}', '系统基本配置', 'public', 1, 1, '#__create_time__#', 0),
('21232f297a57a5a743894a0e4a801fc3', '{\"often\": 0, \"title\": \"\", \"verify\": true, \"login_bg\": \"\", \"logo_icon\": \"\", \"watermark\": {\"x\": \"0\", \"y\": \"60\", \"txt\": \"登录人：{username}\\r\\n内部系统，严禁拍照，截图\\r\\n{time}\", \"font\": \"\", \"alpha\": \"0.1\", \"angle\": \"-15\", \"color\": \"#000000\", \"image\": \"\", \"width\": \"300\", \"height\": \"150\", \"imageX\": \"100\", \"imageY\": \"5\", \"status\": \"0\", \"fontSize\": \"16\", \"imageWidth\": \"60\", \"timeFormat\": \"YYYY-MM-DD HH:mm:ss\", \"imageHeight\": \"20\"}, \"save_login\": 15, \"login_error_max\": 5, \"logo_horizontal\": \"\", \"multiple_client\": true, \"login_error_minute\": 5, \"login_error_lock_minute\": 60}', '后台面板配置', 'admin', 1, 0, '#__create_time__#', 0),
('ddecebdea58b5f264d27f1f7909bab74', '{\"disk\": \"public\", \"clients\": {\"home\": {\"max_size\": \"10.00\", \"allow_extensions\": \"jpg, jpeg, png, gif\"}, \"admin\": {\"max_size\": \"500.00\", \"allow_extensions\": \"jpg, jpeg, png, gif, webp, ico, mp3, mp4, zip, rar, doc, docx, xls, xlsx, ttf\"}}, \"dir_generate_type\": \"hash-3\", \"remote_ignore_domains\": \"\"}', '系统存储配置', 'storage', 1, 0, '#__create_time__#', 0),
('70b29c4920daf4e51e8175179027e668', '{\"clients\": {\"home\": {\"code\": \"\", \"font\": \"\", \"type\": \"\", \"curve\": true, \"noise\": true, \"token\": \"\", \"length\": \"\", \"bg_color\": \"\", \"bg_image\": false, \"font_file\": \"\", \"font_size\": \"\", \"expire_minute\": \"\"}, \"admin\": {\"code\": \"\", \"font\": \"\", \"type\": \"\", \"curve\": true, \"noise\": true, \"token\": \"\", \"length\": \"\", \"bg_color\": \"\", \"bg_image\": false, \"font_file\": \"\", \"font_size\": \"\", \"expire_minute\": \"\"}}}', '图片验证码配置', 'captcha', 1, 0, '#__create_time__#', 0)
SQL
];