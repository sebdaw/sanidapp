<?php
class MedicalReportSocialHistoryDTO extends AbstractDTO {
    private Column $id;
    private Column $id_report;
    private Column $id_social;
    private Column $response;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_report = new Column(name:'id_report',type:'int');
        $this->id_social = new Column(name:'id_social',type:'int');
        $this->response = new Column(name:'response',type:'string');
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

    public function getIdSocial() : Column {
        return $this->id_social;
    }

    public function setIdSocial(int $id_social) : void {
        $this->id_social->setValue($id_social);
    }

    public function getResponse() : Column {
        return $this->response;
    }

    public function setResponse(string $response) : void {
        $this->response->setValue($response);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdReport();
        $columns[] = $this->getIdSocial();
        $columns[] = $this->getResponse();
        return $columns;
    }
}
?>