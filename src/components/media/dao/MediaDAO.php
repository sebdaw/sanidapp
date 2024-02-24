<?php
class MediaDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'media_types',dtoname:'MediaTypeDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY name ASC ";
        }
    }

    public function mapToModel(array $data) : MediaType {
        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $mt = new MediaType(id:$id,name:$name,description:$description);
        return $mt;
    }
}
?>