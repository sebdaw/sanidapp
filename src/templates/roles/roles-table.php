<table id="roles-table">
    <thead>
        <tr>
            <th style="width:80px"></th>
            <th style="width:32px">ID</th>
            <th>NOMBRE</th>
            <th style="width:32px"></th>
        </tr>
    </thead>
    <tbody>
    <?php
        if (!isset($_section_permissions))
            die;
        $page = (isset($_GET['page']) && Validations::isInteger($_GET['page']) && $_GET['page']>1)? intval($_GET['page']) : 1;
        $connection = new DBConnection;
        $rdao = new RolesDAO(connection:$connection);
        $udao = new UsersDAO(connection:$connection);

        $roles = $rdao->findAll(dto:null,page:$page);
        //TODO:añadir controles de paginacion
        $del_icon = URL_IMGS . "";
        $upd = $_section_permissions->checkPermission(UPD);
        $del = $_section_permissions->checkPermission(DEL);
        $updp = !$upd? "off" : null;
        $delp = !$del? "off" : null;
        foreach($roles as $role){
            $role = (fn($n):Role=>$n)($role);
            $id = $role->getId();
            $name = $role->getName();
            $date = ucfirst($role->getTimestamp()['dayname']['long']) . ", {$role->getTimestamp()['day']} de {$role->getTimestamp()['monthname']['long']} de {$role->getTimestamp()['year']}";
            $ondelete = ($del && $role->getId()!=ROOT_ROLE)? "onclick='deleteRole($id)'" : null;
            $off = !($del && $role->getId()!=ROOT_ROLE)? 'off' : null;
            $onupdate = $upd? "onclick='updateRole($id)'" : null;

            $audimg = URL_IMGS . "audit.svg";

            $idUpdater = $role->getIdUpdater()??0;
            $updater = $udao->findById(id:$idUpdater);
            $updater = (fn($n):?User=>$n)($updater);
            $updater_name = !is_null($updater)? $updater->getUsername() : '';
            echo <<<EOT
                <tr id="role-{$id}" style="display:none;">
                    <td class="row-buttons">
                        <img class="edit {$updp}" title="Modificar rol" {$onupdate}>
                        <img class="delete {$delp} {$off}" title="Eliminar rol" {$ondelete}>
                    </td>
                    <td><span>{$id}</span></td>
                    <td><span>{$name}</span></td>
                    <td class="center no-select"><img title="({$updater_name}) {$date}" src="{$audimg}" class="pointer"></td>
                </tr>
            EOT;
        }
    ?>
    </tbody>
</table>