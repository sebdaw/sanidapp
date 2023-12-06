<?php
abstract class ViewController extends BaseController{

    public static function redirectToLogin(){
        header('Location:' . PATH_FORM_LOGIN);
    }

    public static function showView(?string $view=null, array $data=[]){
        if (is_null($view) && !@file_exists(PATH_TEMPLATES . $view)){
            http_response_code(404);
            exit;
        }
        static::init();
        $_user_session = !is_null(static::$id_section)? $_SESSION[USER_SESSION] : null;
        $_section = !is_null(static::$id_section)? (fn($n):?Section=>$n)(static::$sdao->findById(id:static::$id_section)) : null;
        $_block = !is_null($_section)? static::$bdao->findById($_section->getIdBlock()) : null;
        $_section_permissions = !is_null(static::$id_section)? static::$pcontroller->getSectionPermissions(idUser:$_user_session->getId(),idSection:static::$id_section) : null;
        require_once PATH_TEMPLATES . $view;
    }
}
?>