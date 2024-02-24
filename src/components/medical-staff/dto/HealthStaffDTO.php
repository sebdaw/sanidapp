<?php
class HealthStaffDTO extends AbstractDTO {
    private Column $id;
    private Column $id_profile;
    private Column $license_number;
    private Column $posts_research;
    private Column $experience;
    private Column $education;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_profile = new Column(name:'id_profile',type:'int');
        $this->license_number = new Column(name:'license_number',type:'int');
        $this->posts_research = new Column(name:'posts_research',type:'string');
        $this->experience = new Column(name:'experience',type:'string');
        $this->education = new Column(name:'education',type:'string');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdProfile() : Column {
        return $this->id_profile;
    }

    public function setIdProfile(int $id_profile) : void {
        $this->id_profile->setValue($id_profile);
    }

    public function getLicenseNumber() : Column {
        return $this->license_number;
    }

    public function setLicenseNumber(int $license_number) : void {
        $this->license_number->setValue($license_number);
    }

    public function getPosts() : Column {
        return $this->posts_research;
    }

    public function setPosts(string $posts_research) : void {
        $this->posts_research->setValue($posts_research);
    }

    public function getExperience() : Column {
        return $this->experience;
    }

    public function setExperience(string $experience) : void {
        $this->experience->setValue($experience);
    }

    public function getEducation() : Column {
        return $this->education;
    }

    public function setEducation(string $education) : void {
        $this->education->setValue($education);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdProfile();
        $columns[] = $this->getLicenseNumber();
        $columns[] = $this->getPosts();
        $columns[] = $this->getExperience();
        $columns[] = $this->getEducation();
        return $columns;
    }
}
?>