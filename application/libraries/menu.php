<?php
class Menu{
    public function show_menu(){
        $obj =& get_instance();
        $obj->load->helper('url');
        $menu = anchor("startgame/hello/John","Say hello to John |");
        $menu .= anchor("startgame/hello/Mike"," Say hello to Mike |");
        $menu .= anchor("startgame/hello/Raj"," Say hello to Raj");
        return $menu;
    }

}


?>
