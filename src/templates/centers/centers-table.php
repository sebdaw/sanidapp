<table id="centers-table">
    <thead>
        <tr>
            <th style="width:80px"></th>
            <th class="ta-left">NOMBRE</th>
            <th class="ta-left">LOCALIDAD</th>
            <th class="ta-left">DIRECCIÓN</th>
            <th style="width:50px"></th>
        </tr>
    </thead>
    <tbody>
    <?php
        if (!isset($_section_permissions))
            die;
        $page = (isset($_GET['page']) && Validations::isInteger($_GET['page']) && $_GET['page']>1)? intval($_GET['page']) : 1;
        $connection = new DBConnection;
        $udao = new UsersDAO(connection:$connection);
        $cdao = new MedicalCenterDAO(connection:$connection);
        $tdao = new TownDAO(connection:$connection);

        $results = $cdao->findAll(dto:null,page:$page);
        //TODO:añadir controles de paginacion
        $del_icon = URL_IMGS . "";
        $upd = $_section_permissions->checkPermission(UPD);
        $del = $_section_permissions->checkPermission(DEL);
        $updp = !$upd? "off" : null;
        $delp = !$del? "off" : null;
        foreach($results as $result){
            $result = (fn($n):MedicalCenter=>$n)($result);
            $id = $result->getId();
            $name = $result->getName();
            $location = $tdao->findById(id:$result->getIdTown());
            $location = (fn($n):Town=>$n)($location);
            $locationName = $location->getName();
            $address = $result->getAddress();
            $timestamp = $result->getTimestamp();
            $date = Date::getDate($timestamp)['datehm'][DDMMYYYY];
            $user = $udao->findById(id:$result->getIdUserUpdater());
            $aud_date = Date::getDate($result->getTimestamp());
            $date_title = ucfirst($aud_date['dayname']['long']) . ", {$aud_date['day']} de {$aud_date['monthname']['long']} de {$aud_date['year']}";

            $ondelete = ($del && ($result->getId()!=ROOT))? "onclick='deleteCenter($id)'" : null;
            $onupdate = ($upd && ($result->getId()!=ROOT))? "onclick='updateCenter($id)'" : null;
            $gearimg = URL_IMGS . "gear.svg";
            $audimg = URL_IMGS . "audit.svg";

            $idUpdater = $result->getIdUserUpdater()??0;
            $updater = $udao->findById(id:$idUpdater);
            $updater = (fn($n):?User=>$n)($updater);
            $updater_name = !is_null($updater)? $updater->getUsername() : '';
            echo <<<EOT
                <tr id="center-{$id}" style="display:none;">
                    <td class="row-buttons no-select">
                        <img class="edit {$updp} " title="Modificar" {$onupdate}>
                        <img class="delete {$delp} " title="Eliminar" {$ondelete}>
                    </td>
                    <td><span>{$name}</span></td>
                    <td><span>{$locationName}</span></td>
                    <td><span>{$address}</span></td>
                    <td class="center no-select"><img class="pointer" src="{$audimg}" title="({$updater_name}) {$date_title}"></td>
                </tr>
            EOT;
        }
        if (empty($results))
            echo "<tr><td class='ta-center' colspan='6'>No se han encontrado centros médicos</td></tr>";
    ?>
    </tbody>
</table>