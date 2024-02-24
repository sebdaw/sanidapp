<?php
class CentersController extends ViewController {
    protected static ?int $id_section = 14;
    protected const FOLDER = 'centers/';
    
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
            static::showView(static::FOLDER . 'centers-view.php');
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
            if (static::deleteCenter($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Centro médico eliminado con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando eliminar el centro médico'],flags:JSON_UNESCAPED_UNICODE);
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
            static::showView(static::FOLDER . 'centers-table.php');
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
        $data = empty($_POST['data'])? file_get_contents('php://input') : $_POST['data'];
        $data = json_decode($data,associative:true,flags:JSON_UNESCAPED_UNICODE);
        $action = (isset($data['action']) && Validations::isInteger($data['action']))? intval($data['action']) : null;
        if (is_null($action)){
            $cdao = new CommunitiesDAO(connection:static::$connection);
            $mmdao = new MedicalMembershipsDAO(connection:static::$connection);
            $communities = array_map(function($n){
                return [$n->getId(),$n->getName()];
            },$cdao->findAll(dto:null,page:ALL_PAGES));
            $memberships = array_map(function($n){
                return [$n->getId(),$n->getName()];
            },$mmdao->findAll(dto:null,page:ALL_PAGES));
            
            $data = [];
            $data['action'] = INS;
            $data['communities'] = $communities;
            $data['memberships'] = $memberships;
            $data['files'] = [];
            $id = (isset($_POST['id']) && Validations::isInteger($_POST['id']))? intval($_POST['id']) : null;
            if (!is_null($id)){
                $data['action'] = UPD;
                $dao = new MedicalCenterDAO(connection:static::$connection);
                $pdao = new ProvincesDAO(connection:static::$connection);
                $tdao = new TownDAO(connection:static::$connection);
                $center = (fn($n):?MedicalCenter=>$n)($dao->findById($id));
                
                $idTown = $center->getIdTown();
                $town = (fn($n):?Town=>$n)($tdao->findById($idTown));
                $idProvince = $town->getIdProvince();
                $province = (fn($n):?Province=>$n)($pdao->findById($idProvince));
                $idCommunity = $province->getIdCommunity();

                //TODO: obtener de base de datos
                $dirpath = PATH_DOCS . "centers/$id";
                $files = (@file_exists($dirpath) && @is_dir($dirpath))? scandir($dirpath) : false;
                if (!empty($files)){
                    foreach($files as $file){
                        if (in_array($file,['.','..']) || $file=='.htaccess')
                            continue;
                        // $data['files'][] = URL_DOCS . "centers/$id/$file";;
                        $data['files'][] = $file;
                    }
                }

                $dto = new ProvinceDTO;
                $dto->setIdCommunity($idCommunity);
                $provinces = array_map(function($n){
                    return [$n->getId(),$n->getName()];
                },$pdao->findAll(dto:$dto,page:ALL_PAGES));
                $dto = new TownDTO;
                $dto->setIdProvince($idProvince);
                $towns = array_map(function($n){
                    return [$n->getId(),$n->getName()];
                },$tdao->findAll(dto:$dto,page:ALL_PAGES));
                $data['center'] = $center;
                $data['idCommunity'] = $idCommunity;
                $data['idProvince'] = $idProvince;
                $data['idTown'] = $idTown;
                $data['provinces'] = $provinces;
                $data['towns'] = $towns;
                $data['description'] = $center->getDescription();
            }
            static::showView(static::FOLDER . 'centers-form-view.php',data:$data);
            die;
        }
        switch($action){
        case INS:
            if (!static::hasInsertPermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (!is_null(static::newCenter($data))){
                http_response_code(200);
                $json = json_encode(['msg'=>'Centró médico añadido con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando añadir el centro médico'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        case UPD:
            if (!static::hasUpdatePermission($user->getId())){
                http_response_code(401);
                die;
            }
            if (static::editCenter($data)){
                http_response_code(200);
                $json = json_encode(['msg'=>'Centro médico editado con éxito'],flags:JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(500);
                $json = json_encode(['msg'=>'Ha ocurrido un error intentando editar el centro médico'],flags:JSON_UNESCAPED_UNICODE);
            }
            echo $json;
            break;
        }
    }

    protected static function newCenter(mixed $data) : ?int {
        $name = isset($data['name'])? trim($data['name']) : null;
        $cp = isset($data['cp']) && Validations::isInteger($data['cp'])? intval($data['cp']) : null;
        $email = isset($data['email']) && filter_var(trim($data['email']),FILTER_VALIDATE_EMAIL)? trim($data['email']) : null;
        $phone = isset($data['phone']) && !empty(trim($data['phone']))? trim($data['phone']) : null;
        $address = isset($data['address']) && !empty(trim($data['address']))? trim($data['address']) : null;
        $town = isset($data['town']) && Validations::isInteger($data['town'])? intval($data['town']) : null;
        $description = isset($data['description'])? trim($data['description']) : '';
        $membership = isset($data['membership']) && Validations::isInteger($data['membership'])? intval($data['membership']) : null;
    
        if (empty($name) || empty($cp) || empty($email) || empty($phone) || empty($address) || empty($town) || empty($description) || empty($membership)){
            return null;
        }



        //TODO: validar que la ciudad exista
        //TODO: validar que la afiliación exista

        $dao = new MedicalCenterDAO(connection:static::$connection);
        $dto = new MedicalCenterDTO;
        $dto->setName($name);
        $dto->setCP($cp);
        $dto->setAddress($address);
        $dto->setIdTown($town);
        $dto->setDescription($description);
        $dto->setEmail($email);
        $dto->setPhone($phone);
        $dto->setIdMembership($membership);
        $dto->setTimestamp(time());
        $dto->setIdUserUpdater($_SESSION[ID_USER_SESSION]);

        if (!is_null($id = $dao->insert(dto:$dto))){
            $dirpath = PATH_DOCS . "centers/$id";
            if (!(@file_exists($dirpath) && @is_dir($dirpath))){
                if (@mkdir($dirpath,recursive:true)){
                    $fileForm = new FileForm('images',$dirpath,['jpeg','png']);
                    $filesinfo = $fileForm->fncSaveFiles();
                    //TODO: indicar que fotos no se han subido bien
                }
            }
        }
        return $id;
    }

    protected static function editCenter(mixed $data) : bool {
        $id = isset($data['id']) && Validations::isInteger($data['id'])? intval($data['id']) : null;

        if (is_null($id))
            return false;

        $cdao = new MedicalCenterDAO(connection:static::$connection);
        $center = $cdao->findById(id:$id);

        if (is_null($center))
            return false;
        
        $name = isset($data['name'])? trim($data['name']) : null;

        if (!empty($name)){
            $dto = new MedicalCenterDTO();
            $dto->setName($name);
            $list = array_filter($cdao->findAll(dto:$dto),function($n)use($id){
                return $n->getId()!=$id;
            });
            // Coincide el nombre con el de otro centro
            if (!empty($list))
                return false;
        }

        $cp = isset($data['cp']) && Validations::isInteger($data['cp'])? intval($data['cp']) : null;
        $email = isset($data['email']) && filter_var(trim($data['email']),FILTER_VALIDATE_EMAIL)? trim($data['email']) : null;
        $phone = isset($data['phone']) && !empty(trim($data['phone']))? trim($data['phone']) : null;
        $address = isset($data['address']) && !empty(trim($data['address']))? trim($data['address']) : null;
        $town = isset($data['town']) && Validations::isInteger($data['town'])? intval($data['town']) : null;
        $description = isset($data['description'])? trim($data['description']) : null;
        $membership = (isset($data['membership']) && Validations::isInteger($data['membership']))?  intval($data['membership']) : null;

        $dto = new MedicalCenterDTO;
        $dto->setId($id);
        if (!empty($name))
            $dto->setName($name);
        if (!is_null($cp))
            $dto->setCP($cp);
        if (!is_null($email))
            $dto->setEmail($email);
        if (!is_null($phone))
            $dto->setPhone($phone);
        if (!is_null($address))
            $dto->setAddress($address);
        if (!empty($town))
            $dto->setIdTown($town);
        if (!is_null($description))
            $dto->setDescription($description);
        if (!is_null($membership))
            $dto->setIdMembership($membership);
        $dto->setTimestamp(time());
        $dto->setIdUserUpdater($_SESSION[ID_USER_SESSION]);
        $updated = $cdao->update(dto:$dto);
        if ($updated){
            $dirpath = PATH_DOCS . "centers/$id";
            if (!(@file_exists($dirpath) && @is_dir($dirpath))){
                if (@mkdir($dirpath,recursive:true)){
                    $fileForm = new FileForm('images',$dirpath,['jpg','jpeg','png']);
                    $filesinfo = $fileForm->fncSaveFiles();
                    //TODO: añadir a base de datos
                }
            }else{
                $fileForm = new FileForm('images',$dirpath,['jpg','jpeg','png']);
                $filesinfo = $fileForm->fncSaveFiles();
            }
        }

        return $updated;
    }

    protected static function deleteCenter(mixed $data) : bool {
        // El borrado es lógico
        $id = (isset($data['id']) && Validations::isInteger($data['id'],strict:true))? intval($data['id']) : null;
        if (is_null($id))
            return false;

        $dao = new MedicalCenterDAO(connection:static::$connection);
        $deleted = $dao->delete($id);
        if ($deleted){
            $dirpath = PATH_DOCS . "centers/$id";
            if (@file_exists($dirpath) && @is_dir($dirpath)){
                $files = @scandir($dirpath);
                foreach($files as $file){
                    $filepath = "$dirpath/$file";
                    @unlink($filepath);
                }
                @rmdir($dirpath);
            }
        }
        return $deleted;
    }

}
?>