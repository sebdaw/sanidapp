<?php
class SectionsController extends ViewController {
    protected static ?int $id_section = 4;
    protected const FOLDER = 'sections/';
    
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
            static::showView(static::FOLDER . 'sections-view.php');
            die;
        }

        // Si se obtiene un código de acción, se realiza la acción correspondiente. En este caso se devuelve un json
        switch($action){
        case DEL:
            if (!static::hasDeletePermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (static::deleteSection($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Sección eliminado con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando eliminar la sección'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        case ORD:
            if (!static::hasOrderPermission($user->getId())){
                http_response_code(401);
                die;
            }if (static::changePosition($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Posición cambiada con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando cambiar la posición'],flags:JSON_UNESCAPED_UNICODE);
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

            $idBlock = (isset($_REQUEST['block'])&&Validations::isInteger($_REQUEST['block'],strict:true))? intval($_REQUEST['block']) : 0;
            $block = static::$bdao->findById(id:$idBlock);
            $idBlock = !is_null($block)? $idBlock : null;
            $data['searcher'] = ['idBlock'=> $idBlock];
            static::showView(static::FOLDER . 'sections-table.php',data:$data);
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
            $combo_blocks = array_map(function($n){return [$n->getId(),ucfirst($n->getName())];},static::$bdao->findAll(dto:null,page:ALL_PAGES));
            $data['blocks'] = $combo_blocks;
            $idBlock = (isset($_REQUEST['block']) && Validations::isInteger($_REQUEST['block'],strict:true))? intval($_REQUEST['block']) : 0;
            $block = static::$bdao->findById($idBlock);
            $data['block'] = $block;
            if (!is_null($id)){
                $spdao = new SectionsPermissionsDAO(connection:static::$connection);
                $sp = $spdao->getSectionPermissions(idSection:$id);
                $section = static::$sdao->findById(id:$id);
                
                $data['action'] = UPD;
                $data['section'] = $section;
                $data['sectionPermissions'] = $sp;
                
            }
            static::showView(static::FOLDER . 'sections-form-view.php',data:$data);
            die;
        }
        switch($action){
        case INS:
            if (!static::hasInsertPermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (!is_null(static::newSection($data))){
                http_response_code(200);
                $json = json_encode(['msg'=>'Sección añadida con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando añadir la sección'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        case UPD:
            if (!static::hasUpdatePermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (static::editSection($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Sección editado con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando editar la sección'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        }
    }

    protected static function newSection(mixed $data) : ?int {
        $name = (isset($data['name']) && is_string($data['name']) && mb_strlen(trim($data['name']))>0)? mb_strtolower(trim($data['name'])) : null;
        if (is_null($name) || !is_null(static::$sdao->findByName(name:$name)))
            return null;
        $idBlock = (isset($data['block']) && Validations::isInteger($data['block'],strict:true))? intval($data['block']) : null;
        if (is_null($idBlock) || is_null(static::$bdao->findById(id:$idBlock)))
            return null;
        $path = (isset($data['path']) && is_string($data['path']) && mb_strlen(trim($data['path']))>0)? mb_strtolower(trim($data['path'])) : null;
        if (is_null($path) || !is_null(static::$sdao->findByPath(path:$path)))
            return null;
        $icon = (isset($data['icon']) && is_string($data['icon']) && mb_strlen(trim($data['icon']))>0)? mb_strtolower(trim($data['icon'])) : null;
        $img = PATH_IMGS . $icon;
        if (is_null($icon) || !@file_exists($img))
            return null;

        $ptypes = (isset($data['ptypes']) && is_array($data['ptypes']))? $data['ptypes'] : [];
        $ptdao = new PermissionsTypesDAO(connection:static::$connection);
        $spdao = new SectionsPermissionsDAO(connection:static::$connection);

        $max = static::$sdao->getHighestPosition(idBlock:$idBlock);

        $dto = new SectionDTO;
        $dto->setName(name:$name);
        $dto->setIdBlock(idBlock:$idBlock);
        $dto->setPath(path:$path);
        $dto->setIcon(icon:$icon);
        $dto->setOrder(order:($max+1));
        $dto->setTimestamp(timestamp:time());
        $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);

        if (($idSection = static::$sdao->insert(dto:$dto,beginTransaction:true,commit:false))==0){
            static::$connection->rollback();
            return null;
        }

        foreach($ptypes as $ptype){
            $idType = (isset($ptype['type']) && Validations::isInteger($ptype['type']))? intval($ptype['type']) : null;
            if (is_null($idType) || is_null($ptdao->findById(id:$idType)))continue;
            $enabled = isset($ptype['enabled'])? boolval($ptype['enabled']) : false;
            if ($enabled){
                $dto = new SectionPermissionDTO;
                $dto->setIdType(idType:$idType);
                $dto->setIdSection(idSection:$idSection);
                $spdao->insert(dto:$dto,beginTransaction:false,commit:false);
            }

        }
        static::$connection->commit();
        
        return $idSection;
    }

    protected static function editSection(mixed $data) : bool {
        $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        if (is_null($id) || is_null(static::$sdao->findById(id:$id)))
            return false;
        $name = (isset($data['name']) && is_string($data['name']) && mb_strlen(trim($data['name']))>0)? mb_strtolower(trim($data['name'])) : null;
        if (is_null($name))
            return false;
        $idBlock = (isset($data['block']) && Validations::isInteger($data['block'],strict:true))? intval($data['block']) : null;
        if (is_null($idBlock) || is_null(static::$bdao->findById(id:$idBlock)))
            return false;
        $path = (isset($data['path']) && is_string($data['path']) && mb_strlen(trim($data['path']))>0)? mb_strtolower(trim($data['path'])) : null;
        $section_tmp = static::$sdao->findByPath(path:$path);
        if (is_null($path) || (!is_null($section_tmp) && $section_tmp->getId()!=$id))
            return false;
        $icon = (isset($data['icon']) && is_string($data['icon']) && mb_strlen(trim($data['icon']))>0)? mb_strtolower(trim($data['icon'])) : null;
        $img = PATH_IMGS . $icon;
        if (is_null($icon) || !@file_exists($img))
            return false;

        $ptypes = (isset($data['ptypes']) && is_array($data['ptypes']))? $data['ptypes'] : [];
        $ptdao = new PermissionsTypesDAO(connection:static::$connection);
        $spdao = new SectionsPermissionsDAO(connection:static::$connection);


        $dto = new SectionDTO;
        $dto->setId(id:$id);
        $dto->setName(name:$name);
        $dto->setIdBlock(idBlock:$idBlock);
        $dto->setPath(path:$path);
        $dto->setIcon(icon:$icon);
        $dto->setTimestamp(timestamp:time());
        $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);

        if (static::$sdao->update(dto:$dto,beginTransaction:true,commit:false)!=1){
            static::$connection->rollback();
            return false;
        }

        $dto = new SectionPermissionDTO;
        $dto->setIdSection(idSection:$id);
        $sptypes = $spdao->findAll(dto:$dto,page:ALL_PAGES);
        foreach($ptypes as $ptype){
            $idType = (isset($ptype['type']) && Validations::isInteger($ptype['type']))? intval($ptype['type']) : null;
            if (is_null($idType) || is_null($ptdao->findById(id:$idType)))continue;
            $enabled = isset($ptype['enabled'])? boolval($ptype['enabled']) : false;
            $result = array_filter($sptypes,function($n)use($idType){return $n->getIdType()==$idType;});
            $sp = array_shift($result);

            if (is_null($sp) && $enabled){
                $dto = new SectionPermissionDTO;
                $dto->setIdType(idType:$idType);
                $dto->setIdSection(idSection:$id);
                $spdao->insert(dto:$dto,beginTransaction:false,commit:false);
            }else if (!is_null($sp) && !$enabled){
                $spdao->delete(id:$sp->getId(),beginTransaction:false,commit:false);
            }

        }
        static::$connection->commit();
        
        return true;
    }

    protected static function deleteSection(mixed $data) : bool {
        $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        if (is_null($id))
            return false;
        $section = static::$sdao->findById(id:$id);
        $section = (fn($n):?Section=>$n)($section);
        if (is_null($section) || $section->getIdBlock()==BLOCK_MNG)
            return false;
        
        $dto = new SectionDTO;
        $dto->setIdBlock(idBlock:$section->getIdBlock());
        $sections = static::$sdao->findAll(dto:$dto,page:ALL_PAGES);
        $sections = array_filter($sections,function($n)use($id){return $n->getId()!=$id;});
        if (static::$sdao->delete(id:$id,beginTransaction:true,commit:false))
            return static::$sdao->sortSections(sections:$sections,beginTransaction:false,commit:true);
        return false;
    }

    protected static function changePosition(mixed $data) : bool {
        $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        if (is_null($id))
            return false;
        $sdao = new SectionDAO(connection:static::$connection);
        $section = $sdao->findById(id:$id);
        $section = (fn($n):Section=>$n)($section);
        if (is_null($section))
            return false;

        $order = (isset($data['order']) && Validations::isInteger($data['order'],strict:true))? intval($data['order']) : null;
        if (($order!=ORD_UP) && ($order!=ORD_DOWN))
            return false;

        $max = $sdao->getHighestPosition(idBlock:$section->getIdBlock());
        $min = 1;

        if ($max==$min)
            return false;

        if (($section->getOrder()==$max && $order==ORD_UP) || ($section->getOrder()==$min && $order==ORD_DOWN))
            return false;

        $position = $order==ORD_UP? $section->getOrder()+1 : $section->getOrder()-1;
        $section_tmp = $sdao->findByPosition(position:$position,idBlock:$section->getIdBlock());
        $dto = new SectionDTO;
        $dto->setId(id:$section->getId());
        $dto->setOrder(order:$position);
        $dto->setTimestamp(timestamp:time());
        $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);
        if (!$sdao->update(dto:$dto,beginTransaction:true,commit:false))
            return false;
        $dto->setId(id:$section_tmp->getId());
        $dto->setOrder(order:$section->getOrder());
        if (!$sdao->update(dto:$dto,beginTransaction:false,commit:true))
            return false;
        
        return true;
    }

}
?>