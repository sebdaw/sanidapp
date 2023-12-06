<?php
class Breadcrumb {
    public static function display(array $breadcrumbs=[]) : string {
        $list = [];
        foreach($breadcrumbs as $b){
            $name = ucfirst($b['name']);
            $link = $b['link']!=''? $b['link'] : null;
            $nolink = is_null($link)? 'nolink' : null;
            $list[] = "<p><a href='{$link}' class='{$nolink}'>{$name}</a></p>";
        }
        $img = URL_IMGS . 'padlock.png';
        return "<article id='breadcrumb'><img src='{$img}'><span>&nbsp;</span>" . implode('<span>&nbsp;&#8680;&nbsp;</span>',$list) . "</article>";
    }
}
?>