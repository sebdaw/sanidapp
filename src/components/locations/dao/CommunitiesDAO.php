<?php
class CommunitiesDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'loc_communities',dtoname:'CommunityDTO',connection:$connection,settings:$settings);
    }

    public function findByName(string $name, bool $disconnect=true) : ?Community {
        $community = null;
        $dto = new CommunityDTO();
        $dto->setName($name);
        $communities = $this->findAll(dto:$dto,disconnect:$disconnect);
        $community = array_shift($communities);
        return $community;
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY name ASC ";
            }
    }

    public function mapToModel(array $data) : Community {
        $id = $data['id'];
        $name = $data['name'];
        $idCountry = $data['id_country'];
        $community = new Community(id:$id,
                         name:$name,
                         idCountry:$idCountry);
        return $community;
    }
}
?>