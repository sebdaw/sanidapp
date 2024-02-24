<?php
class MedicalCenterDTO extends AbstractDTO {
    private Column $id;
    private Column $id_membership;
    private Column $name;
    private Column $address;
    private Column $cp;
    private Column $phone;
    private Column $email;
    private Column $description;
    private Column $id_town;
    private Column $timestamp;
    private Column $id_user_updater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_membership = new Column(name:'id_membership',type:'int');
        $this->name = new Column(name:'name',type:'string');
        $this->address = new Column(name:'address',type:'string');
        $this->cp = new Column(name:'cp',type:'int');
        $this->phone = new Column(name:'phone',type:'string');
        $this->email = new Column(name:'email',type:'string');
        $this->description = new Column(name:'description',type:'string');
        $this->id_town = new Column(name:'id_town',type:'int');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->id_user_updater = new Column(name:'id_user_updater',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdMembership() : Column {
        return $this->id_membership;
    }

    public function setIdMembership(int $id_membership) : void {
        $this->id_membership->setValue($id_membership);
    }

    public function getName() : Column {
        return $this->name;
    }

    public function setName(string $name) : void {
        $this->name->setValue($name);
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

    public function getPhone() : Column {
        return $this->phone;
    }

    public function setPhone(string $phone) : void {
        $this->phone->setValue($phone);
    }

    public function getEmail() : Column {
        return $this->email;
    }

    public function setEmail(string $email) : void {
        $this->email->setValue($email);
    }

    public function getDescription() : Column {
        return $this->description;
    }

    public function setDescription(string $description) : void {
        $this->description->setValue($description);
    }

    public function getIdTown() : Column {
        return $this->id_town;
    }

    public function setIdTown(int $id_town) : void {
        $this->id_town->setValue($id_town);
    }

    public function getTimestamp() : Column {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp->setValue($timestamp);
    }

    public function getIdUserUpdater() : Column {
        return $this->id_user_updater;
    }

    public function setIdUserUpdater(int $id_user_updater) : void {
        $this->id_user_updater->setValue($id_user_updater);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdMembership();
        $columns[] = $this->getName();
        $columns[] = $this->getAddress();
        $columns[] = $this->getCP();
        $columns[] = $this->getPhone();
        $columns[] = $this->getEmail();
        $columns[] = $this->getDescription();
        $columns[] = $this->getIdTown();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUserUpdater();
        return $columns;
    }
}
?>