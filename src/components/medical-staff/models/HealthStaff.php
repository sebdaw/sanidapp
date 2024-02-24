<?php
class HealthStaff extends AbstractModel {
    private int $id;
    private int $id_profile;
    private int $license_number;
    private string $posts_research;
    private string $experience;
    private string $education;

    public function __construct(int $id, int $id_profile, int $license_number, string $posts_research, string $experience, string $education){
        $this->setId($id);
        $this->setIdProfile($id_profile);
        $this->setLicenseNumber($license_number);
        $this->setPosts($posts_research);
        $this->setExperience($experience);
        $this->setEducation($education);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdProfile() : int {
        return $this->id_profile;
    }

    public function setIdProfile(int $id_profile) : void {
        $this->id_profile = $id_profile;
    }

    public function getLicenseNumber() : int {
        return $this->license_number;
    }

    public function setLicenseNumber(int $license_number) : void {
        $this->license_number = $license_number;
    }

    public function getPosts() : string {
        return $this->posts_research;
    }

    public function setPosts(string $posts_research) : void {
        $this->posts_research = $posts_research;
    }

    public function getExperience() : string {
        return $this->experience;
    }

    public function setExperience(string $experience) : void {
        $this->experience = $experience;
    }

    public function getEducation() : string {
        return $this->education;
    }

    public function setEducation(string $education) : void {
        $this->education = $education;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>