<?php
class FileForm {
    const MIME_INFO = [
        'application/msword' => [
            K_EXT => [
                'doc' => 'iconoDOC.png',
                'dot' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' =>[
            K_EXT => [
                'docx' => 'iconoDOCX.png'
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.oasis.opendocument.text' => [
            K_EXT => [
                'odt' => 'iconoTXT.png'
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/pdf' => [
            K_EXT => [
                'pdf' => 'iconoPDF.png'
            ],
            K_CAT => V_DOC,
            K_REN => true
            ],
        'application/vnd.ms-excel' => [
            K_EXT => [
                'xls' => 'iconoXLS.png',
                'xlm' => '',
                'xla' => '',
                'xlc' => '',
                'xlt' => '',
                'xlw' => '',
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-excel.addin.macroenabled.12' => [
            K_EXT => [
                'xlam' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-excel.sheet.binary.macroenabled.12' => [
            K_EXT => [
                'xlsb' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-excel.sheet.macroenabled.12' => [
            K_EXT => [
                'xlsm' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-excel.template.macroenabled.12' => [
            K_EXT => [
                'xltm' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => [
            K_EXT => [
                'xlsx' => 'iconoXLSX.png'
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-powerpoint' => [
            K_EXT => [
                'ppt' => 'iconoPPT.png',
                'pps' => 'iconoPPS.png',
                'pot' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => [
            K_EXT => [
                'pptx' => 'iconoPPTX.png'
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-powerpoint.addin.macroenabled.12' => [
            K_EXT => [
                'ppam' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-powerpoint.presentation.macroenabled.12' => [
            K_EXT => [
                'pptm' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-powerpoint.slide.macroenabled.12' => [
            K_EXT => [
                'sldm' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-powerpoint.slideshow.macroenabled.12' => [
            K_EXT => [
                'ppsm' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-powerpoint.template.macroenabled.12' => [
            K_EXT => [
                'potm' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-word.document.macroenabled.12' => [
            K_EXT => [
                'docm' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/vnd.ms-word.template.macroenabled.12' => [
            K_EXT => [
                'dotm' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'application/x-7z-compressed' => [
            K_EXT => [
                '7z' => ''
            ],
            K_CAT => V_COM,
            K_REN => false
            ],
        'application/x-rar-compressed' => [
            K_EXT => [
                'rar' => 'iconoRAR.png'
            ],
            K_CAT => V_COM,
            K_REN => false
            ],
        'application/zip' => [
            K_EXT => [
                'zip' => 'iconoZIP.png'
            ],
            K_CAT => V_COM,
            K_REN => false
            ],
        'audio/mpeg' => [
            K_EXT => [
                'mpga' => '',
                'mp2' => '',
                'mp2a' => '',
                'mp3' => 'iconoMP3.png',
                'm2a' => '',
                'm3a' => ''
            ],
            K_CAT => V_AUD,
            K_REN => true
            ],
        'audio/ogg' => [
            K_EXT => [
                'oga' => '',
                'ogg' => 'iconoOGG.png',
                'spx' => '',
                'opus' => ''
            ],
            K_CAT => V_AUD,
            K_REN => true
            ],
        'audio/x-pn-realaudio' => [
            K_EXT => [
                'wma' => ''
            ],
            K_CAT => V_AUD,
            K_REN => true
            ],
        'audio/x-wav' => [
            K_EXT => [
                'wav' => ''
            ],
            K_CAT => V_VID,
            K_REN => true
            ],
        'audio/x-aac' =>[
            K_EXT => [
                'aac' => 'iconoOGG.png'
            ],
            K_CAT => V_AUD,
            K_REN => true
            ],
        'image/jpeg' => [
            K_EXT => [
                'jpeg' => 'iconoJPEG.png',
                'jpg' => 'iconoJPG.png',
                'jpe' => ''
            ],
            K_CAT => V_IMG,
            K_REN => true
            ],
        'image/png' => [
            K_EXT => [
                'png' => 'iconoPNG.png'
            ],
            K_CAT => V_IMG,
            K_REN => true
            ],
        'image/svg+xml' => [
            K_EXT => [
                'svg' => '',
                'svgz' => ''
            ],
            K_CAT => V_IMG,
            K_REN => true
            ],
        'image/tiff' => [
            K_EXT => [
                'tif' => 'iconoTIF.png',
                'tiff' => 'iconoTIFF.png'
            ],
            K_CAT => V_IMG,
            K_REN => false
            ],
        'image/vnd.adobe.photoshop' => [
            K_EXT => [
                'psd' => 'iconoPSD.png'
            ],
            K_CAT => V_IMG,
            K_REN => false
            ],
        'text/csv' => [
            K_EXT => [
                'csv' => ''
            ],
            K_CAT => V_DOC,
            K_REN => false
            ],
        'text/plain' => [
            K_EXT => [
                'txt' => 'iconoTXT.png',
                'text' => '',
                'conf' => '',
                'def' => '',
                'list' => '',
                'log' => '',
                'in' => ''
            ],
            K_CAT => V_DOC,
            K_REN => true
            ],
        'video/mp4' => [
            K_EXT => [
                'mp4' => 'iconoMPEG.png',
                'mp4v' => '',
                'mpg4' => ''
            ],
            K_CAT => V_VID,
            K_REN => true
            ],
        'video/mpeg' => [
            K_EXT => [
                'mpeg' => 'iconoMPEG.png',
                'mpg' => 'iconoMPG.png',
                'mpe' => '',
                'm1v' => '',
                'm2v' => ''
            ],
            K_CAT => V_VID,
            K_REN => true
            ],
        'video/quicktime' => [
            K_EXT => [
                'qt' => '',
                'mov' => ''
            ],
            K_CAT => V_VID,
            K_REN => true
            ],
        'video/x-flv' => [
            K_EXT => [
                'flv' => ''
            ],
            K_CAT => V_VID,
            K_REN => true
            ],
        'video/x-matroska' => [
            K_EXT => [
                'mkv' => '',
                'mk3d' => '',
                'mks' => ''
            ],
            K_CAT => V_VID,
            K_REN => true
            ],
        'video/x-ms-wmv' => [
            K_EXT => [
                'wmv' => ''
            ],
            K_CAT => V_VID,
            K_REN => true
            ],
        'video/x-msvideo' => [
            K_EXT => [
                'avi' => ''
            ],
            K_CAT => V_VID,
            K_REN => true
            ]
    ];
    protected const FILENAME_LENGTH = 15;
    protected const FILE_SIZE_BYTES = 2 * (1024 ** 3); // 2MiB 
    protected array $files = [];
    protected string $inputname;
    protected array $supportedFormats = [];
    protected string $dirpath;
    protected int $filenameLength;

    public function __construct(string $inputname, string $dirpath, array $supportedFormats=[], int $filenameLength=self::FILENAME_LENGTH){
        $this->inputname = $inputname;
        $this->supportedFormats = $supportedFormats;
        $this->dirpath = $dirpath;
        $this->filenameLength = $filenameLength>0? $filenameLength : static::FILENAME_LENGTH;
    }


    protected function fncCheckDefaultErrors(int $error) : string {
        switch($error){
        case UPLOAD_ERR_OK: $msg=''; break;
        case UPLOAD_ERR_INI_SIZE: $msg='Tamaño máximo excedido'; break;
        case UPLOAD_ERR_FORM_SIZE: $msg='Tamaño máximo excedido'; break;
        case UPLOAD_ERR_PARTIAL: $msg='El archivo fue parcialmente subido'; break;
        case UPLOAD_ERR_NO_FILE: $msg='Ningún archivo fue subido'; break;
        case UPLOAD_ERR_NO_TMP_DIR: $msg='Directorio temporal no encontrado'; break;
        case UPLOAD_ERR_CANT_WRITE: $msg='Error al escribir el archivo en disco'; break;
        case UPLOAD_ERR_EXTENSION: $msg='Una extensión de PHP paro la subida del archivo'; break;
        }
        return $msg;
    }

    protected function fncReceiveFiles() : ?bool{
        if (!isset($_FILES[$this->inputname]))
            return false;

        
        $inputfiles = Validations::isNumericArray($_FILES[$this->inputname])? [$_FILES[$this->inputname]] : $_FILES[$this->inputname];
        $countArchivos = count($inputfiles['name']);
        for ($i=0;$i<$countArchivos;$i++){
            $error = $inputfiles['error'][$i];
            $msg = $this->fncCheckDefaultErrors($error);
            $this->files[] = [
                'name' => [
                    'src' => $inputfiles['name'][$i],
                    'tmp' => $inputfiles['tmp_name'][$i]
                ],
                'type' => $inputfiles['type'][$i],
                'size' => $inputfiles['size'][$i],
                'error' => [
                    'code' => $error,
                    'msg' => $msg
                ]
            ];
        }
        return true;
    }

    protected function fncValidateFiles() {

        foreach ($this->files as $index=>$file){

            if ($file['error']['code']==0){

                $mimetype = mime_content_type($file['name']['tmp']);
                $mimeExtensions = static::fncGetMimeExtensions($mimetype);
                
                if (is_null($mimeExtensions)){
                    $this->files[$index]['error']['code'] = CE_UPLOAD_ERR_NO_MATCHING_MIME;
                    $this->files[$index]['error']['msg'] = 'Tipo de archivo no soportado';
                    continue;
                }

                $extension = mb_strtolower(pathinfo($file['name']['src'],PATHINFO_EXTENSION));
                
                if (trim($extension)==''){
                    $this->files[$index]['error']['code'] = CE_UPLOAD_ERR_NO_EXTENSION;
                    $this->files[$index]['error']['msg'] = 'El archivo debe tener una extensión';
                    continue;
                }

                if ((count($this->supportedFormats)>0) && !in_array($extension,$this->supportedFormats)){
                    $this->files[$index]['error']['code'] = CE_UPLOAD_ERR_NO_SUPPORTED;
                    $this->files[$index]['error']['msg'] = 'El sistema no admite el tipo de archivo';
                    continue;
                }

                if (!in_array($extension,$mimeExtensions)){
                    $this->files[$index]['error']['code'] = CE_UPLOAD_ERR_NO_MATCHING_EXT;
                    $this->files[$index]['error']['msg'] = 'El tipo de archivo no coincide con su extensión';
                    continue;
                }

                if ($file['size']>static::FILE_SIZE_BYTES){
                    $this->files[$index]['error']['code'] = CE_UPLOAD_ERR_SIZE_OVERFLOW;
                    $this->files[$index]['error']['msg'] = 'El archivo excede el tamaño permitido';
                    continue;
                }

                $this->files[$index]['type'] = $mimetype;
                $fileExtension = mb_strtolower(pathinfo($file['name']['src'],PATHINFO_EXTENSION));
                $this->files[$index]['icon'] = static::fncGetIcon($mimetype,$fileExtension);
            }
        }
    }

    public function fncSaveFiles(bool $nameGen=true) : ?array {
        if (!is_dir($this->dirpath))
            return null;

        if (false===$this->fncReceiveFiles())
            return null;
        
        $this->fncValidateFiles();

        $files = ['saved'=>[],'unsaved'=>[]];

        foreach($this->files as $i=>$file){
            if ($file['error']['code'] != UPLOAD_ERR_OK){
                $files['unsaved'][] = $this->files[$i];
                continue;
            }
            $extension = pathinfo($file['name']['src'],PATHINFO_EXTENSION);
            $idx = 0;
            do{
                if ($nameGen){
                    $uidname = $this->fncNewFilename();
                    $filename = "{$uidname}.{$extension}";

                    if (is_null($filename)){
                        $this->files[$i]['error']['code'] = CE_UPLOAD_ERR_NAME_GEN;
                        $this->files[$i]['error']['msg'] = 'Se ha producido un error al guardar el archivo';
                        $files['unsaved'][] = $this->files[$i];
                    }
                }else{
                    $name = pathinfo($file['name']['src'],PATHINFO_FILENAME);
                    $filename = $i==0? $file['name']['src'] : "{$name}({$idx}).{$extension}";
                    $idx++;
                }
                $filepath = str_ends_with($this->dirpath,'/')? "{$this->dirpath}{$filename}" : "{$this->dirpath}/{$filename}";

            }while(!is_null($filename) && @file_exists($filepath));

            if (is_null($filename))
                continue;

            $this->files[$i]['name']['src'] = $file['name']['src'];
            $this->files[$i]['name']['new'] = $filename;
            if (!@move_uploaded_file($file['name']['tmp'],$filepath)){
                $this->files[$i]['error']['code'] = CE_UPLOAD_ERR_SAVING_FILES;
                $this->files[$i]['error']['msg'] = 'Se ha producido un error al guardar el archivo';
                $files['unsaved'][] = $this->files[$i];
            }else{
                $files['saved'][] = $this->files[$i];
            }
        }
        // Devolvemos los archivos clasificados en guardados y no guardados
        return $files;
    }

    
    private function fncNewFilename() : ?string {
        try{
            $bytes = openssl_random_pseudo_bytes(length:$this->filenameLength);
        }catch(Exception $e){
            return null;
        }
        return mb_substr(bin2hex($bytes),0,$this->filenameLength);
    }


    public static function fncGetIcon(string $mimetype, string $extension) : string {
        if (!isset(self::MIME_INFO[$mimetype]) || !isset(self::MIME_INFO[$mimetype][K_EXT][$extension]))
            return 'iconoGEN.png';
        $icon = self::MIME_INFO[$mimetype][K_EXT][$extension];
        return $icon!=''? $icon : 'iconoGEN.png';
    }

    public static function fncGetMimeInfo(string $mimetype) : ?array {
        if (!isset(static::MIME_INFO[$mimetype]))
            return null;
        return static::MIME_INFO[$mimetype];
    }

    public static function fncGetMimeExtensions(string $mimetype) : ?array {
        if (!isset(static::MIME_INFO[$mimetype]))
            return null;
        return array_keys(static::MIME_INFO[$mimetype][K_EXT]);
    }
}
?>