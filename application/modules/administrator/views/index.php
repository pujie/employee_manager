<?php
$header_data=array('username'=>humanize($user->get_user()));
$this->load->view('common/header',$header_data);
echo $user->get_title();
$footerdata=array('navigator'=>$user->get_navigator());
$this->load->view('common/footer',$footerdata);
