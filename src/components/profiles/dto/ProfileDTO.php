<?php
class ProfileDTO extends AbstractDTO {
        private Column $id;
        private Column $idUser;
        private Column $dni;
        private Column $name;
        private Column $surnames;
        private Column $email;
        private Column $phone;
        private Column $address;
        private Column $cp;
        private Column $birthday;
        private Column $photo;
        private Column $date;
        private Column $idTown;
        private Column $idCountry;
        private Column $timestamp;
        private Column $idUpdater;
    
        public function __construct(){
            $this->id = new Column(name:'id',type:'int');
            $this->idUser = new Column(name:'id_user',type:'int');
            $this->dni = new Column(name:'dni',type:'string');
            $this->name = new Column(name:'name',type:'string');
            $this->surnames = new Column(name:'surnames',type:'string');
            $this->email = new Column(name:'email',type:'string');
            $this->phone = new Column(name:'phone',type:'string');
            $this->address = new Column(name:'address',type:'string');
            $this->cp = new Column(name:'cp',type:'int');
            $this->birthday = new Column(name:'birthday',type:'int');
            $this->photo = new Column(name:'photo',type:'string');
            $this->date = new Column(name:'date',type:'int');
            $this->idTown = new Column(name:'id_town',type:'int');
            $this->idCountry = new Column(name:'id_country',type:'int');
            $this->timestamp = new Column(name:'timestamp',type:'int');
            $this->idUpdater = new Column(name:'id_user_udpater',type:'int');
        }
    
        public function getId() : Column {
            return $this->id;
        }
    
        public function setId(int $id) : void {
            $this->id->setValue($id);
        }

        public function getIdUser() : Column {
            return $this->idUser;
        }

        public function setIdUser(?int $idUser) : void {
            $this->idUser->setValue($idUser);
        }
    
        public function getDni() : Column {
            return $this->dni;
        }
    
        public function setDni(string $dni) : void {
            $this->dni->setValue($dni);
        }
    
        public function getName() : Column {
            return $this->name;
        }
    
        public function setName(string $name) : void {
            $this->name->setValue($name);
        }
    
        public function getSurnames() : Column {
            return $this->surnames;
        }
    
        public function setSurnames(string $surnames) : void {
            $this->surnames->setValue($surnames);
        }
    
        public function getEmail() : Column {
            return $this->email;
        }
    
        public function setEmail(string $email) : void {
            $this->email->setValue($email);
        }
    
        public function getPhone() : Column {
            return $this->phone;
        }
    
        public function setPhone(string $phone) : void {
            $this->phone->setValue($phone);
        }
    
        public function getAddress() : Column {
            return $this->address;
        }

        public function setAddress(string $address) : void {
            $this->address->setValue($address);
        }

        public function getCP() : Column {
            return $this->cp;
        }

        public function setCP(int $cp) : void {
            $this->cp->setValue($cp);
        }

        public function getBirthday() : Column {
            return $this->birthday;
        }
    
        public function setBirthday(?int $from, ?int $to=null) : void{
            $value = [
                'from' => $from,
                'to' => $to
            ];
            $this->birthday->setValue($value);
        }

        public function getPhoto() : Column {
            return $this->photo;
        }

        public function setPhoto(string $photo) : void {
            $this->photo->setValue($photo);
        }

        public function getDate() : Column {
            return $this->date;
        }
    
        public function setDate(?int $from, ?int $to=null) : void {
            $value = [
                'from' => $from,
                'to' => $to
            ];
            $this->date->setValue($value);
        }

        public function getIdTown() : Column {
            return $this->idTown;
        }

        public function setIdTown(?int $idTown) : void {
            $this->idTown->setValue($idTown);
        }

        public function getIdCountry() : Column {
            return $this->idCountry;
        }

        public function setIdCountry(?int $idCountry) : void {
            $this->idCountry->setValue($idCountry);
        }
    
        public function getTimestamp() : Column {
            return $this->timestamp;
        }
    
        public function setTimestamp(int $timestamp) : void {
            $this->timestamp->setValue($timestamp);
        }
    
        public function getIdUpdater() : Column {
            return $this->idUpdater;
        }
    
        public function setIdUpdater(?int $idUpdater) : void {
            $this->idUpdater->setValue($idUpdater);
        }
    
        public function getAll() : array {
            $columns = [];
            $columns[] = $this->getId();
            $columns[] = $this->getIdUser();
            $columns[] = $this->getDni();
            $columns[] = $this->getName();
            $columns[] = $this->getSurnames();
            $columns[] = $this->getEmail();
            $columns[] = $this->getPhone();
            $columns[] = $this->getAddress();
            $columns[] = $this->getCP();
            $columns[] = $this->getBirthday();
            $columns[] = $this->getPhoto();
            $columns[] = $this->getDate();
            $columns[] = $this->getIdTown();
            $columns[] = $this->getIdCountry();
            $columns[] = $this->getTimestamp();
            $columns[] = $this->getIdUpdater();
            return $columns;
        }
}
?>