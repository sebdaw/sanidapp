<?php 
class Autoload {
    private static array $locations;

    public static function init(){
        static::$locations = array();
        static::$locations[] = PATH_COMPONENTS;
        static::$locations[] = PATH_CONTROLLERS;
        static::$locations[] = PATH_SERVICES;
        static::$locations[] = PATH_UTILS;
        static::$locations[] = PATH_TEMPLATES;

        static::$locations[] = PATH_COMPONENTS . 'base/';
        static::$locations[] = PATH_COMPONENTS . 'base/dao/';
        static::$locations[] = PATH_COMPONENTS . 'base/dto/';
        static::$locations[] = PATH_COMPONENTS . 'base/models/';
        static::$locations[] = PATH_COMPONENTS . 'users/';
        static::$locations[] = PATH_COMPONENTS . 'users/dao/';
        static::$locations[] = PATH_COMPONENTS . 'users/dto/';
        static::$locations[] = PATH_COMPONENTS . 'users/models/';
        static::$locations[] = PATH_COMPONENTS . 'roles/';
        static::$locations[] = PATH_COMPONENTS . 'roles/dao/';
        static::$locations[] = PATH_COMPONENTS . 'roles/dto/';
        static::$locations[] = PATH_COMPONENTS . 'roles/models/';
        static::$locations[] = PATH_COMPONENTS . 'sections/';
        static::$locations[] = PATH_COMPONENTS . 'sections/dao/';
        static::$locations[] = PATH_COMPONENTS . 'sections/dto/';
        static::$locations[] = PATH_COMPONENTS . 'sections/models/';
        static::$locations[] = PATH_COMPONENTS . 'blocks/';
        static::$locations[] = PATH_COMPONENTS . 'blocks/dao/';
        static::$locations[] = PATH_COMPONENTS . 'blocks/dto/';
        static::$locations[] = PATH_COMPONENTS . 'blocks/models/';
        static::$locations[] = PATH_COMPONENTS . 'locations/';
        static::$locations[] = PATH_COMPONENTS . 'locations/dao/';
        static::$locations[] = PATH_COMPONENTS . 'locations/dto/';
        static::$locations[] = PATH_COMPONENTS . 'locations/models/';
        static::$locations[] = PATH_COMPONENTS . 'permissions/';
        static::$locations[] = PATH_COMPONENTS . 'permissions/bo/';
        static::$locations[] = PATH_COMPONENTS . 'permissions/dao/';
        static::$locations[] = PATH_COMPONENTS . 'permissions/dto/';
        static::$locations[] = PATH_COMPONENTS . 'permissions/models/';
        static::$locations[] = PATH_COMPONENTS . 'permissions/controller/';
        static::$locations[] = PATH_COMPONENTS . 'profiles/';
        static::$locations[] = PATH_COMPONENTS . 'profiles/bo/';
        static::$locations[] = PATH_COMPONENTS . 'profiles/dao/';
        static::$locations[] = PATH_COMPONENTS . 'profiles/dto/';
        static::$locations[] = PATH_COMPONENTS . 'profiles/models/';
        static::$locations[] = PATH_COMPONENTS . 'profiles/controller/';
        static::$locations[] = PATH_COMPONENTS . 'media/';
        static::$locations[] = PATH_COMPONENTS . 'media/bo/';
        static::$locations[] = PATH_COMPONENTS . 'media/dao/';
        static::$locations[] = PATH_COMPONENTS . 'media/dto/';
        static::$locations[] = PATH_COMPONENTS . 'media/models/';
        static::$locations[] = PATH_COMPONENTS . 'media/controller/';
        static::$locations[] = PATH_COMPONENTS . 'medical-cs/';
        static::$locations[] = PATH_COMPONENTS . 'medical-cs/bo/';
        static::$locations[] = PATH_COMPONENTS . 'medical-cs/dao/';
        static::$locations[] = PATH_COMPONENTS . 'medical-cs/dto/';
        static::$locations[] = PATH_COMPONENTS . 'medical-cs/models/';
        static::$locations[] = PATH_COMPONENTS . 'medical-cs/controller/';
        static::$locations[] = PATH_COMPONENTS . 'medical-staff/';
        static::$locations[] = PATH_COMPONENTS . 'medical-staff/bo/';
        static::$locations[] = PATH_COMPONENTS . 'medical-staff/dao/';
        static::$locations[] = PATH_COMPONENTS . 'medical-staff/dto/';
        static::$locations[] = PATH_COMPONENTS . 'medical-staff/models/';
        static::$locations[] = PATH_COMPONENTS . 'medical-staff/controller/';
        static::$locations[] = PATH_COMPONENTS . 'patients/';
        static::$locations[] = PATH_COMPONENTS . 'patients/bo/';
        static::$locations[] = PATH_COMPONENTS . 'patients/dao/';
        static::$locations[] = PATH_COMPONENTS . 'patients/dto/';
        static::$locations[] = PATH_COMPONENTS . 'patients/models/';
        static::$locations[] = PATH_COMPONENTS . 'patients/controller/';
        



        static::$locations[] = PATH_CONTROLLERS . 'base/';
        static::$locations[] = PATH_TEMPLATES . 'base/';



        static::register();
    }

    private static function register(){
        spl_autoload_register(function($filename){
            foreach(static::$locations as $location){
                $path = "{$location}{$filename}.php";
                if (file_exists($path))
                    require_once $path;
            }
        });
    }
}
?>