<?php
abstract class BaseController {
    protected static ?int $id_section = null;
    protected static ?PermissionController $pcontroller = null;
    protected static ?BlocksDAO $bdao = null;
    protected static ?SectionDAO $sdao = null;

    protected static function init(?DBConnection $connection=null){
        $connection = is_null($connection)? new DBConnection() : $connection;
        static::$pcontroller = new PermissionController(connection:$connection);
        static::$bdao = new BlocksDAO(connection:$connection);
        static::$sdao = new SectionDAO(connection:$connection);
    }

    protected static function hasAccessPermission(int $idUser) : bool {
        return static::hasPermission(idUser:$idUser,idType:ACC);
    }
    protected static function hasInsertPermission(int $idUser) : bool {
        return static::hasPermission(idUser:$idUser,idType:INS);
    }
    protected static function hasUpdatePermission(int $idUser) : bool {
        return static::hasPermission(idUser:$idUser,idType:UPD);
    }
    protected static function hasDeletePermission(int $idUser) : bool {
        return static::hasPermission(idUser:$idUser,idType:DEL);
    }

    protected static function hasPermission(int $idUser, int $idType) : bool {
        // Si un controlador no tiene ningún id de sección asignado, se considera que no necesita validación de permisos
        if (is_null(static::$id_section))
            return true;

        if (static::$pcontroller->hasPermission(idUser:$idUser,idSection:static::$id_section,idType:$idType))
            return true;
        return false;
    }

    abstract public static function main();
}
?>