<?php
class AnamnesisDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'anamnesis',dtoname:'AnamnesisDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY name ASC ";
        }
    }

    public function mapToModel(array $data) : Anamnesis {
        $id = $data['id'];
        $name = $data['name'];
        $a = new Anamnesis(id:$id,name:$name);
        return $a;
    }
}
?>