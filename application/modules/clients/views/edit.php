<?php $this->load->view('common/header'); ?>
<?php echo $user->get_title();?>
<?php echo $user->get_pagetitle();?>
<body style='font-size:10px'>
<div id="tabs">
<ul>
<li><a href="#contact">Contact</a></li>
<li><a href="#description">Description</a></li>
<li><a href="#service">Service</a></li>
</ul>
<?php echo form_open('clients/edit_handler' );?>
<div id="contact">
<?php echo form_hidden('last_url',$last_url);?>
<label for='id' class='tableless_label'>id</label>
<input type='text' name='id' value='<?php echo $client->id?>' class='tableless_input' ><br>
<label for='name' class='tableless_label'>Client Name</label>
<input type='text' name='name' value='<?php echo $client->name?>' class='tableless_input' ><br>
<label for='address' class='tableless_label'>Adress</label>
<input type='text' name='address' value='<?php echo $client->address?>' class='tableless_input' ><br>

<label for='telp' class='tableless_label'>Telp</label>
<input type='text' name='telp' value='<?php echo $client->telp?>' class='tableless_input' ><br>

<label for='fax' class='tableless_label'>Fax</label>
<input type='text' name='fax' value='<?php echo $client->fax?>' class='tableless_input' ><br>

<label for='applicant' class='tableless_label'>Applicant</label>
<input type='text' name='applicant' value='<?php echo $client->applicant?>' class='tableless_input' ><br>

<label for='NO_FB' class='tableless_label'>FB</label>
<input type='text' name='NO_FB' value='<?php echo $client->no_fb?>' class='tableless_input' ><br>

<label for='fb_date' class='tableless_label'>FB Date</label>
<input type='text' name='fb_date' value='<?php echo $client->fb_date?>' class='tableless_input' ><br>

<label for='NO_ID' class='tableless_label'>ID Num</label>
<input type='text' name='NO_ID' value='<?php echo $client->no_id?>' class='tableless_input' ><br>

<label for='TELP_HP' class='tableless_label'>Telp HP</label>
<input type='text' name='TELP_HP' value='<?php echo $client->telp_hp?>' class='tableless_input' ><br>

<label for='HP' class='tableless_label'>HP</label>
<input type='text' name='HP' value='<?php echo $client->hp?>' class='tableless_input' ><br>

<label for='HP2' class='tableless_label'>HP2</label>
<input type='text' name='HP2' value='<?php echo $client->hp2?>' class='tableless_input' ><br>

<label for='email' class='tableless_label'>Email</label>
<input type='text' name='email' value='<?php echo $client->email?>' class='tableless_input' ><br>


</div>
<div id="description">
<label for='branches' class='tableless_label'>Branch</label>
<?php 
$branches=new Branch;
$branches->get();
$attr='class="tableless_input",name="branches"';
$branches_array=array();
foreach($branches as $branch){
$branches_array[$branch->id]=$branch->name;
}
echo form_dropdown('branches',$branches_array,$client->branch_id,$attr);
echo '<br>';
?>
<label for='category_id' class='tableless_label'>Category</label>
<input type='text' name='category_id' value='<?php echo $client->category_id?>' class='tableless_input' ><br>

<label for='service_id' class='tableless_label'>Service</label>
<input type='text' name='service_id' value='<?php echo $client->service_id?>' class='tableless_input' ><br>

<label for='lainnya' class='tableless_label'>Other</label>
<input type='text' name='lainnya' value='<?php echo $client->lainnya?>' class='tableless_input' ><br>



<label for='JENIS_USAHA' class='tableless_label'>Business Type</label>
<?php
$option=array();
$business_fields=new Business_field;
$business_fields->get();
foreach($business_fields as $field){
	$option[$field->id]	=	$field->name;
}
echo form_dropdown('business',$option,$client->business_field_id) . '<br>';
?>


<label for='SIUP' class='tableless_label'>SIUP</label>
<input type='text' name='SIUP' value='<?php echo $client->siup?>' class='tableless_input' ><br>

<label for='NPWP' class='tableless_label'>NPWP</label>
<input type='text' name='NPWP' value='<?php echo $client->npwp?>' class='tableless_input' ><br>

<label for='setup_fee' class='tableless_label'>Setup Fee</label>
<input type='text' name='setup_fee' value='<?php echo $client->setup_fee?>' class='tableless_input' ><br>

<label for='monthly_subscription_fee' class='tableless_label'>Monthly Fee</label>
<input type='text' name='monthly_subscription_fee' value='<?php echo $client->monthly_subscription_fee?>' class='tableless_input' ><br>

<label for='device_fee' class='tableless_label'>Hardware Fee</label>
<input type='text' name='device_fee' value='<?php echo $client->device_fee?>' class='tableless_input' ><br>

<label for='other_fee' class='tableless_label'>Other Fee</label>
<input type='text' name='other_fee' value='<?php echo $client->other_fee?>' class='tableless_input' ><br>


</div><div id='service'>

<label for='kode_pelanggan' class='tableless_label'>Client Code</label>
<input type='text' name='kode_pelanggan' value='<?php echo $client->kode_pelanggan?>' class='tableless_input' ><br>
<label for='service_information' class='tableless_label'>Service Desc</label>
<input type='text' name='service_information' value='<?php echo $client->service_information?>' class='tableless_input' ><br>

<label for='activation_date' class='tableless_label'>Activation Date</label>
<input type='text' name='activation_date' value='<?php echo $client->activation_date?>' class='tableless_input' ><br>

<label for='subscription_period' class='tableless_label'>Date Period</label>
<input type='text' name='subscription_period' value='<?php echo $client->subscription_period?>' class='tableless_input' ><br>

<label for='special_request' class='tableless_label'>Special Request</label>
<input type='text' name='special_request' value='<?php echo $client->special_request?>' class='tableless_input' ><br>

<label for='account_manager' class='tableless_label'>Account Manager</label>
<input type='text' name='account_manager' value='<?php echo $client->account_manager?>' class='tableless_input' ><br>

<label for='status' class='tableless_label'>status</label>
<input type='text' name='status' value='<?php echo $client->status?>' class='tableless_input' ><br>

<label for='tanggal' class='tableless_label'>Date</label>
<input type='text' name='tanggal' value='<?php echo $client->tanggal?>' class='tableless_input' ><br>

</div>	
<?php echo form_submit('save','Save');?>
<?php echo form_close();?>
</div>
<?php $this->lib_table_manager->create_table($user->get_navigator()) ?>
</body>
