<?php
class ProfileMembershipsDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'profiles_memberships',dtoname:'ProfileMembershipDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY id DESC ";
        }
    }

    public function findByIdProfile(int $idProfile, bool $disconnect=false) : array {
        $profile = null;
        $dto = new ProfileMembershipDTO();
        $dto->setIdProfile($idProfile);
        $profiles = $this->findAll(dto:$dto,disconnect:$disconnect);
        $profile = array_shift($profiles);
        return $profile;
    }

    public function mapToModel(array $data) : ProfileMembership {
        $id = $data['id'];
        $idMedicalMembership = $data['id_medical_membership'];
        $idProfile = $data['id_profile'];
        $idm = $data['idm'];
        $timestamp = $data['timestamp'];
        $idUpdater = $data['id_user_updater'];
        $pm = new ProfileMembership(id:$id,idMedicalMembership:$idMedicalMembership,idProfile:$idProfile,idm:$idm,timestamp:$timestamp,idUpdater:$idUpdater);
        return $pm;
    }
}
?>