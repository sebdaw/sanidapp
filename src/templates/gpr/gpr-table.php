<table id="gpr-table">
    <thead>
        <tr>
            <th style="width:50px">ID</th>
            <th style="width:50px">TIPO</th>
            <th class="ta-left">DESCRIPCIÓN</th>
            <th style="width:50px"></th>
        </tr>
    </thead>
    <tbody>
    <?php
        if (!isset($_section_permissions))
            die;
        $udao = new UsersDAO;

        $dto = new UserDTO;
        $dto->setDeleted(deleted:false);
        $users = $udao->findAll(dto:$dto,page:$page);
        //TODO:añadir controles de paginacion
        $del_icon = URL_IMGS . "";
        $upd = $_section_permissions->checkPermission(UPD);
        $del = $_section_permissions->checkPermission(DEL);
        $updp = !$upd? "off" : null;
        $delp = !$del? "off" : null;
        foreach($users as $user){
            $user = (fn($n):User=>$n)($user);
            $id = $user->getId();
            $name = $user->getUsername();
            $date = $user->getTimestamp()['datehm'][DDMMYYYY];
            $date_title = ucfirst($user->getTimestamp()['dayname']['long']) . ", {$user->getTimestamp()['day']} de {$user->getTimestamp()['monthname']['long']} de {$user->getTimestamp()['year']}";
            $ondelete = ($del && ($user->getId()!=ROOT))? "onclick='deleteUser($id)'" : null;
            $onupdate = ($upd && ($user->getId()!=ROOT))? "onclick='updateUser($id)'" : null;
            $off = $user->getId()==ROOT? 'off' : null;
            $gearimg = URL_IMGS . "gear.svg";
            $activeimg = $user->isActive()? URL_IMGS . 'circle-solid-1.svg': URL_IMGS . 'circle-solid-2.svg';
            $activetitle = $user->isActive()? 'Activo' : 'Inactivo';
            echo <<<EOT
                <tr id="user-{$id}" style="display:none;">
                    <td class="row-buttons no-select">
                        <img class="edit {$updp} {$off}" title="Modificar usuario" {$onupdate}>
                        <img class="delete {$delp} {$off}" title="Eliminar usuario" {$ondelete}>
                    </td>
                    <td class="ta-center"><span>{$id}</span></td>
                    <td><span>{$name}</span></td>
                    <td class="no-select"><img class="pointer" src="{$activeimg}" title="{$activetitle}"></td>
                    <td class="center no-select"><img class="pointer" src="{$gearimg}" title="{$date_title}"></td>
                </tr>
            EOT;
        }
    ?>
    </tbody>
</table>