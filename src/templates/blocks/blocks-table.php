<table id="blocks-table">
    <thead>
        <tr>
            <th style="width:160px"></th>
            <th style="width:50px">#</th>
            <th style="width:50px">ID</th>
            <th class="ta-left">NOMBRE</th>
            <th style="width:100px">SECCIONES</th>
            <th style="width:50px"></th>
        </tr>
    </thead>
    <tbody>
    <?php
        if (!isset($_section_permissions))
            die;
        $connection = new DBConnection;
        $bdao = new BlocksDAO(connection:$connection);
        $udao = new UsersDAO(connection:$connection);

        $blocks = $bdao->getAll(dto:null,page:ALL_PAGES);
        //TODO:añadir controles de paginacion
        $upd = $_section_permissions->checkPermission(UPD);
        $del = $_section_permissions->checkPermission(DEL);
        $ord = $_section_permissions->checkPermission(ORD);
        $countBlocks = count($blocks);
        foreach($blocks as $i=>$block){
            $block = (fn($n):Block=>$n)($block);
            $id = $block->getId();
            $name = $block->getName();
            $position = $block->getOrder();
            $numSections = $block->getNumSections();
            $date = ucfirst($block->getTimestamp()['dayname']['long']) . ", {$block->getTimestamp()['day']} de {$block->getTimestamp()['monthname']['long']} de {$block->getTimestamp()['year']}";
            $ondelete = ($del && ($numSections==0) && ($_section_permissions->getBlock()->getId()!=$block->getId()))? "onclick='deleteBlock($id)'" : null;
            $onupdate = $upd? "onclick='updateBlock({$id})'" : null;
            $up = ORD_DOWN;
            $down = ORD_UP;
            $onorder_up = ($ord && $countBlocks>1 && $i>0)? "onclick='changePosition({$id},{$up})'" : null;
            $onorder_down = ($ord && $countBlocks && $i<($countBlocks-1))? "onclick='changePosition({$id},{$down})'" : null;
            $off_delete = (!$del || ($numSections>0) || ($_section_permissions->getBlock()->getId()==$block->getId()))? 'off' : null;
            $off_update = !$upd? 'off' : null;
            $off_orderup = !($ord && $countBlocks>1 && $i>0)? 'off' : null;
            $off_orderdown = !($ord && $countBlocks && $i<($countBlocks-1))? 'off' : null;
            $audimg = URL_IMGS . "audit.svg";

            $idUpdater = $block->getIdUpdater()??0;
            $updater = $udao->findById(id:$idUpdater);
            $updater = (fn($n):?User=>$n)($updater);
            $updater_name = !is_null($updater)? $updater->getUsername() : '';

            echo <<<EOT
                <tr id="block-{$id}" style="display:none;">
                    <td class="row-buttons no-select">
                        <img class="edit {$off_update}" title="Modificar bloque" {$onupdate}>
                        <img class="delete {$off_delete}" title="Eliminar bloque" {$ondelete}>
                        <img class="order-up {$off_orderup}" title="Subir posición" {$onorder_up}>
                        <img class="order-down {$off_orderdown}" title="Bajar posición" {$onorder_down}>
                    </td>
                    <td class="ta-center"><span>{$position}</span></td>
                    <td class="ta-center"><span>{$id}</span></td>
                    <td><span>{$name}</span></td>
                    <td class="ta-center"><span>{$numSections}</span></td>
                    <td class="center no-select"><img class="pointer" src="{$audimg}" title="({$updater_name}) {$date}"></td>
                </tr>
            EOT;
        }
    ?>
    </tbody>
</table>