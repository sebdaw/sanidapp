<?php
class RolesController extends ViewController {
    protected static ?int $id_section = 2;
    
    public static function main(){
        SessionService::init();
        SessionService::continueSession();

        if (!SessionService::isUserSessionActive()){
            header('Location: login');
            die;
        }

        static::init();
        static::showView('roles-view.php');
    }

    public static function table() {
        static::init();
        SessionService::init();
        SessionService::continueSession();
        $user = SessionService::isUserSessionActive()? $_SESSION[USER_SESSION] : null;
        if (is_null($user) || !static::hasAccessPermission($user->getId())){
            http_response_code(401);
        }else{
            static::showView('roles-table.php');
        }
    }
}
?>