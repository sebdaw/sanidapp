<?php
class Profile extends AbstractModel{
        private int $id;
        private int $idUser;
        private string $dni;
        private string $name;
        private string $surnames;
        private string $email;
        private string $phone;
        private string $address;
        private int $cp;
        private int $birthday;
        private string $photo;
        private int $date;
        private ?int $idTown;
        private ?int $idCountry;
        private int $timestamp;
        private ?int $idUpdater;
    
        public function __construct(int $id,
                                    ?int $idUser,
                                    string $dni,
                                    string $name,
                                    string $surnames,
                                    string $email,
                                    string $phone,
                                    string $address,
                                    int $cp,
                                    ?int $birthday,
                                    string $photo,
                                    ?int $date,
                                    ?int $idTown,
                                    ?int $idCountry,
                                    int $timestamp,
                                    int $idUpdater){
            $this->setId($id);
            $this->setIdUser($idUser);
            $this->setDni($dni);
            $this->setName($name);
            $this->setSurnames($surnames);
            $this->setEmail($email);
            $this->setPhone($phone);
            $this->setAddress($address);
            $this->setCP($cp);
            $this->setBirthday($birthday);
            $this->setPhoto($photo);
            $this->setDate($date);
            $this->setIdTown($idTown);
            $this->setIdCountry($idCountry);
            $this->setTimestamp($timestamp);
            $this->setIdUpdater($idUpdater);
        }
    
        public function getId() : int {
            return $this->id;
        }
    
        public function setId(int $id) : void {
            $this->id = $id;
        }

        public function getIdUser() : ?int {
            return $this->idUser;
        }

        public function setIdUser(?int $idUser) : void {
            $this->idUser = $idUser;
        }
    
        public function getDni() : string {
            return $this->dni;
        }
    
        public function setDni(string $dni) : void {
            $this->dni = $dni;
        }
    
        public function getName() : string {
            return $this->name;
        }
    
        public function setName(string $name) : void {
            $this->name = $name;
        }
    
        public function getSurnames() : string {
            return $this->surnames;
        }
    
        public function setSurnames(string $surnames) : void {
            $this->surnames = $surnames;
        }
    
        public function getEmail() : string {
            return $this->email;
        }
    
        public function setEmail(string $email) : void {
            $this->email = $email;
        }
    
        public function getPhone() : string {
            return $this->phone;
        }
    
        public function setPhone(string $phone) : void {
            $this->phone = $phone;
        }
    
        public function getAddress() : string {
            return $this->address;
        }

        public function setAddress(string $address) : void {
            $this->address = $address;
        }

        public function getCP() : int {
            return $this->cp;
        }

        public function setCP(int $cp) : void {
            $this->cp = $cp;
        }

        public function getBirthday() : ?array {
            return !is_null($this->birthday)? Date::getDate($this->birthday) : null;
        }
    
        public function setBirthday(?int $timestamp) : void{
            $this->birthday = $timestamp;
        }

        public function getPhoto() : string {
            return $this->photo;
        }

        public function setPhoto(string $photo) : void {
            $this->photo = $photo;
        }

        public function getDate() : ?array {
            return !is_null($this->date)? Date::getDate($this->date) : null;
        }
    
        public function setDate(?int $timestamp) : void{
            $this->date = $timestamp;
        }

        public function getIdTown() : ?int {
            return $this->idTown;
        }

        public function setIdTown(?int $idTown) : void {
            $this->idTown = $idTown;
        }

        public function getIdCountry() : ?int {
            return $this->idCountry;
        }

        public function setIdCountry(?int $idCountry) : void {
            $this->idCountry = $idCountry;
        }
    
        public function getTimestamp() : array {
            return Date::getDate($this->timestamp);
        }
    
        public function setTimestamp(int $timestamp) : void {
            $this->timestamp = $timestamp;
        }
    
        public function getIdUpdater() : ?int {
            return $this->idUpdater;
        }
    
        public function setIdUpdater(?int $idUpdater) : void {
            $this->idUpdater = $idUpdater;
        }
    
        public function __toString() : string {
            //TODO:
            return '';
        }
}
?>