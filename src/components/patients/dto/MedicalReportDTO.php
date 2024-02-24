<?php
class MedicalReportDTO extends AbstractDTO {
    private Column $id;
    private Column $id_patient;
    private Column $id_worker;
    private Column $id_appointment;
    private Column $id_medical_center;
    private Column $date;
    private Column $affections;
    private Column $summary_medical_history;
    private Column $allergic;
    private Column $allergy_medications;
    private Column $weight;
    private Column $size;
    private Column $imc;
    private Column $temperature;
    private Column $pressure;
    private Column $heart_frecuency;
    private Column $sat_o2;
    private Column $physical_examination;
    private Column $timestamp;
    private Column $id_user_updater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_patient = new Column(name:'id_patient',type:'int');
        $this->id_worker = new Column(name:'id_worker',type:'int');
        $this->id_appointment = new Column(name:'id_appointment',type:'int');
        $this->id_medical_center = new Column(name:'id_medical_center',type:'int');
        $this->date = new Column(name:'date',type:'int');
        $this->affections = new Column(name:'affections',type:'string');
        $this->summary_medical_history = new Column(name:'summary_medical_history',type:'string');
        $this->allergic = new Column(name:'allergic',type:'bool');
        $this->allergy_medications = new Column(name:'allergy_medications',type:'string');
        $this->weight = new Column(name:'weight',type:'int');
        $this->size = new Column(name:'size',type:'int');
        $this->imc = new Column(name:'imc',type:'int');
        $this->temperature = new Column(name:'temperature',type:'float');
        $this->pressure = new Column(name:'pressure',type:'float');
        $this->heart_frecuency = new Column(name:'heart_frecuency',type:'int');
        $this->sat_o2 = new Column(name:'sat_o2',type:'int');
        $this->physical_examination = new Column(name:'physical_examination',type:'string');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->id_user_updater = new Column(name:'id_user_updater',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }
    
    public function getIdPatient() : Column {
        return $this->id_patient;
    }

    public function setIdPatient(int $id_patient) : void {
        $this->id_patient->setValue($id_patient);
    }

    public function getIdAppointment() : Column {
        return $this->id_appointment;
    }

    public function setIdAppointment(int $id_appointment) : void {
        $this->id_appointment->setValue($id_appointment);
    }

    public function getIdMedicalCenter() : Column {
        return $this->id_medical_center;
    }

    public function setIdMedicalCenter(int $id_medical_center) : void {
        $this->id_medical_center->setValue($id_medical_center);
    }

    public function getAffections() : Column {
        return $this->affections;
    }

    public function setAffections(string $affections) : void {
        $this->affections->setValue($affections);
    }

    public function getSummaryMedicalHistory() : Column {
        return $this->summary_medical_history;
    }

    public function setSummaryMedicalHistory(int $summary_medical_history) : void {
        $this->summary_medical_history->setValue($summary_medical_history);
    }

    public function isAllergic() : Column {
        return $this->allergic;
    }

    public function setAllergic(bool $allergic) : void {
        $this->allergic->setValue($allergic);
    }

    public function getAllergyMedications() : Column {
        return $this->allergy_medications;
    }

    public function setAllergyMedications(string $allergy_medications) : void {
        $this->allergy_medications->setValue($allergy_medications);
    }

    public function getWeight() : Column {
        return $this->weight;
    }

    public function setWeight(int $weight) : void {
        $this->weight->setValue($weight);
    }

    public function getSize() : Column {
        return $this->size;
    }

    public function setSize(int $size) : void {
        $this->size->setValue($size);
    }

    public function getIMC() : Column {
        return $this->imc;
    }

    public function setIMC(int $imc) : void {
        $this->imc->setValue($imc);
    }

    public function getTemperature() : Column {
        return $this->temperature;
    }

    public function setTemperature(float $temperature) : void {
        $this->temperature->setValue($temperature);
    }

    public function getPressure() : Column {
        return $this->pressure;
    }

    public function setPressure(float $pressure) : void {
        $this->pressure->setValue($pressure);
    }

    public function getHeartFrecuency() : Column {
        return $this->heart_frecuency;
    }

    public function setHeartFrecuency(int $heart_frecuency) : void {
        $this->heart_frecuency->setValue($heart_frecuency);
    }

    public function getSatO2() : Column {
        return $this->sat_o2;
    }

    public function setSatO2(int $sat_o2) : void {
        $this->sat_o2->setValue($sat_o2);
    }

    public function getPhysicalExamination() : Column {
        return $this->physical_examination;
    }

    public function setPhysicalExamination(string $physical_examination) : void {
        $this->physical_examination->setValue($physical_examination);
    }

    public function getDate() : Column {
        return $this->date;
    }

    public function setDate(int $date) : void {
        $this->date->setValue($date);
    }

    public function getIdWorker() : Column {
        return $this->id_worker;
    }

    public function setIdWorker(int $id_worker) : void {
        $this->id_worker->setValue($id_worker);
    }

    
    public function getTimestamp() : Column {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp->setValue($timestamp);
    }

    public function getIdUserUpdater() : Column {
        return $this->id_user_updater;
    }

    public function setIdUserUpdater(int $id_user_updater) : void {
        $this->id_user_updater->setValue($id_user_updater);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdPatient();
        $columns[] = $this->getIdWorker();
        $columns[] = $this->getIdAppointment();
        $columns[] = $this->getIdMedicalCenter();
        $columns[] = $this->getAffections();
        $columns[] = $this->getSummaryMedicalHistory();
        $columns[] = $this->isAllergic();
        $columns[] = $this->getAllergyMedications();
        $columns[] = $this->getWeight();
        $columns[] = $this->getSize();
        $columns[] = $this->getIMC();
        $columns[] = $this->getTemperature();
        $columns[] = $this->getPressure();
        $columns[] = $this->getHeartFrecuency();
        $columns[] = $this->getSatO2();
        $columns[] = $this->getPhysicalExamination();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUserUpdater();
        return $columns;
    }
}
?>