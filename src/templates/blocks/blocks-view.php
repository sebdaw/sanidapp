<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATH_TEMPLATES . 'base/html_head.php';?>
    <link rel="stylesheet" href="<?=URL_CSS?>management/blocks/blocks.css">
    <script type="text/javascript" src="<?=URL_JS?>management/blocks/blocks.js"></script>
</head>
<body>
    <?php require_once PATH_TEMPLATES . 'base/top-nav.php';?>
    <form>
        <input type="hidden" id="delconst" value="<?=DEL?>">
        <input type="hidden" id="updconst" value="<?=UPD?>">
        <input type="hidden" id="ordconst" value="<?=ORD?>">
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
            <article id="button-box">
                <form id="form-nb" action="block-form" method="POST" style="display:block;">
                    <input type="hidden" name="id" id="id" value="">
                </form>
                <div class="btn btn-plus" onclick="newBlock()">AÑADIR BLOQUE</div>
            </article>
            
            <article id="results"></article>
        </article>
        
    </main>
</body>
</html>