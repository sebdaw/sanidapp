<?php
class MedicalReportFamilyHistory extends AbstractModel {
    private int $id;
    private int $id_report;
    private int $id_history;
    private bool $yn;

    public function __construct(int $id, int $id_report, int $id_history, bool $yn){
        $this->setId($id);
        $this->setIdReport($id_report);
        $this->setIdHistory($id_history);
        $this->setYN($yn);
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

    public function getIdHistory() : int {
        return $this->id_history;
    }

    public function setIdHistory(int $id_history) : void {
        $this->id_history;
    }

    public function getYN() : ?bool {
        return $this->yn;
    }

    public function setYN(?bool $yn) : void {
        $this->yn = $yn;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>