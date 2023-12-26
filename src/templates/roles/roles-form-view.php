<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATH_TEMPLATES . 'base/html_head.php';?>
    <link rel="stylesheet" href="<?=URL_CSS?>management/roles/roles.css">
    <script type="text/javascript" src="<?=URL_JS?>management/roles/roles-form.js"></script>
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
                <form id="form_roles" class="w100">
                    <div class="form-input w100">
                        <label for="rolename">NOMBRE</label>
                        <input type="text" id="rolename" value="<?=(isset($data['role'])? $data['role']->getName() : '')?>">
                    </div>
                </form>
                <article class="button-box pd-h-1">
                    <div class="btn btn-save" onclick="save(<?=$data['action']?>,<?=(isset($data['role'])? $data['role']->getId() : null)?>)">GUARDAR</div>
                </article>
            </section>
        </article>
    </main>
</body>
</html>