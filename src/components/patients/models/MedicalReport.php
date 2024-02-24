<?php
class MedicalReport extends AbstractModel {
    private int $id;
    private int $id_patient;
    private int $id_worker;
    private int $id_appointment;
    private int $id_medical_center;
    private int $date;
    private string $affections;
    private string $summary_medical_history;
    private bool $allergic;
    private string $allergy_medications;
    private int $weight;
    private int $size;
    private int $imc;
    private float $temperature;
    private float $pressure;
    private int $heart_frecuency;
    private int $sat_o2;
    private string $physical_examination;
    private int $timestamp;
    private int $id_user_updater;

    public function __construct(int $id, 
        int $id_patient,
        int $id_worker,
        int $id_appointment,
        int $id_medical_center,
        int $date,
        string $affections,
        string $summary_medical_history,
        bool $allergic,
        string $allergy_medications,
        int $weight,
        int $size,
        int $imc,
        float $temperature,
        float $pressure,
        int $heart_frecuency,
        int $sat_o2,
        string $physical_examination,
        int $timestamp,
        int $id_user_updater){

        $this->setId($id);
        $this->setIdPatient($id_patient);
        $this->setIdWorker($id_worker);
        $this->setIdAppointment($id_appointment);
        $this->setIdMedicalCenter($id_medical_center);
        $this->setDate($date);
        $this->setAffections($affections);
        $this->setSummaryMedicalHistory($summary_medical_history);
        $this->setAllergic($allergic);
        $this->setAllergyMedications($allergy_medications);
        $this->setWeight($weight);
        $this->setSize($size);
        $this->setIMC($imc);
        $this->setTemperature($temperature);
        $this->setPressure($pressure);
        $this->setHeartFrecuency($heart_frecuency);
        $this->setSatO2($sat_o2);
        $this->setPhysicalExamination($physical_examination);
        $this->setTimestamp($timestamp);
        $this->setIdUserUpdater($id_user_updater);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }
    
    public function getIdPatient() : int {
        return $this->id_patient;
    }

    public function setIdPatient(int $id_patient) : void {
        $this->id_patient = $id_patient;
    }

    public function getIdAppointment() : int {
        return $this->id_appointment;
    }

    public function setIdAppointment(int $id_appointment) : void {
        $this->id_appointment = $id_appointment;
    }

    public function getIdMedicalCenter() : int {
        return $this->id_medical_center;
    }

    public function setIdMedicalCenter(int $id_medical_center) : void {
        $this->id_medical_center = $id_medical_center;
    }

    public function getAffections() : string {
        return $this->affections;
    }

    public function setAffections(string $affections) : void {
        $this->affections = $affections;
    }

    public function getSummaryMedicalHistory() : string {
        return $this->summary_medical_history;
    }

    public function setSummaryMedicalHistory(int $summary_medical_history) : void {
        $this->summary_medical_history = $summary_medical_history;
    }

    public function isAllergic() : bool {
        return $this->allergic;
    }

    public function setAllergic(bool $allergic) : void {
        $this->allergic = $allergic;
    }

    public function getAllergyMedications() : string {
        return $this->allergy_medications;
    }

    public function setAllergyMedications(string $allergy_medications) : void {
        $this->allergy_medications = $allergy_medications;
    }

    public function getWeight() : int {
        return $this->weight;
    }

    public function setWeight(int $weight) : void {
        $this->weight = $weight;
    }

    public function getSize() : int {
        return $this->size;
    }

    public function setSize(int $size) : void {
        $this->size = $size;
    }

    public function getIMC() : int {
        return $this->imc;
    }

    public function setIMC(int $imc) : void {
        $this->imc = $imc;
    }

    public function getTemperature() : float {
        return $this->temperature;
    }

    public function setTemperature(float $temperature) : void {
        $this->temperature = $temperature;
    }

    public function getPressure() : float {
        return $this->pressure;
    }

    public function setPressure(float $pressure) : void {
        $this->pressure = $pressure;
    }

    public function getHeartFrecuency() : int {
        return $this->heart_frecuency;
    }

    public function setHeartFrecuency(int $heart_frecuency) : void {
        $this->heart_frecuency = $heart_frecuency;
    }

    public function getSatO2() : int {
        return $this->sat_o2;
    }

    public function setSatO2(int $sat_o2) : void {
        $this->sat_o2 = $sat_o2;
    }

    public function getPhysicalExamination() : string {
        return $this->physical_examination;
    }

    public function setPhysicalExamination(string $physical_examination) : void {
        $this->physical_examination = $physical_examination;
    }

    public function getDate() : int {
        return $this->date;
    }

    public function setDate(int $date) : void {
        $this->date = $date;
    }

    public function getIdWorker() : int {
        return $this->id_worker;
    }

    public function setIdWorker(int $id_worker) : void {
        $this->id_worker = $id_worker;
    }

    
    public function getTimestamp() : int {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp = $timestamp;
    }

    public function getIdUserUpdater() : int {
        return $this->id_user_updater;
    }

    public function setIdUserUpdater(int $id_user_updater) : void {
        $this->id_user_updater = $id_user_updater;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>