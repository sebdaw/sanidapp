<?php
class MedicalReportSocialHistory extends AbstractModel {
    private int $id;
    private int $id_report;
    private int $id_social;
    private string  $response;

    public function __construct(int $id, int $id_report, int $id_social, string $response){
        $this->setId($id);
        $this->setIdReport($id_report);
        $this->setIdSocial($id_social);
        $this->setResponse($response);
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

    public function getIdSocial() : int {
        return $this->id_social;
    }

    public function setIdSocial(int $id_social) : void {
        $this->id_social;
    }

    public function getResponse() : string {
        return $this->response;
    }

    public function setResponse(string $response) : void {
        $this->response = $response;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>