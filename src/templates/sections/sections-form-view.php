<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATH_TEMPLATES . 'base/html_head.php';?>
    <link rel="stylesheet" href="<?=URL_CSS?>management/sections/sections.css">
    <script type="text/javascript" src="<?=URL_JS?>management/sections/sections-form.js"></script>
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
                'link' => 'role-form']
            ];
            echo Breadcrumb::display($breadcrumbs);
            ?>
            
            <section class="form-content">
                <form id="form_sections" class="w100" onSubmit="return false;">
                    <div class="form-input w100">
                        <label for="name">NOMBRE</label>
                        <input type="text" id="name" value="<?=(isset($data['section'])? $data['section']->getName() : '')?>">
                    </div>
                    <div class="form-input w50">
                        <label for="path">RUTA</label>
                        <input type="text" id="path" value="<?=(isset($data['section'])? $data['section']->getPath():'')?>">
                    </div>
                    <div class="form-input w50">
                        <label for="icon">ICONO</label>
                        <input type="text" id="icon" value="<?=(isset($data['section'])? $data['section']->getIcon():'')?>">
                    </div>
                    <div class="form-input">
                        <label for="block">BLOQUE</label>
                        <?php 
                            $selectedOption = isset($data['section'])? $data['section']->getIdBlock() : null;
                            $properties = [];
                            if (is_null($selectedOption)){
                                $selectedOption = isset($data['block'])? $data['block']->getId() : -1;
                                $properties = $selectedOption!=-1? ['disabled'] : [];
                            }
                            echo UX::combo(name:'block',options:$data['blocks'],selectedOption:$selectedOption,properties:$properties);
                        ?>
                    </div>
                    <div class="form-input w100">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:50px">TIPO</th>
                                    <th class="ta-left">DESCRIPCIÓN</th>
                                    <th style="width:50px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sp = isset($data['sectionPermissions'])? $data['sectionPermissions'] : [];
                                $ptdao = new PermissionsTypesDAO;
                                $permission_types = $ptdao->findAll(dto:null,page:ALL_PAGES);
                                foreach($permission_types as $pt){
                                    $idpt = $pt->getId();
                                    $description = ucfirst($pt->getDescription());
                                    $result = array_filter($sp,function($n)use($idpt){return $n->getIdType()==$idpt;});
                                    $enabled = !is_null(array_shift($result))? 'checked' : null;
                                    echo <<<EOT
                                    <tr id="pt-{$idpt}" data-type>
                                        <td>{$pt->getName()}</td>
                                        <td>{$description}</td>
                                        <td>
                                        <label class="input-switch">
                                            <input type="checkbox" data-type="simple-switch" value="1" style="display:none" {$enabled}>
                                        </label>
                                        </td>
                                    </tr>
                                    EOT;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <article class="button-box pd-h-1">
                    <div class="btn btn-save" onclick="save(<?=$data['action']?>,<?=(isset($data['section'])? $data['section']->getId() : null)?>)">GUARDAR</div>
                </article>
            </section>            
        </article>
        
        
    </main>
</body>
</html>