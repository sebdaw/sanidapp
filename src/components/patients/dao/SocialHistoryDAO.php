<?php
class SocialHistoryDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'social_history',dtoname:'SocialHistoryDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY name ASC ";
        }
    }

    public function mapToModel(array $data) : SocialHistory {
        $id = $data['id'];
        $name = $data['name'];
        $sh = new SocialHistory(id:$id,name:$name);
        return $sh;
    }
}
?>