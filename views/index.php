<?php
echo $css;
echo $menu;
echo $title;
echo 'You are member of ' . $this->data['branch'] . ' branch<br>';
echo 'You can access ' . $this->data['modules'] . ' module(s)<br>';

echo $this->menu->navigator($this->data['navigator']);
// $list=$this->list_modules();
echo $this->config->item('logout_link');
