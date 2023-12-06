<aside id="side-nav">
    <ul class="snb">
        <?php
            $requestURI = $_SERVER['REQUEST_URI'];
            $urlpath = str_replace("/sanidapp/",'',$requestURI);

            $conn = new DBConnection();
            $pctrl = new PermissionController(connection:$conn);
            $bdao = new BlocksDAO(connection:$conn);
            $sdao = new SectionDAO(connection:$conn);
            $blocks = $bdao->findAll(dto:null,page:ALL_PAGES);
            $user = $_SESSION[USER_SESSION];
            foreach($blocks as $block){
                if (!$pctrl->hasAccessToBlock(idUser:$user->getId(),idBlock:$block->getId())) continue;
                $block = (fn($n):Block=>$n)($block);
                $idBlock = $block->getId();
                $bname = ucfirst($block->getName());
                $dto = new SectionDTO;
                $dto->setIdBlock(idBlock:$idBlock);
                $display = $urlpath=='home'? 'none' : 'flex';
                echo "<li id='b-{$idBlock}' class='side-nav-blocks'><span class='b-arrow'>&#9654;</span>{$bname}</li>";
                echo "<ul id='snbs-{$idBlock}' class='sns' style='display:{$display}'>";
                $sections = $sdao->findAll(dto:$dto,page:ALL_PAGES);
                foreach($sections as $section){
                    $section = (fn($n):Section=>$n)($section);
                    if (!$pctrl->hasPermission(idUser:$user->getId(),idSection:$section->getId(),idType:ACC)) continue;
                    $idSection = $section->getId();
                    $img = URL_IMGS . $section->getIcon();
                    $url = $section->getPath();
                    $sname = ucfirst($section->getName());
                    $csname = !is_null($_section_permissions)? $_section_permissions->getSection()->getName() : null;
                    $selected = strcasecmp($sname,$csname)==0? 'selected' : null;
                    echo <<<EOT
                        <li id="s-{$idSection}" class="side-nav-sections {$selected}" style="display:{$display};"><a href="{$url}"><img src="{$img}"><p>{$sname}</p></a></li>
                    EOT;
                }
                echo "</ul>";
            }
            $conn->disconnect();
        ?>
    </ul>
</aside>
<script>
    $(document).ready(function(){
        $(`.side-nav-blocks`).on('click',function(){
            let id = $(this).attr('id').split('-')[1];
            let arrow = $(this).find(`.b-arrow`);
            let sections = $(`#snbs-${id}`);
            if ($(sections).is(':visible')){
                $(sections).slideUp();
                $(sections).find(`.side-nav-sections`).fadeOut();
                $(arrow).removeClass('open');
            }else{
                $(sections).slideDown(100,function(){
                    $(sections).css('display','flex');
                    $(sections).find(`.side-nav-sections`).each(function(index){
                        $(this).fadeIn((index * 100));
                    });
                });

                $(arrow).addClass('open');
            }
        });
    });
</script>