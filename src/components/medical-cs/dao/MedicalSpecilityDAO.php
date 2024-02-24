<?php
class MedicalSpecilityDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'medical_specilities',dtoname:'MedicalSpecilityDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY name ASC ";
        }
    }

    public function mapToModel(array $data) : MedicalSpeciality {
        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $ms = new MedicalSpeciality(id:$id,name:$name,description:$description);
        return $ms;
    }
}
?>