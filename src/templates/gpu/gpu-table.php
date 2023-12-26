<?php
    if (!isset($_section_permissions))
        die;
    if (!isset($data['userPermissions']))
        die;
    $user = $data['user'];
    $types = $data['types'];
    $section = $data['userPermissions']->getSection();
?>

<table id="gpu-table">
    <thead>
        <tr>
            <th class="ta-left">USUARIO</th>
            <th class="ta-left">SECCIÓN</th>
            <?php
                foreach($types as $type){
                    echo <<<EOT
                    <th class="ta-center" style="width:80px" data-id="{$type->getId()}">{$type->getName()}</th>
                    EOT;
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td data-current-user="<?=$user->getId()?>"><?=$user->getUsername()?></td>
            <td data-current-section='<?=$section->getId()?>'><?=ucfirst($section->getName())?></td>
        <?php
            foreach($types as $type){
                $permission = $data['userPermissions']->getPermissionByIdType($type->getId());
                $rp = $permission->getRolePermission();
                $rp_granted = (!is_null($rp) && $rp->isEnabled());
                $up = $permission->getUserPermission();
                $pid = !is_null($up)? $up->getId() : '';
                $baseurl = URL_IMGS;
                $url_inherit = $rp_granted? "{$baseurl}inherit_yes.svg" : "{$baseurl}inherit_no.svg";
                $title_inherit = $rp_granted? 'Permiso concedido (rol)' : 'Permiso denegado (rol)';
                if (is_null($up) || is_null($up->isEnabled())){
                    $display_inherit = 'block';
                    $display_yes = 'none';
                    $display_no = 'none';
                    $selected = 3;
                }else if ($up->isEnabled()){
                    $display_inherit = 'none';
                    $display_yes = 'block';
                    $display_no = 'none';
                    $selected = 1;
                }else{
                    $display_inherit = 'none';
                    $display_yes = 'none';
                    $display_no = 'block';
                    $selected = 2;
                }
                echo <<<EOT
                    <td class="ta-center">
                        <div id="p_{$section->getId()}_{$user->getId()}_{$type->getId()}" style="display:flex;justify-content:center;align-items:center;" 
                            data-section="{$section->getId()}" 
                            data-user="{$user->getId()}" 
                            data-type="{$type->getId()}"
                            data-pid="{$pid}" 
                            data-selected="{$selected}" onclick="changePermission(event)">
                            <img class="no-select" data-tp="1" style="display:{$display_yes}" src="{$baseurl}check-solid.svg" title="Permiso concedido">
                            <img class="no-select" data-tp="2" style="display:{$display_no}" src="{$baseurl}xmark-solid.svg" title="Permiso denegado">
                            <img class="no-select" data-tp="3" style="display:{$display_inherit}" src="{$url_inherit}" title="{$title_inherit}">
                        </div>
                    </td>
                EOT;
            }
            
        ?>
        </tr>
    </tbody>
</table>