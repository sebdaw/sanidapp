<?php
class ProvincesDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'loc_provinces',dtoname:'ProvinceDTO',connection:$connection,settings:$settings);
    }

    public function findByName(string $name, bool $disconnect=true) : ?Community {
        $province = null;
        $dto = new ProvinceDTO();
        $dto->setName($name);
        $provinces = $this->findAll(dto:$dto,disconnect:$disconnect);
        $province = array_shift($provinces);
        return $province;
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY name ASC ";
            }
    }

    public function mapToModel(array $data) : Province {
        $id = $data['id'];
        $name = $data['name'];
        $idCommunity = $data['id_community'];
        $province = new Province(id:$id,
                         name:$name,
                         idCommunity:$idCommunity);
        return $province;
    }
}
?>