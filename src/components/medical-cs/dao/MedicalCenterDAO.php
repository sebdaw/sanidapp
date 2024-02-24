<?php
class MedicalCenterDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'medical_center',dtoname:'MedicalCenterDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY name ASC ";
        }
    }

    public function mapToModel(array $data) : MedicalCenter {
        $id = $data['id'];
        $id_membership = $data['id_membership'];
        $name = $data['name'];
        $address = $data['address'];
        $cp = $data['cp'];
        $phone = $data['phone'];
        $email = $data['email'];
        $description = $data['description'];
        $id_town = $data['id_town'];
        $timestamp = $data['timestamp'];
        $id_user_updater = $data['id_user_updater'];


        $mc = new MedicalCenter(id:$id,
        id_membership:$id_membership,
        name:$name,
        address:$address,
        cp:$cp,
        phone:$phone,
        email:$email,
        description:$description,
        id_town:$id_town,
        timestamp:$timestamp,
        id_user_updater:$id_user_updater);
        return $mc;
    }
}
?>