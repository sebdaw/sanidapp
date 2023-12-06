<table id="roles-table">
    <thead>
        <tr>
            <th style="width:80px"></th>
            <th>ID</th>
            <th>FECHA</th>
            <th>NOMBRE</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if (!isset($_section_permissions))
            die;
        $page = (isset($_GET['page']) && Validations::isInteger($_GET['page']) && $_GET['page']>1)? intval($_GET['page']) : 1;
        $rdao = new RolesDAO;

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
            $date = $role->getTimestamp()['datehm'][DDMMYYYY];
            $date_title = ucfirst($role->getTimestamp()['dayname']['long']) . ", {$role->getTimestamp()['day']} de {$role->getTimestamp()['monthname']['long']} de {$role->getTimestamp()['year']}";
            $ondelete = $del? "onclick='deleteRole($id)'" : null;
            $onupdate = $upd? "onclick='updateRole($id)'" : null;
            echo <<<EOT
                <tr id="role-{$id}" style="display:none;">
                    <td class="row-buttons">
                        <img class="edit {$updp}" title="Modificar rol" {$onupdate}>
                        <img class="delete {$delp}" title="Eliminar rol" {$ondelete}>
                    </td>
                    <td><span>{$id}</span></td>
                    <td><span title="{$date_title}">{$date}</span></td>
                    <td><span>{$name}</span></td>
                </tr>
            EOT;
        }
    ?>
    </tbody>
</table>