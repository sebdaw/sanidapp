<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATH_TEMPLATES . 'base/html_head.php';?>
    <link rel="stylesheet" href="<?=URL_CSS?>management/gpu/gpu.css">
    <script type="text/javascript" src="<?=URL_JS?>management/gpu/gpu.js"></script>
</head>
<body>
    <?php require_once PATH_TEMPLATES . 'base/top-nav.php';?>
    <form>
        <input type="hidden" id="apiconst" value="<?=API?>">
        <input type="hidden" id="delconst" value="<?=DEL?>">
        <input type="hidden" id="updconst" value="<?=UPD?>">
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

            ];
            echo Breadcrumb::display($breadcrumbs);
            ?>
            <article class="button-box">
                <form id="form-nu" action="user-form" method="POST" style="display:block;">
                    <input type="hidden" name="id" id="id" value="">
                </form>
            </article>
            <article class="searcher">
                <?php
                $connection = new DBConnection;
                $bdao = new BlocksDAO(connection:$connection);
                $rdao = new RolesDAO(connection:$connection);
                $blocks = array_map(function($n){return [$n->getId(),ucfirst($n->getName())];},$bdao->findAll(dto:null,page:ALL_PAGES));
                $roles = array_map(function($n){return [$n->getId(),ucfirst($n->getName())];},$rdao->findAll(dto:null,page:ALL_PAGES));
                ?>
                <form>
                    <div class="form-input w20">
                        <label for="search_block">BLOQUE</label>
                        <?=UX::combo(name:'search_block',options:$blocks,properties:["onchange='loadSections()'"])?>
                    </div>
                    <div class="form-input w20">
                        <label for="search_section">SECCIÓN</label>
                        <?=UX::combo(name:'search_section',options:[],properties:[])?>
                    </div>
                    <div class="form-input w20">
                        <label for="search_roles">ROL</label>
                        <?=UX::combo(name:'search_roles',options:$roles,properties:["onchange='loadUsers()'"])?>
                    </div>
                    <div class="form-input w20">
                        <label for="search_users">USUARIO</label>
                        <?=UX::combo(name:'search_users',options:[],properties:[])?>
                    </div>
                    <div style="padding:0 1rem;align-self:flex-end;">
                        <div class="btn" onclick="search()">BUSCAR</div>
                    </div>
                </form>
            </article>
            
            <article id="results"></article>
            <div class="button-box">
                <div class="btn btn-save" style="display:none;" onclick="save()">GUARDAR</div>
            </div>
        </article>
        
    </main>
</body>
</html>