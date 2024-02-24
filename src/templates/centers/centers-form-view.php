<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATH_TEMPLATES . 'base/html_head.php';?>
    <link rel="stylesheet" href="<?=URL_CSS?>medical-cs/centers/centers.css">
    <script type="text/javascript" src="<?=URL_JS?>medical-cs/centers/centers-form.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script type="text/javascript" src="<?=URL_JS?>editor.js"></script>

</head>
<body>
    <?php require_once PATH_TEMPLATES . 'base/top-nav.php';?>
    <form>
        <input type="hidden" id="insconst" value="<?=INS?>">
    </form>
    <main>
        <?php require_once PATH_TEMPLATES . 'base/side-nav.php';?>
        <article id="main-container">
            <?php 
            $breadcrumbs = [
                ['name' => $_block->getName(),
                'link' => ''],
                ['name' => $_section->getName(),
                'link' => $_section->getPath()],
                ['name' => 'Formulario',
                'link' => 'center-form']
            ];
            echo Breadcrumb::display($breadcrumbs);

            $id = '';
            $name = '';
            $address = '';
            $cp = '';
            $phone = '';
            $email = '';
            $town = -1;
            $province = -1;
            $community = -1;
            $membership = 1;
            $description = '';
            if (isset($data['center'])){
                $id = $data['center']->getId();
                $name = $data['center']->getName();
                $address = $data['center']->getAddress();
                $cp = $data['center']->getCP();
                $phone = $data['center']->getPhone();
                $email = $data['center']->getEmail();
                $membership = $data['center']->getIdMembership();
                $town = $data['center']->getIdTown();
                $province = $data['idProvince'];
                $community = $data['idCommunity'];
                $description = $data['description'];
            }
            ?>
            
            <section class="form-content">
                <form id="form_centers" class="w100" onSubmit="return false;">
                    <input type="hidden" id="tmp_desc" value="<?=$description?>">
                    <div class="form-input w100">
                        <label for="name">NOMBRE</label>
                        <input type="text" name="name" id="name" value="<?=$name?>">
                    </div>
                    <div class="form-input w75">
                        <label for="address">DIRECCIÓN</label>
                        <input type="text" id="address" value="<?=$address?>">
                    </div>
                    <div class="form-input w25">
                        <label for="cp">CP</label>
                        <input type="number" id="cp" value="<?=$cp?>">
                    </div>
                    <div class="form-input w33">
                        <label for="phone">TELÉFONO</label>
                        <input type="text" id="phone" value="<?=$phone?>">
                    </div>
                    <div class="form-input w33">
                        <label for="email">EMAIL</label>
                        <input type="email" id="email" value="<?=$email?>">
                    </div>
                    <div class="form-input w33">
                        <label for="memberships">AFILIACIÓN</label>
                        <?=UX::combo(name:'memberships',options:$data['memberships'],selectedOption:$membership,defaultOption:null)?>
                    </div>
                    <div class="form-input w100">
                        <label for="description">DESCRIPCIÓN</label>
                        <div id="editor" class="ckeditor"></div>
                    </div>
                    <div class="form-input w33">
                        <label for="communities">COMUNIDAD</label>
                        <?=UX::combo(name:'communities',options:$data['communities'],selectedOption:$community,properties:['onchange="findProvinces()"'])?>
                    </div>
                    <div class="form-input w33">
                        <label for="provinces">PROVINCIA</label>
                        <?=UX::combo(name:'provinces',options:(isset($data['provinces'])? $data['provinces'] : []),selectedOption:$province,properties:['onchange="findTowns()"'])?>
                    </div>
                    <div class="form-input w33">
                        <label for="towns">LOCALIDAD</label>
                        <?=UX::combo(name:'towns',options:(isset($data['towns'])? $data['towns'] : []),defaultOption:null,selectedOption:$town)?>
                    </div>
                    <input type="hidden" id="files" value=''>
                    <article class="button-box pd-h-1" style="justify-content:start">
                        <input type="file" style="display:none" id="file-selector" accept="image/jpeg, image/png" onchange="readFiles(event)" multiple>
                        <div class="btn" onclick="selectFiles()">SELECCIONAR IMÁGENES</div>
                    </article>
                </form>
                <div class="center-gallery">
                    <?php
                        $cipher = new Cipher;
                        foreach($data['files'] as $urlimg){
                            $jsondata = [
                                ID_USER_SESSION => null,
                                'id-center' => $id,
                                'file' => $urlimg,
                                'timestamp' => time()
                            ];
                            $json = json_encode($jsondata,flags:JSON_UNESCAPED_UNICODE);
                            $token = $cipher->encrypt($json);
                            echo "<img src='file.php?token={$token}'>";
                        }
                    ?>
                </div>
                <div class="image-gallery">
                </div>
                <article class="button-box pd-h-1">
                    <div class="btn btn-save" onclick="save(<?=$data['action']?>,<?=(isset($data['center'])? $id: null)?>)">GUARDAR</div>
                </article>
            </section>            
        </article>
        
        
    </main>
</body>
</html>