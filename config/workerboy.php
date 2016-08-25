<?php
/**
 * 请参考
 * http://doc3.workerman.net/gateway-worker-development/store-config.html
 * http://doc3.workerman.net/appendices/mysql.html
 */
return array(
    'credential_processor' => 'zgldh\workerboy\CredentialProcessor', //凭证处理器，用于同步web服务器和socket服务器的用户session

    'applications'         => array(        // 请仿照下面将自己建立的Workerman3应用的start.php文件路径填进去
        'app/WorkermanApps/OkCoin/start.php' => array(
            'store' => array(
                'driver'    => 'file',
                // 'file', 'memcache'
                'gateway'   => array(       // 仅对 driver == 'memcache' 启用
                    '127.0.0.1:11211',
                ),
                'room'      => array(      // 仅对 driver == 'memcache' 启用
                    '127.0.0.1:11211',
                ),
                'storePath' => sys_get_temp_dir() . '/workerman-OkCoin/' //每一个application的目录都应该不一样
                // 仅对 driver == 'file' 启用. 默认放在系统临时目录。
            ),
            'db'    => array(    // 不推荐使用Workerman3内置数据库连接。请使用Laravel的Eloquent
                'db1' => array(
                    'host'     => '127.0.0.1',
                    'port'     => 3306,
                    'user'     => 'mysql_user',
                    'password' => 'mysql_password',
                    'dbname'   => 'db1',
                    'charset'  => 'utf8',
                )
            )
        ),
        'app/WorkermanApps/HuoBi/start.php' => array(
            'store' => array(
                'driver'    => 'file',
                // 'file', 'memcache'
                'gateway'   => array(       // 仅对 driver == 'memcache' 启用
                    '127.0.0.1:11211',
                ),
                'room'      => array(      // 仅对 driver == 'memcache' 启用
                    '127.0.0.1:11211',
                ),
                'storePath' => sys_get_temp_dir() . '/workerman-OkCoin/' //每一个application的目录都应该不一样
                // 仅对 driver == 'file' 启用. 默认放在系统临时目录。
            ),
            'db'    => array(    // 不推荐使用Workerman3内置数据库连接。请使用Laravel的Eloquent
                'db1' => array(
                    'host'     => '127.0.0.1',
                    'port'     => 3306,
                    'user'     => 'root',
                    'password' => '123456',
                    'dbname'   => 'db1',
                    'charset'  => 'utf8',
                )
            )
        )
//        ,'app/WorkermanApps/Chat/start.php'=>array(...) 这是第二个应用，请仿照仿照上面填写。但具体地址、路径一定不要完全一样。否则会混乱
    )
);