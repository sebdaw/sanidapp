<?php
class MedicalReportAnamnesisDTO extends AbstractDTO {
    private Column $id;
    private Column $id_report;
    private Column $id_anamnesis;
    private Column $yn;
    private Column $active;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_report = new Column(name:'id_report',type:'int');
        $this->id_anamnesis = new Column(name:'id_anamnesis',type:'int');
        $this->yn = new Column(name:'yn',type:'bool');
        $this->active = new Column(name:'active',type:'bool');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdReport() : Column {
        return $this->id_report;
    }

    public function setIdReport(int $id_report) : void {
        $this->id_report->setValue($id_report);
    }

    public function getIdAnamnesis() : Column {
        return $this->id_anamnesis;
    }

    public function setIdAnamnesis(int $id_anamnesis) : void {
        $this->id_anamnesis->setValue($id_anamnesis);
    }

    public function getYN() : Column {
        return $this->yn;
    }

    public function setYN(bool $yn) : void {
        $this->yn->setValue($yn);
    }

    public function isActive() : Column {
        return $this->active;
    }

    public function setActive(bool $active) : void {
        $this->active->setValue($active);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdReport();
        $columns[] = $this->getIdAnamnesis();
        $columns[] = $this->getYN();
        $columns[] = $this->isActive();
        return $columns;
    }
}
?>