<?php
class Date {

    public static function init() : void {
        //TODO: mover
        date_default_timezone_set('Europe/Madrid');
    }

    public static function getDate(int $timestamp, string $delimiter='/') : array {
        $ddmmyyyy = DDMMYYYY;
        $yyyymmdd = YYYYMMDD;

        $data['timestamp'] = $timestamp;
        $data['year'] = date('Y',$timestamp);
        $data['month'] = date('m',$timestamp);
        $data['day'] = date('d',$timestamp);
        $data['hour'] = date('H',$timestamp);
        $data['minute'] = date('i',$timestamp);
        $data['second'] = date('s',$timestamp);
        $data['hm'] = "{$data['hour']}:{$data['minute']}";
        $data['hms'] = "{$data['hm']}:{$data['second']}";
        $data['weekday'] = date('N',$timestamp);
        $data['dayname'] = [
            'short' => static::getDayname($data['weekday'],true),
            'long' => static::getDayname($data['weekday'],false)
        ];
        $data['monthname'] = [
            'short' => static::getMonthname($data['month'],true),
            'long' => static::getMonthname($data['month'],false)
        ];
        $data['date'] = [
            DDMMYYYY => "{$data['day']}{$delimiter}{$data['month']}{$delimiter}{$data['year']}",
            YYYYMMDD => "{$data['year']}{$delimiter}{$data['month']}{$delimiter}{$data['day']}"
        ];
        $data['datehm'] = [
            DDMMYYYY => "{$data['date'][$ddmmyyyy]} {$data['hm']}",
            YYYYMMDD => "{$data['date'][$yyyymmdd]} {$data['hm']}"
        ];
        $data['datehms'] = [
            DDMMYYYY => "{$data['date'][$ddmmyyyy]} {$data['hms']}",
            YYYYMMDD => "{$data['date'][$yyyymmdd]} {$data['hms']}"
        ];
        return $data;
    }

    public static function getDayname(int $weekday, bool $short=false) : ?string {
        switch($weekday){
            case 1:
                $weekdayname = $short? 'lun' : 'lunes';
                break;
            case 2:
                $weekdayname = $short? 'mar' : 'martes';
                break;
            case 3:
                $weekdayname = $short? 'miérc' : 'miércoles';
                break;
            case 4:
                $weekdayname = $short? 'juev' : 'jueves';
                break;
            case 5:
                $weekdayname = $short? 'vier' : 'viernes';
                break;
            case 6:
                $weekdayname = $short? 'sáb' : 'sábado';
                break;
            case 7:
                $weekdayname = $short? 'dom' : 'Domingo';
                break;
            default:
                $weekdayname = null;
            }
            return $weekdayname;
    }

    public static function getMonthname(int $month, bool $short=false) : ?string {
        switch($month){
            case 1:
                $monthname = $short? 'ene' : 'enero';
                break;
            case 2:
                $monthname = $short? 'feb' : 'febrero';
                break;
            case 3:
                $monthname = $short? 'mar' : 'marzo';
                break;
            case 4:
                $monthname = $short? 'abr' : 'abril';
                break;
            case 5:
                $monthname = $short? 'may' : 'mayo';
                break;
            case 6:
                $monthname = $short? 'jun' : 'junio';
                break;
            case 7:
                $monthname = $short? 'jul' : 'julio';
                break;
            case 8:
                $monthname = $short? 'ago' : 'agosto';
                break;
            case 9:
                $monthname = $short? 'sep' : 'septiembre';
                break;
            case 10:
                $monthname = $short? 'oct' : 'octubre';
                break;
            case 11:
                $monthname = $short? 'nov' : 'noviembre';
                break;
            case 12:
                $monthname = $short? 'dic' : 'diciembre';
                break;
            case $monthname = null;
            }
            return $monthname;
    }

