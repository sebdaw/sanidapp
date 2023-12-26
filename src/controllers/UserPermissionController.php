<?php
class UserPermissionController extends ViewController {
    protected static ?int $id_section = 6;
    protected const FOLDER = 'gpu/';
    
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

        if (is_null($action)){
            static::showView(static::FOLDER . 'gpu-view.php');
            die;
        }

        switch($action){
            case UPD:
                if (!static::hasUpdatePermission($user->getId())){
                    http_response_code(401);
                    die;
                }
                if (static::setPermissions($data)){
                    http_response_code(200);
                    $json = json_encode(['msg'=>'Permiso editado con éxito'],flags:JSON_UNESCAPED_UNICODE);
                }else{
                    http_response_code(500);
                    $json = json_encode(['msg'=>'Ha ocurrido un error intentando editar el permiso'],flags:JSON_UNESCAPED_UNICODE);
                }
                echo $json;
                break;
            case API:
                $search_type = (isset($data['type']) && in_array($data['type'],['block','role']))? $data['type'] : null;
                if (is_null($search_type)){
                    http_response_code(400);
                    die;
                }
                switch($search_type){
                case 'block':
                    $idBlock = (isset($data['id_block']) && Validations::isInteger($data['id_block'],strict:true))? intval($data['id_block']) : 0;
                    if (is_null(static::$bdao->findById(id:$idBlock))){
                        http_response_code(401);
                        die;
                    }
                    $dto = new SectionDTO;
                    $dto->setIdBlock(idBlock:$idBlock);
                    $sections = array_map(function($n){
                        return [$n->getId(),ucfirst($n->getName())];
                    },static::$sdao->findAll(dto:$dto,page:ALL_PAGES));
                    $json = json_encode($sections,flags:JSON_UNESCAPED_UNICODE);
                    break;
                case 'role':
                    $udao = new UsersDAO(connection:static::$connection);
                    $rdao = new RolesDAO(connection:static::$connection);
                    $idRole = (isset($data['id_role']) && Validations::isInteger($data['id_role'],strict:true))? intval($data['id_role']) : 0;
                    if (is_null($rdao->findById(id:$idRole))){
                        http_response_code(401);
                        die;
                    }
                    
                    
                    $users = array_map(function($n){
                        return [$n->getId(),ucfirst($n->getUsername())];
                    },$udao->findByRole(idRole:$idRole,page:ALL_PAGES));
                    $json = json_encode($users,flags:JSON_UNESCAPED_UNICODE);
                    break;
                }
                
                http_response_code(200);
                echo $json;
                break;
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
            $udao = new UsersDAO(connection:static::$connection);
            $idUser = (isset($_REQUEST['user']) && Validations::isInteger($_REQUEST['user'],strict:true))? intval($_REQUEST['user']) : 0;
            $data['user'] = $udao->findById(id:$idUser);
            $idSection = (isset($_REQUEST['section']) && Validations::isInteger($_REQUEST['section'],strict:true))? intval($_REQUEST['section']) : 0;
            $pctrl = new PermissionController(connection:static::$connection);
            $ups = $pctrl->getSectionPermissions(idUser:$idUser,idSection:$idSection);
            $data['userPermissions'] = $ups;
            $types = [];
            if (!is_null($ups)){
                foreach($ups->getPermissions() as $up){
                    $types[] = $up->getType();
                }
                $data['types'] = $types;
                usort($data['types'],function($a,$b){return $a->getId()-$b->getId();});
            }
            static::showView(static::FOLDER . 'gpu-table.php',data:$data);
        }
    }

    protected static function setPermissions(mixed $data) : bool {
        $updao = new UsersPermissionsDAO(connection:static::$connection);
        $spdao = new SectionsPermissionsDAO(connection:static::$connection);
        $idUser = (isset($data['user']) && Validations::isInteger($data['user'],strict:true))? intval($data['user']) : 0;
        $idSection = (isset($data['section']) && Validations::isInteger($data['section'],strict:true))? intval($data['section']) : 0;
        $permissions = (isset($data['permissions']) && is_array($data['permissions']) && !empty($data['permissions']))? $data['permissions'] : [];
        if (empty($permissions))
            return false;

        static::$connection->beginTransaction();
        foreach($permissions as $permission){
            $idType = (isset($permission['type']) && Validations::isInteger($permission['type'],strict:true))? intval($permission['type']) : 0;
            $sp = $spdao->getSectionPermission(idSection:$idSection,idType:$idType);
            // No soporta el permiso
            if (is_null($sp))
                return false;
            $enabled = $permission['permission'];
            $up = $updao->find(idUser:$idUser,idSection:$idSection,idSPT:$sp->getIdType());
            //TODO: validar que esa sección soporta ese tipo
            if (is_null($up)){
                if (!static::newPermission(idType:$sp->getIdType(),idUser:$idUser,idSection:$idSection,enabled:$enabled,updao:$updao,beginTransaction:false,commit:false))
                    return false;
            }else{
                if (!static::editPermission(id:$up->getId(),enabled:$enabled,updao:$updao,beginTransaction:false,commit:false))
                    return false;
            }
        }


        // $rdao = new RolesDAO(connection:static::$connection);
        // $sdao = new SectionDAO(connection:static::$connection);
        // $idRole = (isset($data['role']) && Validations::isInteger($data['role'],strict:true))? intval($data['role']) : 0;
        // $role = $rdao->findById(id:$idRole);
        // if (is_null($role))
        //     return false;
        // $idSection = (isset($data['section']) && Validations::isInteger($data['section'],strict:true))? intval($data['section']) : 0;
        // $section = $sdao->findById(id:$idSection);
        // if (is_null($section))
        //     return false;

        // $permissions = (isset($data['permissions']) && static::validatePermissions($data['permissions']))? $data['permissions'] : null;
        // if (is_null($permissions))
        //     return false;

        // $rpdao = new RolesPermissionsDAO(connection:static::$connection);
        // $spbo = static::$pcontroller->getSectionRolePermissions(idRole:$idRole,idSection:$idSection);
        // if (is_null($spbo))
        //     return false;
        // static::$connection->beginTransaction();
        // foreach($permissions as $permission){
        //     $enabled = $permission['enabled'];
        //     $pid = Validations::isInteger($permission['pid'],strict:true)? intval($permission['pid']) : null;
        //     $idType = intval($permission['type']);
        //     $pbo = $spbo->getPermissionByIdType(idType:$idType);
        //     // Si es igual a null significa que no soporta el tipo
        //     if (is_null($pbo))
        //         return false;
        //     // Si se recibe un id de permiso que resulta que no existe, se cancela
        //     if (!is_null($pid) && is_null($spbo->getRolePermission($pid)))
        //         return false;

        //     $rp = $pbo->getRolePermission();

        //     if ($enabled && is_null($rp)) // Si queremos habilitarlo y no hay guardado un registro de permiso de rol
        //         $action = INS;
        //     else if (!is_null($rp) && (($enabled && !$rp->isEnabled()) ||(!$enabled && $rp->isEnabled()))) // Si existe un registro de permiso de rol y deseamos cambiarlo (porque si es el mismo valor devolverá 0 filas afectadas)
        //         $action = UPD;
        //     else 
        //         $action = null;

        //     switch($action){
        //     case INS:
        //         if (!static::newPermission(idType:$idType,idRole:$idRole,idSection:$idSection,rpdao:$rpdao,beginTransaction:false,commit:false))
        //             return false;
        //         break;
        //     case UPD:
        //         if (!static::editPermission(id:$pid,enabled:$enabled,rpdao:$rpdao,beginTransaction:false,commit:false))
        //             return false;
        //         break;
        //     }
        // }
        return static::$connection->commit();
    }

    protected static function editPermission(int $id, ?bool $enabled, UsersPermissionsDAO $updao, bool $beginTransaction=true, bool $commit=true) : bool {
        $dto = new UserPermissionDTO;
        $dto->setId(id:$id);
        $dto->setEnabled(enabled:$enabled);
        $dto->setTimestamp(timestamp:time());
        $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);
        return $updao->update(dto:$dto,beginTransaction:$beginTransaction,commit:$commit);
    }

    protected static function newPermission(int $idType, int $idUser, int $idSection, ?bool $enabled, UsersPermissionsDAO $updao, bool $beginTransaction=true, bool $commit=true) : bool {
        $dto = new UserPermissionDTO;
        $dto->setIdType(idType:$idType);
        $dto->setIdUser(idUser:$idUser);
        $dto->setIdSection(idSection:$idSection);
        $dto->setEnabled(enabled:$enabled);
        $dto->setTimestamp(timestamp:time());
        $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);
        return $updao->insert(dto:$dto,beginTransaction:$beginTransaction,commit:$commit);
    }

    private static function validatePermissions(mixed $permissions) : bool {
        // if (!is_array($permissions))
        //     return false;
        // $tdao = new PermissionsTypesDAO(connection:static::$connection);
        // $rpdao = new RolesPermissionsDAO(connection:static::$connection);
        // foreach($permissions as $permission){
        //     if (!isset($permission['enabled']) || !is_bool($permission['enabled']))
        //         return false;
        //     if (!isset($permission['type']) || !Validations::isInteger($permission['type'],strict:true) || is_null($tdao->findById(id:$permission['type'])))
        //         return false;
        //     if (isset($permission['pid']) && (!Validations::isInteger($permission['pid'],strict:true) && $permission['pid']!=''))
        //         return false;
        //     if (Validations::isInteger($permission['pid']) && is_null($rpdao->findById(id:$permission['pid'])))
        //         return false;
        // }
        // return true;
        return false;
    }
}
?>