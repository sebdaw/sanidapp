<?php
class MedicalCenterMediaDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'center_media',dtoname:'MedicalCenterMediaDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY position IS NULL ASC, position ASC ";
        }
    }

    public function mapToModel(array $data) : MedicalCenterMedia {
        $id = $data['id'];
        $id_center = $data['id_center'];
        $id_type = $data['id_type'];
        $name = $data['name'];
        $position = $data['position'];
        $mcm = new MedicalCenterMedia(id:$id,name:$name,id_center:$id_center,id_type:$id_type,position:$position);
        return $mcm;
    }
}
?>