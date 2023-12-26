<?php
//TODO: definir constantes y rutas
$ctrl = (isset($_REQUEST[PATH_VAR_CTRL]) && (mb_strlen(trim($_REQUEST[PATH_VAR_CTRL])) != 0))? trim($_REQUEST[PATH_VAR_CTRL]) : PATH_HOME;

$routes = [
    'main' => [
        'controller' => 'ViewController',
        'method' => 'showView',
        'params' => 'main-view.php'
    ],
    PATH_HOME => [
        'controller' => 'HomeController',
        'method' => 'main',
        'params' => []
    ],
    PATH_ROLES => [
        'controller' => 'RolesController',
        'method' => 'main',
        'params' => []
    ],
    PATH_ROLES_TABLE => [
        'controller' => 'RolesController',
        'method' => 'table',
        'params' => []
    ],
    PATH_ROLE_FORM => [
        'controller' => 'RolesController',
        'method' => 'form',
        'params' => []
    ],
    PATH_USERS => [
        'controller' => 'UsersController',
        'method' => 'main',
        'params' => []
    ],
    PATH_USERS_TABLE => [
        'controller' => 'UsersController',
        'method' => 'table',
        'params' => []
    ],
    PATH_USER_FORM => [
        'controller' => 'UsersController',
        'method' => 'form',
        'params' => []
    ],
    PATH_BLOCKS => [
        'controller' => 'BlocksController',
        'method' => 'main',
        'params' => []
    ],
    PATH_BLOCKS_TABLE => [
        'controller' => 'BlocksController',
        'method' => 'table',
        'params' => []
    ],
    PATH_BLOCK_FORM => [
        'controller' => 'BlocksController',
        'method' => 'form',
        'params' => []
    ],
    PATH_SECTIONS => [
        'controller' => 'SectionsController',
        'method' => 'main',
        'params' => []
    ],
    PATH_SECTIONS_TABLE => [
        'controller' => 'SectionsController',
        'method' => 'table',
        'params' => []
    ],
    PATH_SECTION_FORM => [
        'controller' => 'SectionsController',
        'method' => 'form',
        'params' => []
    ],
    PATH_GPR => [
        'controller' => 'RolePermissionController',
        'method' => 'main',
        'params' => []
    ],
    PATH_GPR_TABLE => [
        'controller' => 'RolePermissionController',
        'method' => 'table',
        'params' => []
    ],
    PATH_GPU => [
        'controller' => 'UserPermissionController',
        'method' => 'main',
        'params' => []
    ],
    PATH_GPU_TABLE => [
        'controller' => 'UserPermissionController',
        'method' => 'table',
        'params' => []
    ],
    PATH_FORM_LOGIN => [
        'controller' => 'LoginController',
        'method' => 'main',
        'params' => []
    ],
    PATH_LOGIN => [
        'controller' => 'LoginController',
        'method' => 'login',
        'params' => []
    ],
    PATH_LOGOUT => [
        'controller' => 'LoginController',
        'method' => 'logout',
        'params' => []
    ]
];

$ctrl = array_key_exists($ctrl,$routes)? $ctrl : PATH_HOME;
$controller = $routes[$ctrl]['controller'];
$method = $routes[$ctrl]['method'];
$params = $routes[$ctrl]['params'];
call_user_func(array($controller,$method),$params);
?>