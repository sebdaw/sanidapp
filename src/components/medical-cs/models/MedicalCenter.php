<?php
class MedicalCenter extends AbstractModel {
    private int $id;
    private int $id_membership;
    private string $name;
    private string $address;
    private int $cp;
    private string $phone;
    private string $email;
    private string $description;
    private int $id_town;
    private int $timestamp;
    private int $id_user_updater;

    public function __construct(int $id,
            int $id_membership,
            string $name, 
            string $address,
            int $cp,
            string $phone,
            string $email,
            string $description,
            int $id_town,
            int $timestamp,
            int $id_user_updater){
        $this->setId($id);
        $this->setIdMembership($id_membership);
        $this->setName($name);
        $this->setAddress($address);
        $this->setCP($cp);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setDescription($description);
        $this->setIdTown($id_town);
        $this->setTimestamp($timestamp);
        $this->setIdUserUpdater($id_user_updater);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdMembership() : int {
        return $this->id_membership;
    }

    public function setIdMembership(int $id_membership) : void {
        $this->id_membership = $id_membership;
    }

    public function getName() : string {
        return $this->name;
    }

    public function setName(string $name) : void {
        $this->name = $name;
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

    public function getPhone() : string {
        return $this->phone;
    }

    public function setPhone(string $phone) : void {
        $this->phone = $phone;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function setEmail(string $email) : void {
        $this->email = $email;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function setDescription(string $description) : void {
        $this->description = $description;
    }

    public function getIdTown() : int {
        return $this->id_town;
    }

    public function setIdTown(int $id_town) : void {
        $this->id_town = $id_town;
    }

    public function getTimestamp() : int {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp = $timestamp;
    }

    public function getIdUserUpdater() : int {
        return $this->id_user_updater;
    }

    public function setIdUserUpdater(int $id_user_updater) : void {
        $this->id_user_updater = $id_user_updater;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>