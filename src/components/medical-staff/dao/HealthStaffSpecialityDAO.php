<?php
class HealthStaffSpecialityDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'health_staff_medical_speciality',dtoname:'HealthStaffSpecialityDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY Id ASC ";
        }
    }

    public function mapToModel(array $data) : HealthStaffSpeciality {
        $id = $data['id'];
        $id_health_staff = $data['id_health_staff'];
        $id_speciality = $data['id_speciality'];
        $date = $data['date'];
        $id_user_updater = $data['id_user_updater'];
        $timestamp = $data['timestamp'];

        $hss = new HealthStaffSpeciality(id:$id,id_health_staff:$id_health_staff,id_speciality:$id_speciality,date:$date,id_user_updater:$id_user_updater,timestamp:$timestamp);
        return $hss;
    }
}
?>