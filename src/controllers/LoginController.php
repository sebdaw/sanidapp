<?php
class LoginController extends ViewController {
    protected static ?int $id_section = null;

    public static function main(){
        // Obtener permisos usuario
        // Control de navegacion
        // Gestion permisos listado/mto/acciones
        // Carga de librerias
        static::showView('login-form-view.php');
    }

    public static function login() : void {
        $data = file_get_contents('php://input');
        $data = json_decode($data,associative:true,flags:JSON_UNESCAPED_UNICODE);
        if (!isset($data['username']) || !isset($data['password'])){
            http_response_code(400);
            $json = json_encode(['msg'=>'No se han enviado los campos requeridos.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }
        $username = $data['username'];
        $password = $data['password'];

        if (!is_string($username) || !is_string($password)){
            http_response_code(400);
            $json = json_encode(['msg'=>'El tipo de los campos es inválido'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }

        if (trim($username)=='' || trim($password)==''){
            http_response_code(400);
            $json = json_encode(['msg'=>'El nombre de usuario y la contraseña no pueden estar vacíos.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }

        $dto = new UserDTO;
        $dto->setUsername(username:$username);
        $dto->setPassword(password:$password);

        SessionService::init();
        if (SessionService::logIn(dto:$dto)){
            http_response_code(200);
            $json = json_encode(['msg'=>'Sesión iniciada con éxito', 'url'=>'home'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
        }else{
            http_response_code(403);
            $json = json_encode(['msg'=>'No se ha podido iniciar sesión'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
        }
    }

    public static function logout() : void {
        SessionService::init();
        SessionService::closeSession();
        header('Location: ' . PATH_FORM_LOGIN);
        die;
    }
}
?>