<?php
echo $this->config->item('css');
echo $menu;
echo $title;
echo form_open('app_modules/edit_handler');
echo 'Id' . form_hidden('id',$module->id);
echo 'Name' . form_input('name',$module->name);
echo 'URL' . form_input('url',$module->url);
echo form_submit('save','Save');
echo form_close();