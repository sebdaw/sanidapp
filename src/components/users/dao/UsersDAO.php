<?php
class UsersDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_users',dtoname:'UserDTO',connection:$connection,settings:$settings);
    }

    public function findByUsername(string $username, bool $disconnect=false) : ?User {
        $user = null;
        $dto = new UserDTO();
        $dto->setUsername($username);
        $users = $this->findAll(dto:$dto,disconnect:$disconnect);
        $user = array_shift($users);
        return $user;
    }

    public function findByRole(int $idRole, int $order=1, int $page=1, int $pageSize=DEFAULT_PAGESIZE, bool $disconnect=false) : ?array {
        $dto = new UserDTO;
        $dto->setIdRole(idRole:$idRole);
        $users = $this->findAll(dto:$dto,page:$page,pageSize:$pageSize,disconnect:$disconnect,order:$order);
        return $users;
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            case 1:
                $sql .= " ORDER BY username ASC";
                break;
            default:
                $sql .= " ORDER BY id DESC ";
            }
    }

    public function mapToModel(array $data) : User{
        $id = $data['id'];
        $username = $data['username'];
        $password = $data['password'];
        $active = $data['active'];
        $deleted = $data['deleted'];
        $idRole = $data['id_role'];
        $date = $data['date'];
        $timestamp = $data['timestamp'];
        $idUpdater = $data['id_user_updater'];
        $user = new User(id:$id,
                         username:$username,
                         password:$password,
                         active:$active,
                         deleted:$deleted,
                         idRole:$idRole,
                         date:$date,
                         timestamp:$timestamp,
                         idUpdater:$idUpdater);
        return $user;
    }
}
?>