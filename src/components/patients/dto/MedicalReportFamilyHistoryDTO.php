<?php
class MedicalReportFamilyHistoryDTO extends AbstractDTO {
    private Column $id;
    private Column $id_report;
    private Column $id_history;
    private Column $yn;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_report = new Column(name:'id_report',type:'int');
        $this->id_history = new Column(name:'id_history',type:'int');
        $this->yn = new Column(name:'yn',type:'bool');
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

    public function getIdHistory() : Column {
        return $this->id_history;
    }

    public function setIdHistory(int $id_history) : void {
        $this->id_history->setValue($id_history);
    }

    public function getYN() : Column {
        return $this->yn;
    }

    public function setYN(bool $yn) : void {
        $this->yn->setValue($yn);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdReport();
        $columns[] = $this->getIdHistory();
        $columns[] = $this->getYN();
        return $columns;
    }
}
?>