<?php
$header_data=array('username'=>$user_data->get_user());
$this->load->view('common/header',$header_data);
echo $this->lib_table->set_table('contacts',array('Nama','Perusahaan','Telp','HP','HP2','Alamat','Email','Tipe'),$list);
echo $this->pagination->create_links();

$footer_data=array('navigator'=>array(array(anchor('/','Home','class="button"'))));
$this->load->view('common/footer',$footer_data);