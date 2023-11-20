<?php
class MedicalMembershipsDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'medical_memberships',dtoname:'MedicalMembershipDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY id DESC ";
        }
    }

    public function mapToModel(array $data) : MedicalMembership {
        $id = $data['id'];
        $name = $data['name'];
        $mm = new MedicalMembership(id:$id,name:$name);
        return $mm;
    }
}
?>