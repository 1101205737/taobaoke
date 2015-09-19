<?php

return array(
    //'配置项'=>'配置值'	
    'URL_MODEL' => '0',
    'URL_CASE_INSENSITIVE' => true, // 默认false 表示URL区分大小写 true则表示不区分大小写
    'DEFAULT_THEME' => 'wh', // 默认模板主题名称
    'TMPL_FILE_DEPR' => '/', //模板文件MODULE_NAME与ACTION_NAME之间的分割符
    'DEFAULT_LANG' => 'zh-cn', //默认语言包
    'LANG_SWITCH_ON' => true, //语言包
    'LANG_AUTO_DETECT' => true, //语言包
    'TOKEN_ON' => true, // 是否开启令牌验证
    'TOKEN_NAME' => '__hash__', // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE' => 'md5', //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET' => true, //令牌验证出错后是否重置令牌 默认为true
    'LOG_RECORD' => false, // 开启日志记录
    //
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => '#DB_HOST#', // 服务器地址
    'DB_NAME' => '#DB_NAME#', // 数据库名
    'DB_USER' => '#DB_USER#', // 用户名
    'DB_PWD' => '#DB_PWD#', // 密码
    'DB_PORT' => '#DB_PORT#', // 端口
    'DB_PREFIX' => '#DB_PREFIX#', // 数据库表前缀	
);
?>