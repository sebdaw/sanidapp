<?php
if (!isset($_section_permissions))
    die;
$connection = new DBConnection;
$bdao = new BlocksDAO(connection:$connection);
$sdao = new SectionDAO(connection:$connection);
$udao = new UsersDAO(connection:$connection);

$upd = $_section_permissions->checkPermission(UPD);
$del = $_section_permissions->checkPermission(DEL);
$ord = $_section_permissions->checkPermission(ORD);

$searcher_idBlock = isset($data['searcher']['idBlock'])? $data['searcher']['idBlock'] : null;
$dto = null;
if (!is_null($searcher_idBlock)){
    $dto = new BlockDTO;
    $dto->setId(id:$searcher_idBlock);
}
$blocks = $bdao->findAll(dto:$dto,page:ALL_PAGES);
$countBlocks = count($blocks);
foreach ($blocks as $block){
    $block = (fn($n):Block=>$n)($block);
    $idBlock = $block->getId();
    $blockname = $block->getName();
?>
    <table id="tbl-<?=$idBlock?>" class="sections-table">
        <thead>
            <tr>
                <th colspan="7" class="ta-center"><?=ucfirst($blockname)?></th>
            </tr>
            <tr>
                <th style="width:160px"><div class="btn btn-plus icon" onclick="newSection(<?=$idBlock?>)"></div></th>
                <th style="width:50px">#</th>
                <th style="width:50px">ID</th>
                <th class="ta-left" colspan="2">NOMBRE</th>
                <th class="ta-left">RUTA</th>
                <th style="width:50px"></th>
            </tr>
        </thead>
        <tbody>
        <?php

        $dto = new SectionDTO;
        $dto->setIdBlock(idBlock:$idBlock);
        $sections = $sdao->findAll(dto:$dto);
        $countSections = count($sections);
        if ($countSections==0){
            echo "<tr><td class='ta-center' colspan='7'>No se han encontrado secciones</td></tr>";
        }
        foreach($sections as $i=>$section){
            $section = (fn($m):Section=>$m)($section);
            $id = $section->getId();
            $name = ucfirst($section->getName());
            $path = $section->getPath();
            $position = $section->getOrder();
            $idUpdater = $section->getIdUpdater()??0;
            $updater = $udao->findById(id:$idUpdater);
            $updater = (fn($n):?User=>$n)($updater);
            $updater_name = !is_null($updater)? $updater->getUsername() : '';
            $date = ucfirst($section->getTimestamp()['dayname']['long']) . ", {$section->getTimestamp()['day']} de {$section->getTimestamp()['monthname']['long']} de {$section->getTimestamp()['year']}";
            $ondelete = ($del && ($_section_permissions->getBlock()->getId()!=$block->getId()))? "onclick='deleteSection($id)'" : null;
            $onupdate = $upd? "onclick='updateSection({$id})'" : null;
            $up = ORD_DOWN;
            $down = ORD_UP;
            $onorder_up = ($ord && $countBlocks>1 && $i>0)? "onclick='changePosition({$id},{$up})'" : null;
            $onorder_down = ($ord && $countSections && $i<($countSections-1))? "onclick='changePosition({$id},{$down})'" : null;
            $off_delete = (!$del || ($_section_permissions->getBlock()->getId()==$block->getId()))? 'off' : null;
            $off_update = !$upd? 'off' : null;
            $off_orderup = !($ord && $countSections>1 && $i>0)? 'off' : null;
            $off_orderdown = !($ord && $countSections && $i<($countSections-1))? 'off' : null;
            $audimg = URL_IMGS . "audit.svg";
            $icon = URL_IMGS . "{$section->getIcon()}";
            $icon_title = $section->getIcon();
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
                    <td style="width:48px"><img src="{$icon}" title="{$icon_title}" class="pointer"></td>
                    <td><span>{$name}</span></td>
                    <td><span>{$path}</span></td>
                    <td class="center no-select"><img class="pointer" src="{$audimg}" title="({$updater_name}) {$date}"></td>
                </tr>
            EOT;
        }
    ?>
    </tbody>
</table>
<?php } ?>