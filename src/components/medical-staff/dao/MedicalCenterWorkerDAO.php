<?php
class MedicalCenterWorkerDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'medical_center_worker',dtoname:'MedicalCenterWorkerDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY Id ASC ";
        }
    }

    public function mapToModel(array $data) : MedicalCenterWorker {
        $id = $data['id'];
        $id_health_staff = $data['id_health_staff'];
        $id_center_speciality = $data['id_center_speciality'];
        $active = $data['active'];
        $from = $data['from'];
        $to = $data['to'];
        $id_job_position = $data['id_job_position'];
        $id_user_updater = $data['id_user_updater'];
        $timestamp = $data['timestamp'];

        $mcw = new MedicalCenterWorker(id:$id,
                                       id_health_staff:$id_health_staff,
                                       id_center_speciality:$id_center_speciality,
                                       active:$active,
                                       from:$from,
                                       to:$to,
                                       id_job_position:$id_job_position,
                                       timestamp:$timestamp,
                                       id_user_updater:$id_user_updater);
        return $mcw;
    }
}
?>