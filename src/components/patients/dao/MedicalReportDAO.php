<?php
class MedicalReportDAO extends AbstractDAO {

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'medical_reports',dtoname:'MedicalReportDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
        default:
            $sql .= " ORDER BY date DESC ";
        }
    }

    public function mapToModel(array $data) : MedicalReport {
        $id = $data['id'];
        $id_patient = $data['id_patient'];
        $id_worker = $data['id_worker'];
        $id_appointment = $data['id_appointment'];
        $id_medical_center = $data['id_medical_center'];
        $date = $data['date'];
        $affections = $data['affections'];
        $summary_medical_history = $data['summary_medical_history'];
        $allergic = $data['allergic'];
        $allergy_medications = $data['allergy_medications'];
        $weight = $data['weight'];
        $size = $data['size'];
        $imc = $data['imc'];
        $temperature = $data['temperature'];
        $pressure = $data['pressure'];
        $heart_frecuency = $data['heart_frecuency'];
        $sat_o2 = $data['sat_o2'];
        $physical_examination = $data['physical_examination'];
        $timestamp = $data['timestamp'];
        $id_user_updater = $data['id_user_updater'];


        $mr = new MedicalReport(id:$id,
        id_patient:$id_patient,
        id_worker:$id_worker,
        id_appointment:$id_appointment,
        id_medical_center:$id_medical_center,
        date:$date,
        affections:$affections,
        summary_medical_history:$summary_medical_history,
        allergic:$allergic,
        allergy_medications:$allergy_medications,
        weight:$weight,
        size:$size,
        imc:$imc,
        temperature:$temperature,
        pressure:$pressure,
        heart_frecuency:$heart_frecuency,
        sat_o2:$sat_o2,
        physical_examination:$physical_examination,
        timestamp:$timestamp,
        id_user_updater:$id_user_updater);
        return $mr;
    }
}
?>