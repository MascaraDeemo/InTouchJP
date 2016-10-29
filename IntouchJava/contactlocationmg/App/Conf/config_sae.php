<?php
return array(
    'TMPL_PARSE_STRING' => array(
        // __PUBLIC__/upload  -->  /Public/upload -->http://appname-public.stor.sinaapp.com/upload
        '/Public/upload' => sae_storage_root('Public') . '/upload',
        'TMPL_L_DELIM' => '<{',
        'TMPL_R_DELIM' => '}>',
        'DB_TYPE' => 'mysql',
        'DB_HOST' => SAE_MYSQL_HOST_M,
        'DB_NAME' => SAE_MYSQL_DB,
        'DB_USER' => SAE_MYSQL_USER,
        'DB_PWD' => SAE_MYSQL_PASS,
        'DB_PORT' => SAE_MYSQL_PORT,
        'DB_PREFIX' => 't_',
        'TMPL_TEMPLATE_SUFFIX' => '.html',
        'SHOW_PAGE_TRACE' => false,
    )
);