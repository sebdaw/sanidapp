<?php
class TownsDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'loc_towns',dtoname:'TownDTO',connection:$connection,settings:$settings);
    }

    public function findByName(string $name, bool $disconnect=true) : ?Community {
        $town = null;
        $dto = new TownDTO();
        $dto->setName($name);
        $towns = $this->findAll(dto:$dto,disconnect:$disconnect);
        $town = array_shift($towns);
        return $town;
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY name ASC ";
            }
    }

    public function mapToModel(array $data) : Town {
        $id = $data['id'];
        $name = $data['name'];
        $idProvince = $data['id_province'];
        $town = new Town(id:$id,
                         name:$name,
                         idProvince:$idProvince);
        return $town;
    }
}
?>