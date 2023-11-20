<?php
class HomeController extends ViewController {
    protected static ?int $id_section = null;
    
    public static function main(){
        SessionService::init();
        SessionService::continueSession();

        if (!SessionService::isUserSessionActive()){
            header('Location: login');
            die;
        }

        static::init();
        static::showView('home-view.php');
    }
}
?>