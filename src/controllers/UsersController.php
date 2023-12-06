<?php
class UsersController extends ViewController {
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
            static::showView(static::FOLDER . 'users-view.php');
            die;
        }

        // Si se obtiene un código de acción, se realiza la acción correspondiente. En este caso se devuelve un json
        switch($action){
        case DEL:
            // Si no tiene acceso a la sección
            if (!static::hasDeletePermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (static::deleteUser($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Usuario eliminado con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando eliminar el usuario'],flags:JSON_UNESCAPED_UNICODE);
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
            static::showView(static::FOLDER . 'users-table.php');
        }
    }

    public static function form() {
        static::init();
        SessionService::init();
        SessionService::continueSession();
        $user = SessionService::isUserSessionActive()? $_SESSION[USER_SESSION] : null;
        // Si no hay ninguna sesión de usuario activa redirigimos al formulario de login
        if (is_null($user)){
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
        if (is_null($action)){
            $id = (isset($_POST['id']) && Validations::isInteger($_POST['id']))? intval($_POST['id']) : null;
            $data = [];
            $data['action'] = INS;
            $rdao = new RolesDAO(static::$connection);
            $roles = array_map(function($n){return [$n->getId(),ucfirst($n->getName())];},array_filter($rdao->findAll(dto:null,page:ALL_PAGES),function($n){return $n->getId()!=ROOT_ROLE;}));
            $data['roles'] = $roles;
            if (!is_null($id)){
                $udao = new UsersDAO(static::$connection);
                $user = $udao->findById(id:$id);
                $data['user'] = $user;
                $data['action'] = UPD;
                
            }
            static::showView(static::FOLDER . 'users-form-view.php',data:$data);
            die;
        }
        switch($action){
        case INS:
            if (!static::hasInsertPermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (!is_null(static::newUser($data))){
                http_response_code(200);
                $json = json_encode(['msg'=>'Usuario añadido con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando añadir el usuario'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        case UPD:
            if (!static::hasUpdatePermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (static::editUser($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Usuario editado con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando editar el usuario'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        }
    }

    protected static function newUser(mixed $data) : ?int {
        $username = (isset($data['username']) && is_string($data['username']) && mb_strlen(trim($data['username']))>0)? mb_strtolower(trim($data['username'])) : null;
        if (is_null($username))
            return null;
        
        $password = (isset($data['password']) && is_string($data['password']) && mb_strlen(trim($data['password']))>0)? trim($data['password']) : null;
        $password_confirmation = (isset($data['password_confirmation']) && is_string($data['password_confirmation']))? trim($data['password_confirmation']) : null;
        if (is_null($password) || ($password!=$password_confirmation))
            return null;
        $password = PasswordHasher::hash(password:$password);

        $role = (isset($data['role']) && Validations::isInteger($data['role'],strict:true))? intval($data['role']) : null;
        if (is_null($role) || $role==ROOT_ROLE)
            return null;

        $udao = new UsersDAO(static::$connection);
        if (!is_null($udao->findByUsername(username:$username))){
            return null;
        }
    
        $dto = new UserDTO;
        $dto->setUsername(username:$username);
        $dto->setPassword(password:$password);
        $dto->setIdRole(idRole:$role);
        $dto->setDate(from:time());
        $dto->setTimestamp(time());
        $dto->setIdUpdater($_SESSION[ID_USER_SESSION]);

        return $udao->insert(dto:$dto);
    }

    protected static function editUser(mixed $data) : bool {
        // validación de formato de id
        $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        if (is_null($id))
            return false;
        
        // validación de rolename
        $username = (isset($data['username']) && is_string($data['username']) && mb_strlen(trim($data['username']))>0)? trim($data['username']) : null;
        if (is_null($username))
            return false;

        $udao = new UsersDAO(connection:static::$connection);
        // validamos que el usuario exista
        if (is_null($udao->findById(id:$id)))
            return false;

        // validamos que no exista otro usuario con el nuevo nombre
        $user_db = $udao->findByUsername(username:$username);
        if (!is_null($user_db) && $user_db->getId()!=$id)
            return false;

        $rdao = new RolesDAO(connection:static::$connection);
        $idRole = (isset($data['role']) && Validations::isInteger($data['role'],strict:true))? intval($data['role']) : null;
        $role = $rdao->findById(id:$idRole);
        if (is_null($role) || $idRole==ROOT_ROLE)
            return false;

        $active = (isset($data['active']) && is_bool($data['active']))? boolval($data['active']) : null;        

        $password = (isset($data['password']) && is_string($data['password']) && mb_strlen(trim($data['password']))>0)? trim($data['password']) : null;
        $password_confirmation = (isset($data['password_confirmation']) && is_string($data['password_confirmation']))? trim($data['password_confirmation']) : null;
        //TODO
        if (!is_null($password) && ($password!=$password_confirmation))
            return false;
        $password = !is_null($password)? PasswordHasher::hash(password:$password) : null;

        $dto = new UserDTO;
        $dto->setId(id:$id);
        $dto->setUsername(username:$username);
        $dto->setPassword(password:$password);
        $dto->setActive(active:$active);
        $dto->setTimestamp(timestamp:time());
        $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);
        return $udao->update(dto:$dto);
    }

    protected static function deleteUser(mixed $data) : bool {
        // El borrado es lógico
        $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        if (is_null($id) || $id==ROOT){
            return false;
        }

        $udao = new UsersDAO(connection:static::$connection);
        $dto = new UserDTO;
        $dto->setId(id:$id);
        $dto->setDeleted(deleted:true);
        $dto->setTimestamp(timestamp:time());
        $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);
        return $udao->update(dto:$dto);
    }

}
?>