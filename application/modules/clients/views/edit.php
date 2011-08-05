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
<input type='text' name='id' value='<?php echo $client->id?>' class='tableless_input' ></br>
<label for='NAMA_PELANGGAN' class='tableless_label'>Client Name</label>
<input type='text' name='NAMA_PELANGGAN' value='<?php echo $client->NAMA_PELANGGAN?>' class='tableless_input' ></br>
<label for='ALAMAT' class='tableless_label'>Adress</label>
<input type='text' name='ALAMAT' value='<?php echo $client->ALAMAT?>' class='tableless_input' ></br>

<label for='TELP' class='tableless_label'>Telp</label>
<input type='text' name='TELP' value='<?php echo $client->TELP?>' class='tableless_input' ></br>

<label for='FAX' class='tableless_label'>Fax</label>
<input type='text' name='FAX' value='<?php echo $client->FAX?>' class='tableless_input' ></br>

<label for='NAMA_PEMOHON' class='tableless_label'>Applicant</label>
<input type='text' name='NAMA_PEMOHON' value='<?php echo $client->NAMA_PEMOHON?>' class='tableless_input' ></br>

<label for='NO_FB' class='tableless_label'>FB</label>
<input type='text' name='NO_FB' value='<?php echo $client->NO_FB?>' class='tableless_input' ></br>

<label for='TGL_FB' class='tableless_label'>FB Date</label>
<input type='text' name='TGL_FB' value='<?php echo $client->TGL_FB?>' class='tableless_input' ></br>

<label for='NO_ID' class='tableless_label'>ID Num</label>
<input type='text' name='NO_ID' value='<?php echo $client->NO_ID?>' class='tableless_input' ></br>

<label for='TELP_HP' class='tableless_label'>Telp HP</label>
<input type='text' name='TELP_HP' value='<?php echo $client->TELP_HP?>' class='tableless_input' ></br>

<label for='HP' class='tableless_label'>HP</label>
<input type='text' name='HP' value='<?php echo $client->HP?>' class='tableless_input' ></br>

<label for='HP2' class='tableless_label'>HP2</label>
<input type='text' name='HP2' value='<?php echo $client->HP2?>' class='tableless_input' ></br>

<label for='EMAIL' class='tableless_label'>Email</label>
<input type='text' name='EMAIL' value='<?php echo $client->EMAIL?>' class='tableless_input' ></br>


</div>
<div id="description">
<label for='branch_id' class='tableless_label'>Branch</label>
<input type='text' name='branch_id' value='<?php echo $client->branch_id?>' class='tableless_input' ></br>
<label for='category_id' class='tableless_label'>Category</label>
<input type='text' name='category_id' value='<?php echo $client->category_id?>' class='tableless_input' ></br>

<label for='service_id' class='tableless_label'>Service</label>
<input type='text' name='service_id' value='<?php echo $client->service_id?>' class='tableless_input' ></br>

<label for='LAINNYA' class='tableless_label'>Other</label>
<input type='text' name='LAINNYA' value='<?php echo $client->LAINNYA?>' class='tableless_input' ></br>


<label for='JENIS_USAHA' class='tableless_label'>Business Type</label>
<input type='text' name='JENIS_USAHA' value='<?php echo $client->JENIS_USAHA?>' class='tableless_input' ></br>

<label for='SIUP' class='tableless_label'>SIUP</label>
<input type='text' name='SIUP' value='<?php echo $client->SIUP?>' class='tableless_input' ></br>

<label for='NPWP' class='tableless_label'>NPWP</label>
<input type='text' name='NPWP' value='<?php echo $client->NPWP?>' class='tableless_input' ></br>

<label for='BIAYA_SETUP' class='tableless_label'>Setup Fee</label>
<input type='text' name='BIAYA_SETUP' value='<?php echo $client->BIAYA_SETUP?>' class='tableless_input' ></br>

<label for='BIAYA_BERLANGGANAN_BULANAN' class='tableless_label'>Monthly Fee</label>
<input type='text' name='BIAYA_BERLANGGANAN_BULANAN' value='<?php echo $client->BIAYA_BERLANGGANAN_BULANAN?>' class='tableless_input' ></br>

<label for='BIAYA_PERANGKAT' class='tableless_label'>Hardware Fee</label>
<input type='text' name='BIAYA_PERANGKAT' value='<?php echo $client->BIAYA_PERANGKAT?>' class='tableless_input' ></br>

<label for='BIAYA_LAINNYA' class='tableless_label'>Other Fee</label>
<input type='text' name='BIAYA_LAINNYA' value='<?php echo $client->BIAYA_LAINNYA?>' class='tableless_input' ></br>


</div><div id='service'>

<label for='KODE_PELANGGAN' class='tableless_label'>Client Code</label>
<input type='text' name='KODE_PELANGGAN' value='<?php echo $client->KODE_PELANGGAN?>' class='tableless_input' ></br>
<label for='KETERANGAN_LAYANAN' class='tableless_label'>Service Desc</label>
<input type='text' name='KETERANGAN_LAYANAN' value='<?php echo $client->KETERANGAN_LAYANAN?>' class='tableless_input' ></br>

<label for='TGL_AKTIFASI' class='tableless_label'>Activation Date</label>
<input type='text' name='TGL_AKTIFASI' value='<?php echo $client->TGL_AKTIFASI?>' class='tableless_input' ></br>

<label for='PERIODE_LANGGANAN' class='tableless_label'>Date Period</label>
<input type='text' name='PERIODE_LANGGANAN' value='<?php echo $client->PERIODE_LANGGANAN?>' class='tableless_input' ></br>

<label for='REQUEST_KHUSUS' class='tableless_label'>Special Request</label>
<input type='text' name='REQUEST_KHUSUS' value='<?php echo $client->REQUEST_KHUSUS?>' class='tableless_input' ></br>

<label for='ACCOUNT_MANAGER' class='tableless_label'>Account Manager</label>
<input type='text' name='ACCOUNT_MANAGER' value='<?php echo $client->ACCOUNT_MANAGER?>' class='tableless_input' ></br>

<label for='STATUS' class='tableless_label'>Status</label>
<input type='text' name='STATUS' value='<?php echo $client->STATUS?>' class='tableless_input' ></br>

<label for='tanggal' class='tableless_label'>Date</label>
<input type='text' name='tanggal' value='<?php echo $client->tanggal?>' class='tableless_input' ></br>

</div>	
<?php echo form_submit('save','Save');?>
<?php echo form_close();?>
</div>
<?php $this->lib_table_manager->create_table($user->get_navigator()) ?>
</body>