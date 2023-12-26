<?php
    if (!isset($_section_permissions))
        die;
    if (!isset($data['rolePermissions']))
        die;
    $role = $data['role'];
    $types = $data['types'];
    $section = $data['rolePermissions']->getSection();
?>

<table id="gpr-table">
    <thead>
        <tr>
            <th class="ta-left">ROL</th>
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
            <td data-role="<?=$role->getId()?>"><?=ucfirst($role->getName())?></td>
            <td data-section='<?=$section->getId()?>'><?=ucfirst($section->getName())?></td>
        <?php
            foreach($types as $type){
                $permission = $data['rolePermissions']->getPermissionByIdType($type->getId());
                $rp = $permission->getRolePermission();
                $pid = !is_null($rp)? $rp->getId() : '';
                $enabled = (!is_null($rp) && $rp->isEnabled())? 'checked' : null;
                echo <<<EOT
                    <td class="ta-center">
                        <label class="input-switch">
                            <input type="checkbox" data-type="simple-switch" value="1" style="display:none" {$enabled} data-ptype='{$type->getId()}' data-pid='{$pid}'>
                        </label>
                    </td>
                EOT;
            }
            
        ?>
        </tr>
    </tbody>
</table>