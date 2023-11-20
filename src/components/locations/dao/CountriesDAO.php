<?php
class CountriesDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'loc_countries',dtoname:'CountryDTO',connection:$connection,settings:$settings);
    }

    public function findByIsoA2(string $isoA2, bool $disconnect=true) : ?Country {
        $country = null;
        $dto = new CountryDTO();
        $dto->setIsoA2($isoA2);
        $countries = $this->findAll(dto:$dto,disconnect:$disconnect);
        $country = array_shift($countries);
        return $country;
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY nameES ASC ";
            }
    }

    public function mapToModel(array $data) : Country {
        $id = $data['id'];
        $nameES = $data['nameES'];
        $nameEN = $data['nameEN'];
        $isoA2 = $data['isoA2'];
        $country = new Country(id:$id,
                         nameES:$nameES,
                         nameEN:$nameEN,
                         isoA2:$isoA2);
        return $country;
    }
}
?>