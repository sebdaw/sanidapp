<nav id="top-nav">
    <div id="logo-container"><a href="<?=PATH_HOME?>"><img src="<?=URL_IMGS . 'logo.png'?>"></a></div>
    <div id="user-account"><img src="<?=URL_IMGS . 'circle-user-regular.svg'?>"></div>
    <section id="user-account-menu">
        <div class="user-account-box">
            <a href="<?=PATH_LOGOUT?>"><img title="" src="<?=URL_IMGS . 'users-solid.svg'?>"></a>
            <p>perfiles</p>
        </div>
        <div class="user-account-box">
            <a href="<?=PATH_LOGOUT?>"><img title="Cerrar sesión" src="<?=URL_IMGS . 'exit.svg'?>"></a>
            <p> Cerrar sesión</p>
        </div>
    </section>
</nav>
<script>
    $(document).ready(function(){
        $(`#user-account>img`).click(function(){
            if ($(`#user-account-menu`).is(':visible')){
                $(`#user-account-menu`).fadeOut();
            }else{
                $(`#user-account-menu`).fadeIn();
            }
        });
    });
</script>