<?php
	$this->load->view('common/header');
?>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#activation_date').datepicker();
		$('#fb_date').datepicker();
	});
</script>
<div id="tabs">
<ul>
<li><a href="#contact">Contact</a></li>
<li><a href="#description">Description</a></li>
<li><a href="#service">Service</a></li>
</ul>
	<div id='contact'>
	<?php	
	$label	=	array('class'=>'tableless_label');
	echo form_open('clients/add_handler');
	echo form_label('Client Name','NAMA PELANGGAN',$label);
	$NAMA_PELANGGAN=array('name'=>'NAMA_PELANGGAN','id'=>'NAMA_PELANGGAN','class'=>'tableless_input');
	echo form_input($NAMA_PELANGGAN) . '<br>';
	echo form_label('Address','address',$label);
	$address=array('name'=>'address','id'=>'address','class'=>'tableless_input');
	echo form_input($address) . '<br>';
	echo form_label('Type of Business','business_field',$label);
	$option=array();
	$business_field	=	new Business_field;
	$business_field->get();
	foreach($business_field as $field){
		$option[$field->id]	=	$field->name;
	}
	echo form_dropdown('business',$option,'class="tableless_input"') . '<br>';
	echo form_label('Telp','telp',$label);
	$telp=array('name'=>'telp','id'=>'telp','class'=>'tableless_input');
	echo form_input($telp) . '<br>';
	echo form_label('Fax','fax',$label);
	$fax=array('name'=>'fax','id'=>'fax','class'=>'tableless_input');
	echo form_input($fax) . '<br>';
	echo form_label('Applicant Name','applicant',$label);
	$applicant=array('name'=>'applicant','id'=>'applicant','class'=>'tableless_input');
	echo form_input($applicant) . '<br>';
	echo form_label('Telp HP','TELP_HP',$label);
	$TELP_HP=array('name'=>'TELP_HP','id'=>'TELP_HP','class'=>'tableless_input');
	echo form_input($TELP_HP) . '<br>';
	echo form_label('HP','HP',$label);
	$HP=array('name'=>'HP','id'=>'HP','class'=>'tableless_input');
	echo form_input($HP) . '<br>';
	echo form_label('HP2','HP2',$label);
	$HP2=array('name'=>'HP2','id'=>'HP2','class'=>'tableless_input');
	echo form_input($HP2) . '<br>';

	echo form_label('Email','EMAIL',$label);
	$EMAIL=array('name'=>'EMAIL','id'=>'EMAIL','class'=>'tableless_input');
	echo form_input($EMAIL) . '<br>';
	
	?>
	</div><div id='description'>
	<?php
	echo form_label('Branch','branch_id',$label);
	$branch_id=array('name'=>'branch_id','id'=>'branch_id','class'=>'tableless_input');
	$branches=new Branch;
	$branches->get();
	$option=array();
	foreach($branches as $branch){
		$option[$branch->id]=$branch->name;
	}
	echo form_dropdown('branch_id',$option,1,'id="branch_id" name="branch_id" class="tableless_input"') . '<br>';
	echo form_label('Category','category_id',$label);
	$categories	=	new Category;
	$categories->get();
	$option=array();
	foreach($categories as $category){
		$option[$category->id]	=	$category->KATEGORI;
	}
	echo form_dropdown('category',$option,1,'id="category_id" name="category_id" class="tableless_input"') . '<br>';
	echo form_label('Service','service_id',$label);
	$service_id=array('name'=>'service_id','id'=>'service_id','class'=>'tableless_input');
	$services	=	new Service;
	$services->get();
	$option=array();
	foreach($services as $service){
		$option[$service->id]	=	$service->LAYANAN;
	}
	echo form_dropdown('service',$option,'id="category_id" name="category_id" class="tableless_input"') . '<br>';
	echo form_label('Other','LAINNYA',$label);
	$LAINNYA=array('name'=>'LAINNYA','id'=>'LAINNYA','class'=>'tableless_input');
	echo form_input($LAINNYA) . '<br>';

	echo form_label('SIUP','SIUP',$label);
	$SIUP=array('name'=>'SIUP','id'=>'SIUP','class'=>'tableless_input');
	echo form_input($SIUP) . '<br>';
	echo form_label('NPWP','NPWP',$label);
	$NPWP=array('name'=>'NPWP','id'=>'NPWP','class'=>'tableless_input');
	echo form_input($NPWP) . '<br>';
	echo form_label('Setup Fee','BIAYA_SETUP',$label);
	$BIAYA_SETUP=array('name'=>'BIAYA_SETUP','id'=>'BIAYA_SETUP','class'=>'tableless_input');
	echo form_input($BIAYA_SETUP) . '<br>';
	echo form_label('Monthly Fee','BIAYA_BERLANGGANAN_BULANAN',$label);
	$BIAYA_BERLANGGANAN_BULANAN=array('name'=>'BIAYA_BERLANGGANAN_BULANAN','id'=>'BIAYA_BERLANGGANAN_BULANAN','class'=>'tableless_input');
	echo form_input($BIAYA_BERLANGGANAN_BULANAN) . '<br>';

	echo form_label('Device Fee','BIAYA_PERANGKAT',$label);
	$BIAYA_PERANGKAT=array('name'=>'BIAYA_PERANGKAT','id'=>'BIAYA_PERANGKAT','class'=>'tableless_input');
	echo form_input('BIAYA_PERANGKAT') . '<br>';
	echo form_label('Other Fee','BIAYA_LAINNYA',$label);
	$BIAYA_LAINNYA=array('name'=>'BIAYA_LAINNYA','id'=>'BIAYA_LAINNYA','class'=>'tableless_input');
	echo form_input($BIAYA_LAINNYA) . '<br>';
	echo form_label('Service Desc','KETERANGAN_LAYANAN',$label);
	$KETERANGAN_LAYANAN=array('name'=>'KETERANGAN_LAYANAN','id'=>'KETERANGAN_LAYANAN','class'=>'tableless_input');
	echo form_input($KETERANGAN_LAYANAN) . '<br>';
	?>
