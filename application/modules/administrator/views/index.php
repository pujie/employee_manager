<?php
$this->load->view('common/header');
echo $user->get_title();
echo 'Hello .. ' . humanize($user->get_user());
echo $this->lib_raw_menu->create_menu($user->get_navigator());
// echo $this->menu->links($user->get_links());
$this->load->view('common/footer');
