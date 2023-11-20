<?php
class SessionService {
    private static ?UsersDAO $udao = null;
    private static ?RolesDAO $rdao = null;
    private static ?ProfileController $pctrl = null;
    private const DEFAULT_SESSION_NAME = 'PHPSESSID';
    private const LIFETIME = 600; // 5 minutos
    private const PATH = '/';
    private const DOMAIN = 'localhost';

    public static function init() : void {
        $connection = new DBConnection;
        if (is_null(self::$udao))
            static::$udao = new UsersDAO(connection:$connection);
        if (is_null(self::$rdao))
            static::$rdao = new RolesDAO(connection:$connection);
        if (is_null(self::$pctrl))
            static::$pctrl = new ProfileController(connection:$connection);
    }

    public static function continueSession() {
        if (static::isUserSessionActive()){
            // Refresca la sesión
            setcookie(self::DEFAULT_SESSION_NAME,value:$_COOKIE[self::DEFAULT_SESSION_NAME],expires_or_options:time()+self::LIFETIME,path:self::PATH,domain:self::DOMAIN);
        }
        @session_start();
    }

    private static function _logIn(UserDTO $dto) : bool {
        $logged = false;
        $column = $dto->getUsername();
        $user = self::$udao->findByUsername(username:$column->getValue());
        if (is_null($user))
            return false;

        if (!$user->isActive() || $user->isDeleted())
            return false;

        $role = self::$rdao->findById(id:$user->getIdRole());
        if (is_null($role))
            return false;

        $password_in = $dto->getPassword()->getValue();
        $password_bd = $user->getPassword();
        if (PasswordHasher::verify($password_in,$password_bd)){
            if (self::isAnySessionActive())
                self::_closeSession();       
            @session_set_cookie_params(lifetime_or_options:self::LIFETIME,path:self::PATH,domain:self::DOMAIN);
            @session_name(self::DEFAULT_SESSION_NAME);
            @session_id($user->getUsername());
            @session_start();
            //TODO: añadir a la variable de sessión los datos del usuario
            $profiles = self::$pctrl->getProfiles(idUser:$user->getId());
            $_SESSION[USER_SESSION] = $user;
            $_SESSION[ROLE_SESSION] = $role;
            $_SESSION[PROFILES_SESSION] = $profiles;
            $logged = true;
        }else{
            //TODO: registrar log
        }
        
        return $logged;
    }

    public static function logIn(UserDTO $dto) : bool {
        return self::_logIn($dto);
    }

    public static function getCurrentUser() : ?UserProfilesBO {
        $bo = null;
        if (self::isUserSessionActive()){
            $bo = new UserProfilesBO(user:$_SESSION[USER_SESSION],role:$_SESSION[ROLE_SESSION],profiles:$_SESSION[PROFILES_SESSION]);
        }
        return $bo;
    }

    public static function isAnySessionActive() : bool {
        return (@session_status() == PHP_SESSION_ACTIVE);
    }

    public static function isUserSessionActive() : bool {
        if (!isset($_COOKIE[self::DEFAULT_SESSION_NAME]) || (mb_strlen($_COOKIE[self::DEFAULT_SESSION_NAME]) == 0))
            return false;
        $sessid = $_COOKIE[self::DEFAULT_SESSION_NAME];
        $user = self::$udao->findByUsername($sessid);
        return (!is_null($user));
    }

    private static function _closeSession() : void {
        @session_unset();
        @setcookie(name:session_name(),value:'',expires_or_options:time()-999999,path:self::PATH,domain:self::DOMAIN);
        @session_destroy();
    }

    public static function closeSession() : void {
        self::_closeSession();
    }
}
?>