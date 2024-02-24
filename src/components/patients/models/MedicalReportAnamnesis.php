<?php
class MedicalReportAnamnesis extends AbstractModel {
    private int $id;
    private int $id_report;
    private int $id_anamnesis;
    private ?bool $yn;
    private bool $active;

    public function __construct(int $id, int $id_report, int $id_anamnesis, ?bool $yn, bool $active){
        $this->setId($id);
        $this->setIdReport($id_report);
        $this->setIdAnamnesis($id_anamnesis);
        $this->setYN($yn);
        $this->setActive($active);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdReport() : int {
        return $this->id_report;
    }

    public function setIdReport(int $id_report) : void {
        $this->id_report = $id_report;
    }

    public function getIdAnamnesis() : int {
        return $this->id_anamnesis;
    }

    public function setIdAnamnesis(int $id_anamnesis) : void {
        $this->id_anamnesis = $id_anamnesis;
    }

    public function getYN() : ?bool {
        return $this->yn;
    }

    public function setYN(?bool $yn) : void {
        $this->yn = $yn;
    }

    public function isActive() : bool {
        return $this->active;
    }

    public function setActive(bool $active) : void {
        $this->active = $active;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>