</div><div id='service'>
<?php
	echo form_label('Form Number','NO_FB',$label);
	$NO_FB=array('name'=>'NO_FB','id'=>'NO_FB','class'=>'tableless_input');
	echo form_input($NO_FB) . '<br>';
	echo form_label('Form Date','fb_date',$label);
	$fb_date=array('name'=>'fb_date','id'=>'fb_date','class'=>'tableless_input');
	echo form_input($fb_date) . '<br>';
	echo form_label('Id Num','NO_ID',$label);
	$NO_ID=array('name'=>'NO_ID','id'=>'NO_ID','class'=>'tableless_input');
	echo form_input($NO_ID) . '<br>';

	echo form_label('Activation Date','activation_date',$label);
	$activation_date=array('name'=>'activation_date','id'=>'activation_date','class'=>'tableless_input');
	echo form_input($activation_date) . '<br>';
	echo form_label('Period','PERIODE_LANGGANAN',$label);
	$PERIODE_LANGGANAN=array('name'=>'PERIODE_LANGGANAN','id'=>'PERIODE_LANGGANAN','class'=>'tableless_input');
	echo form_input($PERIODE_LANGGANAN) . '<br>';
	echo form_label('Special Request','REQUEST_KHUSUS',$label);
	$REQUEST_KHUSUS=array('name'=>'REQUEST_KHUSUS','id'=>'REQUEST_KHUSUS','class'=>'tableless_input');
	echo form_input($REQUEST_KHUSUS) . '<br>';
	echo form_label('Account Manager','ACCOUNT_MANAGER',$label);
	$ACCOUNT_MANAGER=array('name'=>'ACCOUNT_MANAGER','id'=>'ACCOUNT_MANAGER','class'=>'tableless_input');
	echo form_input($ACCOUNT_MANAGER) . '<br>';
	echo form_label('Status','STATUS',$label);
	$STATUS=array('name'=>'STATUS','id'=>'STATUS','class'=>'tableless_input');
	echo form_input($STATUS) . '<br>';
	echo form_label('Tanggal','tanggal',$label);
	$tanggal=array('name'=>'tanggal','id'=>'tanggal','class'=>'tableless_input');
	echo form_input('tanggal') . '<br>';
	echo form_label('Client Code','KODE_PELANGGAN',$label);
	$KODE_PELANGGAN=array('name'=>'KODE_PELANGGAN','id'=>'KODE_PELANGGAN','class'=>'tableless_input');
	echo form_input($KODE_PELANGGAN) . '<br>';
	echo form_submit('Save','save');
	?>
	</div></div>
	<?php
	$this->lib_table_manager->create_table($this->user_data->get_navigator());
	$this->load->view('common/footer');
?>
