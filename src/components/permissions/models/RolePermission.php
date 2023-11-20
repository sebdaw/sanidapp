<?php
class RolePermission extends AbstractModel {
    private int $id;
    private ?int $idType;
    private ?int $idRole;
    private ?int $idSection;
    private bool $enabled;
    private int $timestamp;
    private ?int $idUpdater;

    public function __construct(int $id,
                                ?int $idType,
                                ?int $idRole,
                                ?int $idSection,
                                bool $enabled,
                                int $timestamp,
                                ?int $idUpdater){
        $this->setId($id);
        $this->setIdType($idType);
        $this->setIdRole($idRole);
        $this->setIdSection($idSection);
        $this->setEnabled($enabled);
        $this->setTimestamp($timestamp);
        $this->setIdUpdater($idUpdater);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdType() : ?int {
        return $this->idType;
    }

    public function setIdType(?int $idType) : void {
        $this->idType = $idType;
    }

    public function getIdRole() : ?int {
        return $this->idRole;
    }

    public function setIdRole(?int $idRole) : void {
        $this->idRole = $idRole;
    }

    public function getIdSection() : ?int {
        return $this->idSection;
    }

    public function setIdSection(?int $idSection) : void {
        $this->idSection = $idSection;
    }

    public function isEnabled() : bool {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled) : void {
        $this->enabled = $enabled;
    }

    public function getIdUpdater() : ?int {
        return $this->idUpdater;
    }

    public function setIdUpdater(?int $idUpdater) : void {
        $this->idUpdater = $idUpdater;
    }

    public function getTimestamp() : int {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp = $timestamp;
    }

    public function __toString() : string {
        //TODO
        return '';
    }
}
?>