    public static function isValidDate(string $date, string $delimiter='/', int $format=YYYYMMDD){
            switch($format){
            case YYYYMMDD: 
                $rgx_ymd = "#^[1-9]{1}[0-9]{3}{$delimiter}[0-9]{2}{$delimiter}[0-9]{2}$#"; 
                if (preg_match($rgx_ymd,$date)){
                    $ymd = explode($delimiter,$date);
                    return checkdate(month:$ymd[1],day:$ymd[2],year:$ymd[0]);
                }

                $rgx_ymdhm = "#^[1-9]{1}[0-9]{3}{$delimiter}[0-9]{2}{$delimiter}[0-9]{2}(\s[0-9]{2}:[0-9]{2})?$#";
                if (preg_match($rgx_ymdhm,$date)){
                    $ymd = explode($delimiter,explode(' ',$date)[0]);
                    $hm = explode($delimiter,explode(' ',$date)[1])[0];
                    $isValid = (checkdate(month:$ymd[1],day:$ymd[2],year:$ymd[0]) && static::isValidTime($hm));
                }

                $rgx_ymdhms = "#^[1-9]{1}[0-9]{3}{$delimiter}[0-9]{2}{$delimiter}[0-9]{2}(\s[0-9]{2}:[0-9]{2}:[0-9]{2})?$#";
                if (preg_match($rgx_ymdhms,$date)){
                    $ymd = explode($delimiter,explode(' ',$date)[0]);
                    $hms = explode($delimiter,explode(' ',$date)[1])[0];
                    $isValid = (checkdate(month:$ymd[1],day:$ymd[2],year:$ymd[0]) && static::isValidTime($hms));
                }
                break;
            case DDMMYYYY:
                $rgx_dmy = "#^[0-9]{2}{$delimiter}[0-9]{2}{$delimiter}[1-9]{1}[0-9]{3}$#"; 
                if (preg_match($rgx_dmy,$date)){
                    $dmy = explode($delimiter,$date);
                    return checkdate(month:$dmy[1],day:$dmy[0],year:$dmy[2]);
                }

                $rgx_dmyhm = "#^[0-9]{2}{$delimiter}[0-9]{2}{$delimiter}[1-9]{1}[0-9]{3}(\s[0-9]{2}:[0-9]{2})?$#"; 
                if (preg_match($rgx_dmyhm,$date)){
                    $dmy = explode($delimiter,explode(' ',$date)[0]);
                    $hm = explode($delimiter,explode(' ',$date)[1])[0];
                    return (checkdate(month:$dmy[1],day:$dmy[0],year:$dmy[2]) && static::isValidTime($hm));
                }

                $rgx_dmyhms = "#^[0-9]{2}{$delimiter}[0-9]{2}{$delimiter}[1-9]{1}[0-9]{3}(\s[0-9]{2}:[0-9]{2}:[0-9]{2})?$#"; 
                if (preg_match($rgx_dmyhms,$date)){
                    $dmy = explode($delimiter,explode(' ',$date)[0]);
                    $hms = explode($delimiter,explode(' ',$date)[1])[0];
                    return (checkdate(month:$dmy[1],day:$dmy[0],year:$dmy[2]) && static::isValidTime($hms));
                }
                break;
            }
            return false;
    }

    public static function isValidTime(string $time) : bool {
        $rgx_hm = "#^[0-9]{2}:[0-9]{2}$#";
        $rgx_hms = "#^[0-9]{2}:[0-9]{2}:[0-9]{2}$#";
        if (preg_match($rgx_hm,$time)){
            $hm = explode(':',$time);
            $h = intval($hm[0]);
            $m = intval($hm[1]);
            return (($h >=0) && ($h <= 23) && ($m >= 0) && ($m <= 59));
        }else if (preg_match($rgx_hms,$time)){
            $hms = explode(':',$time);
            $h = intval($hms[0]);
            $m = intval($hms[1]);
            $s = intval($hms[2]);
            return (($h >=0) && ($h <= 23) && ($m >= 0) && ($m <= 59) && ($s >= 0) && ($s <= 59));
        }
        return false;
    }
}
?>