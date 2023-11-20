<table id="roles-table">
    <thead>
        <tr>
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
        foreach($roles as $role){
            $role = (fn($n):Role=>$n)($role);
            $id = $role->getId();
            $name = $role->getName();
            $date = $role->getTimestamp()['datehm'][DDMMYYYY];
            echo <<<EOT
                <tr id="role-{$id}">
                    <td>{$id}</td>
                    <td>{$date}</td>
                    <td>{$name}</td>
                </tr>
            EOT;
        }
    ?>
    </tbody>
</table>