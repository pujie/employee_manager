<?php
echo $css;
echo $user->get_title();
echo humanize($user->get_user());
echo $this->lib_raw_menu->create_menu($user->get_navigator());
echo $this->menu->links($user->get_links());
