<?php
class JobPositionDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'job_positions',dtoname:'JobPositionsDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY name ASC ";
        }
    }

    public function mapToModel(array $data) : JobPosition {
        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $jp = new JobPosition(id:$id,name:$name,description:$description);
        return $jp;
    }
}
?>