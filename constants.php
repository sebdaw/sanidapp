<?php
    define ('ROOT',1);
    define ('ROOT_ROLE',1);
    define ('BLOCK_MNG',1);
    /* BASE DE DATOS ----------------------------------------------- */
    define ('DBMS','mysql');
    define ('HOST','localhost');
    define ('PORT',3306);
    define ('DBNAME','sanidapp');
    define ('DBCHARSET','utf8mb4');
    define ('DBUSER','sanidapp_admin');
    define ('DBPASS','12QWaszx');

    define ('DEFAULT_PAGESIZE',25);
    define ('SUCCESS',1);
    define ('ALL_PAGES',0);

    /* RUTAS ------------------------------------------------------- */
    @define ('PROJECT_PATH',$_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']).'/');
    define ('PATH_SRC',PROJECT_PATH . 'src/');
    define ('PATH_COMPONENTS',PATH_SRC . 'components/');
    define ('PATH_CONTROLLERS',PATH_SRC . 'controllers/');
    define ('PATH_SERVICES',PATH_SRC . 'services/');
    define ('PATH_UTILS',PATH_SRC . 'utils/');
    define ('PATH_TEMPLATES',PATH_SRC . 'templates/');
    define ('PATH_ASSETS',PROJECT_PATH . 'assets/');
    define ('PATH_CSS',PATH_ASSETS . 'css/');
    define ('PATH_JS',PATH_ASSETS . 'js/');
    define ('PATH_DOCS',PATH_ASSETS . 'documents/');
    define ('PATH_IMGS',PATH_ASSETS . 'imgs/');

    $protocol = 'http://';
    $domain = 'localhost/sanidapp/';
    define ('URL_CSS',"{$protocol}{$domain}assets/css/");
    define ('URL_JS',"{$protocol}{$domain}assets/js/");
    define ('URL_DOCS',"{$protocol}{$domain}assets/documents/");
    define ('URL_IMGS',"{$protocol}{$domain}assets/imgs/");
    /* CIFRADOR */
    define ('CYPHER_KEY','-PPLNYQrlrCnYf9kEOmYo8CVbwfbXIzVRx67A15TOpU');
    define ('CYPHER_NONCE','jIXZmqSQ2sgAWM3IYDRytmleuxuwl8u2');

    /* FECHAS */
    define ('DDMMYYYY',0);
    define ('YYYYMMDD',1);

    /* SESIÓN DE USUARIO */
    define ('ID_USER_SESSION','id_user_session');
    define ('USER_SESSION','user_session');
    define ('ROLE_SESSION','role_session');
    define ('PROFILES_SESSION','profiles_session');

    /* PATHS */
    define ('PATH_VAR_CTRL','ctrl');
    define ('PATH_FORM_LOGIN','login');
    define ('PATH_LOGIN','loginsession');
    define ('PATH_LOGOUT','logout');
    define ('PATH_HOME','home');
    define ('PATH_WEB','web');
    define ('PATH_ROLES','roles');
    define ('PATH_ROLES_TABLE','tableroles');
    define ('PATH_ROLE_FORM','roleform');
    define ('PATH_USERS','users');
    define ('PATH_USERS_TABLE','tableusers');
    define ('PATH_USER_FORM','userform');
    define ('PATH_BLOCKS','blocks');
    define ('PATH_BLOCKS_TABLE','tableblocks');
    define ('PATH_BLOCK_FORM','blockform');
    define ('PATH_SECTIONS','sections');
    define ('PATH_SECTIONS_TABLE','tablesections');
    define ('PATH_SECTION_FORM','sectionform');
    define ('PATH_GPR','gpr');
    define ('PATH_GPR_TABLE','tablegpr');
    define ('PATH_GPU','gpu');
    define ('PATH_GPU_TABLE','tablegpu');

    define ('PATH_CENTERS','centers');
    define ('PATH_CENTERS_TABLE','tablecenters');
    define ('PATH_CENTER_FORM','centerform');



    /* TIPOS DE PERMISOS */
    define ('ACC',1);
    define ('INS',2);
    define ('UPD',3);
    define ('DEL',4);
    define ('ORD',5);
    define ('API',6);

    /* SUBTIPOS */
    define ('ORD_UP',501);
    define ('ORD_DOWN',502);

    setlocale(LC_CTYPE,"es_ES");
    date_default_timezone_set("Europe/Madrid");
    mb_internal_encoding("UTF-8");

    /* SUBIDA DE FICHEROS */
    define ('K_EXT',0);
    define ('K_CAT',1);
    define ('K_REN',2);
    define ('V_DOC',0);
    define ('V_COM',1);
    define ('V_AUD',2);
    define ('V_VID',3);
    define ('V_IMG',4);

    define ('CE_UPLOAD_ERR_NO_MATCHING_MIME',0);
    define ('CE_UPLOAD_ERR_NO_EXTENSION',1);
    define ('CE_UPLOAD_ERR_NO_SUPPORTED',2);
    define ('CE_UPLOAD_ERR_NO_MATCHING_EXT',3);
    define ('CE_UPLOAD_ERR_SIZE_OVERFLOW',4);
    define ('CE_UPLOAD_ERR_NAME_GEN',5);
    define ('CE_UPLOAD_ERR_SAVING_FILES',6);

    /* EMAIL */
    define ('EMAIL_DEBUG_MODE','off');
    define ('EMAIL_MESSAGE_TYPES','html');
    define ('EMAIL_DEBUG_OUTPUTS','error_log');
    define ('EMAIL_SMTP_SECURE','tls');
    define ('EMAIL_HOST', 'smtp-mail.outlook.com');
    define ('EMAIL_PORT','587');
    define ('EMAIL_USER_SMTP','sanidapp@outlook.es');
    define ('EMAIL_PASSWORD_SMTP','skeler2024');
    define ('EMAIL_REPLY','sanidapp@outlook.es');
    


?>