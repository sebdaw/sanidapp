<?php
class ProfilesDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'profiles',dtoname:'ProfileDTO',connection:$connection,settings:$settings);
    }

    public function findByIdUser(int $idUser, bool $disconnect=false) : array {
        $dto = new ProfileDTO();
        $dto->setIdUser($idUser);
        $profiles = $this->findAll(dto:$dto,disconnect:$disconnect);
        return $profiles;
    }

    public function findByDni(string $dni, bool $disconnect=false) : ?Profile {
        $profile = null;
        $dto = new ProfileDTO();
        $dto->setDni($dni);
        $profiles = $this->findAll(dto:$dto,disconnect:$disconnect);
        $profile = array_shift($profiles);
        return $profile;
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        case 1:
            $sql .= " ORDER BY dni ASC ";
            break;
        case 2:
            $sql .= " ORDER BY surnames ASC ";
            break;
        case 3:
            $sql .= " ORDER BY email ASC ";
            break;
        default:
            $sql .= " ORDER BY id DESC ";
        }
    }

    public function mapToModel(array $data) : Profile {
        $id = $data['id'];
        $idUser = $data['id_user'];
        $dni = $data['dni'];
        $name = $data['username'];
        $surnames = $data['password'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];
        $cp = $data['cp'];
        $birthday = $data['birthday'];
        $photo = $data['photo'];
        $date = $data['date'];
        $idTown = $data['id_town'];
        $idCountry = $data['id_country'];
        $timestamp = $data['timestamp'];
        $idUpdater = $data['id_user_updater'];
        $profile = new Profile(id:$id,
                            idUser:$idUser,
                            dni:$dni,
                            name:$name,
                            surnames:$surnames,
                            email:$email,
                            phone:$phone,
                            address:$address,
                            cp:$cp,
                            birthday:$birthday,
                            photo:$photo,
                            date:$date,
                            idTown:$idTown,
                            idCountry:$idCountry,
                            timestamp:$timestamp,
                            idUpdater:$idUpdater);
        return $profile;
    }
}
?>