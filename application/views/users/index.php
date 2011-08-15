<?php
	$this->load->view('common/header');
	?>
	<script type='text/javascript'>
	$(document).ready(function(){
		$('.button').button();
	});
	</script>
	<?php
	echo $user->get_pagetitle();
	echo $user->get_title();
	echo 'User count: ' . $users->get_user_count();
	$head=array('Id','Name','Email','Edit','Delete','Modules','Branch');
	$this->lib_table->set_alignment(3,'center');
	$this->lib_table->set_alignment(4,'center');
	$this->lib_table->set_alignment(5,'center');
	$this->lib_table->set_alignment(6,'center');
	echo $this->lib_table->set_table('client',$head,$list);
	$this->pagination->initialize($pagination);
	echo 'Goto Page ' . $this->pagination->create_links();
	$this->lib_table_manager->create_table($user->get_navigator());
	$this->load->view('common/footer');
