<?php
class LoginController extends ViewController {
    protected static ?int $id_section = null;

    public static function main(array $params=[]){
        // Obtener permisos usuario
        // Control de navegacion
        // Gestion permisos listado/mto/acciones
        // Carga de librerias
        if (empty($params))
            static::showView('login-form-view.php');
        else
            static::showView('signup-form-view.php');
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

    public static function signUp() : void {
        $data = file_get_contents('php://input');
        $data = json_decode($data,associative:true,flags:JSON_UNESCAPED_UNICODE);
        if (!isset($data['username']) || 
            !isset($data['password']) || 
            !isset($data['password2']) ||
            !isset($data['email'])){
            http_response_code(400);
            $json = json_encode(['msg'=>'No se han enviado los campos requeridos.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }
        $username = $data['username'];
        $password = $data['password'];
        $password2 = $data['password2'];
        $email = $data['email'];

        if (!is_string($username) || !is_string($password) || !is_string($password2) || !is_string($email)){
            http_response_code(400);
            $json = json_encode(['msg'=>'El tipo de los campos es inválido'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }

        $username = trim($username);
        $password = trim($password);
        $password2 = trim($password2);
        $email = trim($email);

        if ($username=='' || $password==''){
            http_response_code(400);
            $json = json_encode(['msg'=>'El nombre de usuario y la contraseña no pueden estar vacíos.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }

        if ($password != $password2){
            http_response_code(400);
            $json = json_encode(['msg'=>'La contraseña y su confirmación no coinciden.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }

        if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            http_response_code(400);
            $json = json_encode(['msg'=>'El email no tiene un formato correcto.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }

        $udao = new UsersDAO(connection:static::$connection);
        $dto = new UserDTO;
        $dto->setUsername($username);
        $users = $udao->findAll(dto:$dto);
        if (!empty($users)){
            http_response_code(400);
            $json = json_encode(['msg'=>'Ya existe un usuario con ese alias.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }


        $hash = PasswordHasher::hash($password);
        $dto->setPassword(password:$hash);
        $dto->setIdRole(idRole:DEFAULT_ROLE);
        $dto->setDate(from:time());
        $dto->setActive(false);
        $dto->setTimestamp(time());
        $dto->setIdUpdater(ROOT);
        $id = $udao->insert(dto:$dto);

        if (is_null($id)){
            http_response_code(500);
            $json = json_encode(['msg'=>'Ha ocurrido un error en el registro.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            echo $json;
            exit;
        }

        $mailer = new SignUpMail($id,$username);
        $mailer->setSubject('Registro Sanidapp');
        $mailer->addTo($email);
        if ($mailer->send()){
            http_response_code(200);
            $json = json_encode(['msg'=>'Se ha enviado un correo con el enlace de activación.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
        }else{ 
            http_response_code(500);
            $json = json_encode(['msg'=>'Ha ocurrido un error en el envío del correo de confirmación.'],flags:JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
        }
        echo $json;
    }

    public static function activation(){
        $token = isset($_GET['token']) && !empty($_GET['token'])? $_GET['token'] : null;
        if (is_null($token)){
            http_response_code(400);
            exit;
        }

        $cipher = new Cipher;
        $id = $cipher->decrypt($token);

        if (!Validations::isInteger($id)){
            http_response_code(400);
            exit;
        }

        $udao = new UsersDAO;
        $user = $udao->findById($id);

        if (is_null($user)){
            http_response_code(500);
            exit;
        }

        $dto = new UserDTO;
        $dto->setId($id);
        $dto->setActive(true);
        $dto->setTimestamp(time());
        $dto->setIdUpdater(ROOT);

        if (!$udao->update(dto:$dto)){
            http_response_code(500);
            exit;
        }

        static::showView('login-form-view.php');
    }

    public static function logout() : void {
        SessionService::init();
        SessionService::closeSession();
        header('Location: ' . PATH_FORM_LOGIN);
        die;
    }
}
?>