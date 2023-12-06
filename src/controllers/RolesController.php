<?php
class RolesController extends ViewController {
    protected static ?int $id_section = 2;
    protected const FOLDER = 'roles/';
    
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
            static::showView(static::FOLDER . 'roles-view.php');
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
            if (static::deleteRole($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Rol eliminado con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando eliminar el rol'],flags:JSON_UNESCAPED_UNICODE);
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
            static::showView(static::FOLDER . 'roles-table.php');
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
            $id = (isset($_POST['idRole']) && Validations::isInteger($_POST['idRole']))? intval($_POST['idRole']) : null;
            $data = [];
            $data['action'] = INS;
            if (!is_null($id)){
                $rdao = new RolesDAO(static::$connection);
                $role = $rdao->findById(id:$id);
                $data['role'] = $role;
                $data['action'] = UPD;
            }
            static::showView(static::FOLDER . 'roles-form-view.php',data:$data);
            die;
        }
        switch($action){
        case INS:
            if (!static::hasInsertPermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (!is_null(static::newRole($data))){
                http_response_code(200);
                $json = json_encode(['msg'=>'Rol añadido con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando añadir el rol'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        case UPD:
            if (!static::hasUpdatePermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (static::editRole($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Rol editado con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando editar el rol'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        }
    }

    protected static function newRole(mixed $data) : ?int {
        $rolename = (isset($data['rolename']) && is_string($data['rolename']) && mb_strlen(trim($data['rolename']))>0)? mb_strtolower(trim($data['rolename'])) : null;
        if (is_null($rolename))
            return null;

        $rdao = new RolesDAO;
        if (!is_null($rdao->findByName(name:$rolename))){
            return null;
        }
    
        $dto = new RoleDTO;
        $dto->setName(name:$rolename);
        $dto->setTimestamp(time());
        $dto->setIdUpdater($_SESSION[ID_USER_SESSION]);

        return $rdao->insert(dto:$dto);
    }

    protected static function editRole(mixed $data) : bool {
        // validación de formato de id
        $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        if (is_null($id)){
            return false;
        }
        // validación de rolename
        $rolename = (isset($data['rolename']) && is_string($data['rolename']) && mb_strlen(trim($data['rolename']))>0)? mb_strtolower(trim($data['rolename'])) : null;
        if (is_null($rolename))
            return false;

        $rdao = new RolesDAO;
        // validamos que el rol exista
        if (is_null($rdao->findById(id:$id)))
            return false;

        // validamos que no exista otro rol con el nuevo nombre
        $role_db = $rdao->findByName(name:$rolename);
        if (!is_null($role_db) && $role_db->getId()!=$id)
            return false;

        $dto = new RoleDTO;
        $dto->setId(id:$id);
        $dto->setName(name:$rolename);
        $dto->setTimestamp(timestamp:time());
        $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);
        return $rdao->update(dto:$dto);
    }

    protected static function deleteRole(mixed $data) : bool {
        $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        if (is_null($id)){
            return false;
        }
        $connection = new DBConnection;
        $rdao = new RolesDAO(connection:$connection);
        // $rpdao = new RolesPermissionsDAO(connection:$connection);
        if (is_null($rdao->findById(id:$id))){
            return false;
        }
        
        return $rdao->delete(id:$id);
    }

}
?>