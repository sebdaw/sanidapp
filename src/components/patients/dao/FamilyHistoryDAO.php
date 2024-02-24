<?php
class FamilyHistoryDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'family_history',dtoname:'FamilyHistoryDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY name ASC ";
        }
    }

    public function mapToModel(array $data) : FamilyHistory {
        $id = $data['id'];
        $name = $data['name'];
        $fh = new FamilyHistory(id:$id,name:$name);
        return $fh;
    }
}
?>