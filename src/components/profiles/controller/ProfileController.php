<?php
class ProfileController{
    private ?UsersDAO $udao = null;
    private ?RolesDAO $rdao = null;
    private ?ProfilesDAO $pdao = null;
    private ?MedicalMembershipsDAO $mmdao = null;
    private ?ProfileMembershipsDAO $pmdao = null;

    public function __construct(?DBConnection $connection=null) {
        $this->udao = new UsersDAO(connection:$connection);
        $this->rdao = new RolesDAO(connection:$connection);
        $this->pdao = new ProfilesDAO(connection:$connection);
        $this->mmdao = new MedicalMembershipsDAO(connection:$connection);
        $this->pmdao = new ProfileMembershipsDAO(connection:$connection);
    }

    public function getProfile(string $dni) : ?UserProfilesBO {
        //TODO:
        return null;
    }

    public function getProfiles(int $idUser) : ?UserProfilesBO {
        $user = $this->udao->findById(id:$idUser);
        if (is_null($user))
            return null;
        $user = (fn($obj):User=>$obj)($user);
        $role = $this->rdao->findById(id:$user->getIdRole());
        if (is_null($role))
            return null;
        $upbo = new UserProfilesBO(user:$user,role:$role);
        $profiles = $this->pdao->findByIdUser(idUser:$user->getId());
        foreach($profiles as $profile){
            $profileMemberships = $this->pmdao->findByIdProfile(idProfile:$profile->getId());
            $pbo = new ProfileBO;
            $pbo->setProfile(profile:$profile);
            foreach($profileMemberships as $pm){
                if (!is_null($pm)){
                    $idmm = $pm->getIdMedicalMembership();
                    $mm = !is_null($idmm)? $this->mmdao->findById(id:$idmm) : null;
                    $mmbo = null;
                    if (!is_null($mm)){
                        $mmbo = new MembershipBO;
                        $mmbo->setProfileMembership(profileMembership:$pm);
                        $mmbo->setMedicalMembership(medicalMembership:$mm);
                        $pbo->addMembership(bo:$mmbo);
                    }
                }
            }
            $upbo->addProfile(bo:$pbo);
        }
        return $upbo;
    }
}
?>