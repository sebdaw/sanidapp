<?php
class HealthStaffDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'health_staff',dtoname:'HealthStaffDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY license_number ASC ";
        }
    }

    public function mapToModel(array $data) : HealthStaff {
        $id = $data['id'];
        $id_profile = $data['id_profile'];
        $license_number = $data['license_number'];
        $posts_research = $data['posts_research'];
        $experience = $data['experience'];
        $education = $data['education'];

        $hs = new HealthStaff(id:$id,id_profile:$id_profile,license_number:$license_number,posts_research:$posts_research,experience:$experience,education:$education);
        return $hs;
    }
}
?>