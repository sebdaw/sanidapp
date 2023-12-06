<?php
class RolesPermissionsController extends ViewController {
    protected static ?int $id_section = 1;
    protected const FOLDER = 'users/';
    
    public static function main(){
        static::init();
        SessionService::init();
        SessionService::continueSession();
        $user = SessionService::isUserSessionActive()? $_SESSION[USER_SESSION] : null;

        if (!SessionService::isUserSessionActive()){
            static::redirectToLogin();
            die;
        }

        // Si no tiene acceso a la sección
        if (!static::hasAccessPermission($user->getId())){
            http_response_code(401);
            die;
        }

        $data = file_get_contents('php://input');
        $data = json_decode($data,associative:true,flags:JSON_UNESCAPED_UNICODE);
        $action = (isset($data['action']) && Validations::isInteger($data['action']))? intval($data['action']) : null;

        // Si no se obtiene ningún código de acción, se muestra la vista de roles.
        if (is_null($action)){
            static::showView(static::FOLDER . 'gpr-view.php');
            die;
        }

        // Si se obtiene un código de acción, se realiza la acción correspondiente. En este caso se devuelve un json
        switch($action){
        case UPD:
            if (!static::hasUpdatePermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (static::update($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Permisos editados con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando editar los permisos'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        default:
            http_response_code(501);
        }
    }

    public static function table() {
        static::init();
        SessionService::init();
        SessionService::continueSession();
        $user = SessionService::isUserSessionActive()? $_SESSION[USER_SESSION] : null;
        if (is_null($user) || !static::hasAccessPermission($user->getId())){
            http_response_code(401);
        }else{
            static::showView(static::FOLDER . 'gpr-table.php');
        }
    }


 

    protected static function update(mixed $data) : bool {
        // // validación de formato de id
        // $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        // if (is_null($id))
        //     return false;
        
        // // validación de rolename
        // $username = (isset($data['username']) && is_string($data['username']) && mb_strlen(trim($data['username']))>0)? trim($data['username']) : null;
        // if (is_null($username))
        //     return false;

        // $udao = new UsersDAO(connection:static::$connection);
        // // validamos que el usuario exista
        // if (is_null($udao->findById(id:$id)))
        //     return false;

        // // validamos que no exista otro usuario con el nuevo nombre
        // $user_db = $udao->findByUsername(username:$username);
        // if (!is_null($user_db) && $user_db->getId()!=$id)
        //     return false;

        // $rdao = new RolesDAO(connection:static::$connection);
        // $idRole = (isset($data['role']) && Validations::isInteger($data['role'],strict:true))? intval($data['role']) : null;
        // $role = $rdao->findById(id:$idRole);
        // if (is_null($role) || $idRole==ROOT_ROLE)
        //     return null;

        // $active = (isset($data['active']) && is_bool($data['active']))? boolval($data['active']) : null;        

        // $password = (isset($data['password']) && is_string($data['password']) && mb_strlen(trim($data['password']))>0)? trim($data['password']) : null;
        // $password_confirmation = (isset($data['password_confirmation']) && is_string($data['password_confirmation']))? trim($data['password_confirmation']) : null;
        // if (!is_null($password) && ($password!=$password_confirmation))
        //     return null;
        // $password = !is_null($password)? PasswordHasher::hash(password:$password) : null;

        // $dto = new UserDTO;
        // $dto->setId(id:$id);
        // $dto->setUsername(username:$username);
        // $dto->setPassword(password:$password);
        // $dto->setActive(active:$active);
        // $dto->setTimestamp(timestamp:time());
        // $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);
        // return $udao->update(dto:$dto);
        return false;
    }


}
?>