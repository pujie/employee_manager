<?php $this->load->view('common/header'); ?>
<div id="tabs">
<ul>
<li><a href="#contact">Contact</a></li>
<li><a href="#description">Description</a></li>
</ul>
<?php echo form_open('clients/edit_handler');?>
<div id="contact">
<input type="hidden" id="id" name="id" value="<?php echo $client->id;?>" class='tableless_input' /><br />

<label for="kode_pelanggan" class='tableless_label'>Client Code</label>
<input type="text" name="kode_pelanggan" value="<?php echo $client->KODE_PELANGGAN;?>" class='tableless_input' /><br />

<div class="wide">
<label for="NAMA_PELANGGAN" class='tableless_label'>Name</label>
<input type="text" name="NAMA_PELANGGAN" value="<?php echo $client->NAMA_PELANGGAN;?>" class='tableless_input' /><br />
</div>

<div class="wide">
<label for="applicant" class='tableless_label'>Applicant</label>
<input type="text" name="applicant" value="<?php echo $client->NAMA_PEMOHON;?>" class='tableless_input' /><br />
</div>

<label for="LAINNYA" class='tableless_label'>Other</label>
<input type="text" name="LAINNYA" value="<?php echo $client->LAINNYA;?>" class='tableless_input' /><br />

<div class="extra_wide">
<label for="address" class='tableless_label'>Address</label>
<input type="text" name="address" value="<?php echo $client->ALAMAT;?>" class='tableless_input' /><br />
</div>

<label for="telp" class='tableless_label'>Telp</label>
<input type="text" name="telp" value="<?php echo $client->TELP;?>" class='tableless_input' /><br />
<label for="fax" class='tableless_label'>Fax</label>
<input type="text" name="fax" value="<?php echo $client->FAX;?>" class='tableless_input' /><br />

<div class="semi_wide">
<label for="telp_hp" class='tableless_label'>Telp HP</label>
<input type="text" name="telp_hp" value="<?php echo $client->TELP_HP;?>" class='tableless_input' /><br />
</div>

<label for="hp" class='tableless_label'>HP</label>
<input type="text" name="hp" value="<?php echo $client->HP;?>" class='tableless_input' /><br />
<label for="hp2" class='tableless_label'>HP(2)</label>
<input type="text" name="hp2" value="<?php echo $client->HP2;?>" class='tableless_input' /><br />

<div class="wide">
<label for="email" class='tableless_label'>Email</label>
<input type="text" name="email" value="<?php echo $client->EMAIL;?>" class='tableless_input' /><br />
</div>

</div>
<div id="description">
<label for="jenis_usaha" class='tableless_label'>Business Type</label>
<input type="text" name="jenis_usaha" value="<?php echo $client->JENIS_USAHA;?>" class='tableless_input' /><br />
<label for="npwp" class='tableless_label'>NPWP</label>
<input type="text" name="npwp" value="<?php echo $client->NPWP;?>" class='tableless_input' /><br />
<label for="siupp" class='tableless_label'>SIUPP</label>
<input type="text" name="siupp" value="<?php echo $client->SIUPP;?>" class='tableless_input' /><br />
<label for="no_fb" class='tableless_label'>No. FB</label>
<input type="text" name="no_fb" value="<?php echo $client->NO_FB;?>" class='tableless_input' /><br />
<label for="tgl_fb" class='tableless_label'>Tgl. FB</label>
<input type="text" name="tgl_fb" value="<?php echo $client->TGL_FB;?>" class='tableless_input' /><br />

<label for="client_id" class='tableless_label'>Client ID</label>
<input type="text" name="client_id" value="<?php echo $client->CLIENT_ID;?>" class='tableless_input' /><br />

</div>	
<?php echo form_submit('save','Save');?>
<?php echo form_close();?>
</div>	
