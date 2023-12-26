<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once PATH_TEMPLATES . 'base/html_head.php';?>
    <link rel="stylesheet" href="<?=URL_CSS?>management/users/users.css">
    <script type="text/javascript" src="<?=URL_JS?>management/users/users-form.js"></script>
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

            $user_enabled = (isset($data['user'])? $data['user']->isActive() : null);
            $user_enabled = is_null($user_enabled)? null : ($user_enabled? 'checked' : null);
            ?>
            
            <section class="form-content">
                <form id="form_users" class="w100" onSubmit="return false;">
                    <div class="form-input w100">
                        <label for="username">NOMBRE</label>
                        <input type="text" id="username" value="<?=(isset($data['user'])? $data['user']->getUsername() : '')?>">
                    </div>
                    <div class="form-input w100">
                        <label for="password">CONTRASEÑA</label>
                        <input type="password" id="password" value="">
                    </div>
                    <div class="form-input w100">
                        <label for="password_confirmation">CONTRASEÑA (confirmación)</label>
                        <input type="password" id="password_confirmation" value="">
                    </div>
                    <div class="form-input">
                        <label for="roles">ROL</label>
                        <?=UX::combo(name:'roles',options:$data['roles'],defaultOption:null,selectedOption:(isset($data['user'])? $data['user']->getIdRole():-1))?>
                    </div>
                    <?php if ($data['action']==UPD){ ?>
                        <label class="input-switch">
                            <input type="checkbox" data-type="simple-switch" id="user-active" value="1" <?=$user_enabled?>>
                            <span>HABILITADO</span>
                        </label>
                    <?php } ?>
                </form>
                <article class="button-box pd-h-1">
                    <div class="btn btn-save" onclick="save(<?=$data['action']?>,<?=(isset($data['user'])? $data['user']->getId() : null)?>)">GUARDAR</div>
                </article>
            </section>            
        </article>
        
        
    </main>
</body>
</html>