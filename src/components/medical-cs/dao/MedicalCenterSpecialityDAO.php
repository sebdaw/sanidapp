<?php
class MedicalCenterSpecialityDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'medical_center_specialities',dtoname:'MedicalCenterSpecialityDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY Id DESC ";
        }
    }

    public function mapToModel(array $data) : MedicalCenterSpeciality {
        $id = $data['id'];
        $id_center = $data['id_center'];
        $id_speciality = $data['id_speciality'];
        $description = $data['description'];
        $active = $data['active'];
        $timestamp = $data['timestamp'];
        $id_user_updater = $data['id_user_updater'];


        $mcs = new MedicalCenterSpeciality(id:$id,
        id_center:$id_center,
        id_speciality:$id_speciality,
        description:$description,
        active:$active,
        timestamp:$timestamp,
        id_user_updater:$id_user_updater);
        return $mcs;
    }
}
?>