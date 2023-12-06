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
            static::showView(static::FOLDER . 'sections-table.php');
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
            $bdao = new BlocksDAO(static::$connection);
            if (!is_null($id)){
                $block = $bdao->findById(id:$id);
                $data['block'] = $block;
                $data['action'] = UPD;
                
            }
            static::showView(static::FOLDER . 'blocks-form-view.php',data:$data);
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
                $json = json_encode(['msg'=>'Bloque añadido con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando añadir el bloque'],flags:JSON_UNESCAPED_UNICODE);
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
                $json = json_encode(['msg'=>'Bloque editado con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando editar el bloque'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        }
    }

    protected static function newSection(mixed $data) : ?int {
        // $name = (isset($data['name']) && is_string($data['name']) && mb_strlen(trim($data['name']))>0)? mb_strtolower(trim($data['name'])) : null;
        // if (is_null($name))
        //     return null;

        // $bdao = new BlocksDAO(static::$connection);
        // if (!is_null($bdao->findByName(name:$name)))
        //     return null;
    
        // $max = $bdao->getHighestPosition();
        // $max++;
        // $dto = new BlockDTO;
        // $dto->setName(name:$name);
        // $dto->setOrder(order:$max);
        // $dto->setTimestamp(time());
        // $dto->setIdUpdater($_SESSION[ID_USER_SESSION]);

        // return $bdao->insert(dto:$dto);
        return null;
    }

    protected static function editSection(mixed $data) : bool {
        // validación de formato de id
        // $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        // if (is_null($id))
        //     return false;
        
        // $name = (isset($data['name']) && is_string($data['name']) && mb_strlen(trim($data['name']))>0)? mb_strtolower(trim($data['name'])) : null;
        // if (is_null($name))
        //     return false;

        // $bdao = new BlocksDAO(static::$connection);
        
        // if (is_null($bdao->findById($id)))
        //     return false;
        
        // $block = $bdao->findByName(name:$name);
        // if (!is_null($block) && $block->getId()!=$id)
        //     return false;


        // $dto = new BlockDTO;
        // $dto->setId(id:$id);
        // $dto->setName(name:$name);
        // $dto->setTimestamp(timestamp:time());
        // $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);
        // return $bdao->update(dto:$dto);
        return false;
    }

    protected static function deleteSection(mixed $data) : bool {
        // El borrado es lógico
        // $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        // if (is_null($id) || $id==ROOT){
        //     return false;
        // }
        // $bdao = new BlocksDAO(connection:static::$connection);
        // $block = $bdao->get(id:$id);
        // if (is_null($block) || $block->getNumSections()>0)
        //     return false;

        // $blocks = array_values(array_filter($bdao->findAll(dto:null),function($n)use($block){return $n->getId()!=$block->getId();}));
        // if ($bdao->delete(id:$id,beginTransaction:true,commit:false))
        //     return $bdao->sortBlocks(blocks:$blocks,beginTransaction:false,commit:true);
        return false;
    }

    protected static function changePosition(mixed $data) : bool {
        // $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        // if (is_null($id))
        //     return false;
        // $bdao = new BlocksDAO(connection:static::$connection);
        // $block = $bdao->findById(id:$id);
        // $block = (fn($n):Block=>$n)($block);
        // if (is_null($block))
        //     return false;

        // $order = (isset($data['order']) && Validations::isInteger($data['order'],strict:true))? intval($data['order']) : null;
        // if (($order!=ORD_UP) && ($order!=ORD_DOWN))
        //     return false;

        // $max = $bdao->getHighestPosition();
        // $min = 1;

        // if ($max==$min)
        //     return false;

        // if (($block->getOrder()==$max && $order==ORD_UP) || ($block->getOrder()==$min && $order==ORD_DOWN))
        //     return false;

        // $position = $order==ORD_UP? $block->getOrder()+1 : $block->getOrder()-1;
        // $block_tmp = $bdao->findByPosition(position:$position);
        // $dto = new BlockDTO;
        // $dto->setId(id:$block->getId());
        // $dto->setOrder(order:$position);
        // $dto->setTimestamp(timestamp:time());
        // $dto->setIdUpdater(idUpdater:$_SESSION[ID_USER_SESSION]);
        // if (!$bdao->update(dto:$dto,beginTransaction:true,commit:false))
        //     return false;
        // $dto->setId(id:$block_tmp->getId());
        // $dto->setOrder(order:$block->getOrder());
        // if (!$bdao->update(dto:$dto,beginTransaction:false,commit:true))
        //     return false;
        
        // return true;
        return false;
    }

}
?>