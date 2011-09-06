<?php 
$this->load->view('common/header');
$this->load->view('common/common');
?>
<script type='text/javascript'>
$(document).ready(function(){
	$('#branch').combobox();
	$('#category').combobox();
	$('#service').combobox();
	$('#tglfb').datepicker({dateFormat:'yy-mm-d',changeYear:true,changeMonth:true,minDate:'-10Y',maxDate:'+10Y'});
	$('#tglaktivasi').datepicker({dateFormat:'yy-mm-d',changeYear:true,changeMonth:true,minDate:'-10Y',maxDate:'+10Y'});
	$('#periodelangganan').datepicker({dateFormat:'yy-mm-d',changeYear:true,changeMonth:true,minDate:'-10Y',maxDate:'+10Y'});
	$('#business_fields').combobox();
	$('#save').button();
	$('#backbutton').button();
});
</script>
<?php 
	switch($this->uri->segment(3)){
		case 'index':
			$page=$this->uri->segment(6);
			$id=$this->uri->segment(7);
			$back_url=base_url() . '/index.php/clients/index/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' .  $page;
			break;
		case 'cari':
			$page=$this->uri->segment(7);
			$id=$this->uri->segment(8);
			$back_url=base_url() . '/index.php/clients/cari/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7);
			break;
	}
	$client=new Client;
	$client->where('id',$id)->get();
	echo $client->name . ', ' . $client->address;
?>
<div class="demo">
	<div class="ui-widget">
	<?php
	$attr=array('class'=>'tableless_label');
	echo form_open('clients/edit_handler');
//	echo $client->name;
	?>
	<?php echo form_hidden('id',$id);?>
	<?php echo form_hidden('page',$page);?>
	<div id="tabs">
	<ul>
	<li><a href="#kategori">Kategori</a></li>
	<li><a href="#detail">Detail</a></li>
	<li><a href="#dataperusahaan">Data Perusahaan</a></li>
	<li><a href="#datapemohon">Data Pemohon</a></li>
	<li><a href="#dataadministrasi">Data Administrasi</a></li>
	<li><a href="#datasetup">Data Setup Teknis</a></li>
	<li><a href="#datatagihan">Data Tagihan</a></li>
	<li><a href="#datasupportteknis">Data Support Teknis</a></li>
	<li><a href="#biayaberlangganan">Data Biaya Berlangganan</a></li>
	<li><a href="#aktivasi">Aktivasi</a></li>
	</ul>
	<div id='kategori'>
	<?php echo form_label('Wilayah','branch',$attr)?>
	<?php 
	$branch_list=array();
	foreach($branches as $branch){
	$branch_list[$branch->id]=$branch->name;
	}
	echo form_dropdown('branch',$branch_list, $client->branch_id,'id="branch"');
	?><br>
	<?php echo form_label('Kategori Perusahaan','category',$attr)?>
	<?php 
	$kategorilist=array();
	foreach($categories as $category){
		$kategorilist[$category->id]=$category->name;
	}
	echo form_dropdown('category',$kategorilist, $client->category_id,'id="category"')
	?><br>	
	<?php echo form_label('Jenis Layanan','service',$attr)?>
	<?php 
		$servicelist=array();
		foreach($services as $service){
		$servicelist[$service->id]=$service->name;
		}
		echo form_dropdown('service',$servicelist, $client->service_id,'id="service"');
	?>
	</div>
	<div id='detail'>
	<?php $nofb=array('name'=>'nofb',	'id'=>'nofb', 'value'=>$client->no_fb,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left');	?> 
	<?php echo form_label('No. FB','nofb',$attr)?>
	<?php echo form_input($nofb);?><br>
	<?php $tglfb=array('name'=>'tglfb','id'=>'tglfb', 'value'=>$client->fb_date,	'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left');?> 
	<?php echo form_label('Tgl FB','tglfb',$attr)?>
	<?php echo form_input($tglfb);?><br>
	<?php $tglaktivasi=array('name'=>'tglaktivasi','id'=>'tglaktivasi','value'=>$client->activation_date,	'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left');?> 
	<?php echo form_label('Tgl Aktivasi','tglaktivasi',$attr)?>
	<?php echo form_input($tglaktivasi);?><br>
	<?php $periodelangganan=array('name'=>'periodelangganan','id'=>'periodelangganan','value'=>$client->subscription_period,	'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left ');?> 
	<?php echo form_label('Periode Langganan','periodelangganan',$attr)?>
	<?php echo form_input($periodelangganan);?><br>
	<?php echo form_label('Request Khusus','requestkhusus',$attr)?>
	<textarea rows="" cols="" id='keteranganlayanan' class='ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_description'></textarea><br>
	<?php echo form_label('Account Manager','accountmanager',$attr)?>
	<?php 
		$salesarray=array();
		foreach($sales as $sales){
		$salesarray[$sales->id]=$sales->user->username;
		}
		echo form_dropdown('accountmanager',$salesarray,$client->sales_id);
	?>
	</div>
	<div id='dataperusahaan'>
		<?php echo form_label('Nama Perusahaan/Pelanggan','company',$attr);	?>
		<?php $company=array('id'=>'company','name'=>'company','value'=>$client->name,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left tableless_input input_person_name');	?>
		<?php echo form_input($company);?><br>
		<?php echo form_label('Jenis Usaha','business_fields',$attr);?>
		<?php 
		$bfields=array();
		foreach ($business_fields as $bfield){
		$bfields[$bfield->id]=$bfield->name;
		}
		echo form_dropdown('business_fields',$bfields,$bfield->id,'id="business_fields"');
		?><br>
		<?php echo form_label('SIUP','siupp',$attr);?>
		<?php $siupp=array('id'=>'siupp','name'=>'siupp','value'=>$client->siup,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_short');?>
		<?php echo form_input($siupp);?><br>
		<?php echo form_label('NPWP','npwp',$attr);?>
		<?php $npwp=array('id'=>'npwp','name'=>'npwp','value'=>$client->npwp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left tableless_input input_short');?>
		<?php echo form_input($npwp);?><br>
		<?php echo form_label('Alamat','alamt',$attr);?>
		<?php $alamat=array('id'=>'alamat','name'=>'alamat','value'=>$client->address,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_address');?>
		<?php echo form_input($alamat);?><br>
		<?php echo form_label('Telepon','telepon',$attr);?>
		<?php $telepon=array('id'=>'telepon','name'=>'telepon','value'=>$client->telp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left tableless_input input_telp');?>
		<?php echo form_input($telepon);?><br>
		<?php echo form_label('Fax','fax',$attr);?>
		<?php $fax=array('id'=>'fax','name'=>'fax','value'=>$client->fax,'class'=>'tableless_input ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($fax);?><br>
	</div><!-- dataperusahaan -->
	<div id='datapemohon'>
		<?php $contact=$client->contact->where('tipe','pemohon')->get();?>
		<?php echo form_label('Nama','pemohonname',$attr);?>
		<?php $pemohonname=array('id'=>'pemohonname','name'=>'pemohonname','value'=>$client->applicant,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_person_name');?>
		<?php echo form_input($pemohonname);?><br>
		<?php echo form_label('KTP','ktppemohon',$attr)?>
		<?php $ktppemohon=array('id'=>'ktppemohon','name'=>'ktppemohon','value'=>$client->no_id,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_ktp');?>
		<?php echo form_input($ktppemohon);?><br>
		<?php echo form_label('Telepon','telppemohon',$attr)?>
		<?php $telppemohon=array('id'=>'telppemohon','name'=>'telppemohon','value'=>$client->telp_hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($telppemohon);?><br>
		<?php echo form_label('HP','hppemohon',$attr)?>
		<?php $hppemohon=array('id'=>'hppemohon','name'=>'hppemohon','value'=>$client->hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hppemohon);?><br>
		<?php echo form_label('HP 2','hp2pemohon',$attr)?>
		<?php $hp2pemohon=array('id'=>'hp2pemohon','name'=>'hp2pemohon','value'=>$client->hp2,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hp2pemohon);?><br>
		<?php echo form_error('emailpemohon');?>
		<?php echo form_label('Email','emailpemohon',$attr)?>
		<?php $emailpemohon=array('id'=>'emailpemohon','name'=>'emailpemohon','value'=>$client->email,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_email');?>
		<?php echo form_input($emailpemohon);?><br>
	</div>
	<div id='dataadministrasi'>
		<?php $administrasi=$client->contact->where('tipe','administrasi')->get();?>
		<?php echo form_label('Nama','administrasiname',$attr)?>
		<?php $administrasiname=array('id'=>'administrasiname','name'=>'administrasiname','value'=>$administrasi->name,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left tableless_input input_person_name');?>
		<?php echo form_input($administrasiname);?><br>
		<?php echo form_label('KTP','ktpadministrasi',$attr)?>
		<?php $ktpadministrasi=array('id'=>'ktpadministrasi','name'=>'ktpadministrasi','value'=>$contact->ktp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_ktp');?>
		<?php echo form_input($ktpadministrasi);?><br>
		<?php echo form_label('Telepon','telpadministrasi',$attr)?>
		<?php $telpadministrasi=array('id'=>'telpadministrasi','name'=>'telpadministrasi','value'=>$contact->telp_hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($telpadministrasi);?><br>
		<?php echo form_label('HP','hpadministrasi',$attr)?>
		<?php $hpadministrasi=array('id'=>'hpadministrasi','name'=>'hpadministrasi','value'=>$contact->hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hpadministrasi);?><br>
		<?php echo form_label('HP 2','hp2administrasi',$attr)?>
		<?php $hp2administrasi=array('id'=>'hp2administrasi','name'=>'hp2administrasi','value'=>$contact->hp2,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hp2administrasi);?><br>
		<?php echo form_label('Email','emailadministrasi',$attr)?>
		<?php $emailadministrasi=array('id'=>'emailadministrasi','name'=>'emailadministrasi','value'=>$contact->email,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_email');?>
		<?php echo form_input($emailadministrasi);?><br>
	</div>
	<div id='datasetup'>
		<?php $setup=$client->contact->where('tipe','teknis')->get();?>
		<?php echo form_label('Nama','setupname',$attr)?>
		<?php $setupname=array('id'=>'setupname','name'=>'setupname','value'=>$setup->name,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_person_name');?>
		<?php echo form_input($setupname);?><br>
		<?php echo form_label('KTP','ktpsetup',$attr)?>
		<?php $ktpsetup=array('id'=>'ktpsetup','name'=>'ktpsetup','value'=>$setup->ktp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_ktp');?>
		<?php echo form_input($ktpsetup);?><br>
		<?php echo form_label('Telepon','telpsetup',$attr)?>
		<?php $telpsetup=array('id'=>'telpsetup','name'=>'telpsetup','value'=>$setup->telp_hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($telpsetup);?><br>
		<?php echo form_label('HP','hpsetup',$attr)?>
		<?php $hpsetup=array('id'=>'hpsetup','name'=>'hpsetup','value'=>$setup->hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hpsetup);?><br>
		<?php echo form_label('HP','hp2setup',$attr)?>
		<?php $hp2setup=array('id'=>'hp2setup','name'=>'hp2setup','value'=>$setup->hp2,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hp2setup);?><br>
		<?php echo form_label('Email','emailsetup',$attr)?>
		<?php $emailsetup=array('id'=>'emailsetup','name'=>'emailsetup','value'=>$setup->email,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_email');?>
		<?php echo form_input($emailsetup);?><br>
	</div>
	<div id='datatagihan'>
		<?php $tagihan=$client->contact->where('tipe','penagihan')->get();?>
		<?php echo form_label('Nama','tagihanname',$attr)?>
		<?php $tagihanname=array('id'=>'tagihanname','name'=>'tagihanname','value'=>$tagihan->name,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_person_name');?>
		<?php echo form_input($tagihanname);?><br>
		<?php echo form_label('KTP','ktptagihan',$attr)?>
		<?php $ktptagihan=array('id'=>'ktptagihan','name'=>'ktptagihan','value'=>$tagihan->ktp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_ktp');?>
		<?php echo form_input($ktptagihan);?><br>
		<?php echo form_label('Telepon','telptagihan',$attr)?>
		<?php $telptagihan=array('id'=>'telptagihan','name'=>'telptagihan','value'=>$tagihan->telp_hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($telptagihan);?><br>
		<?php echo form_label('HP','hptagihan',$attr)?>
		<?php $hptagihan=array('id'=>'hptagihan','name'=>'hptagihan','value'=>$tagihan->hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hptagihan);?><br>
		<?php echo form_label('HP 2','hp2tagihan',$attr)?>
		<?php $hp2tagihan=array('id'=>'hp2tagihan','name'=>'hp2tagihan','value'=>$tagihan->hp2,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hp2tagihan);?><br>
		<?php echo form_label('Email','emailtagihan',$attr)?>
		<?php $emailtagihan=array('id'=>'emailtagihan','name'=>'emailtagihan','value'=>$tagihan->email,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_email');?>
		<?php echo form_input($emailtagihan);?><br>
	</div>
	<div id='datasupportteknis'>
		<?php $support=$client->contact->where('tipe','support')->get();?>
		<?php echo form_label('Nama','supportname',$attr)?>
		<?php $supportname=array('id'=>'supportname','name'=>'supportname','value'=>$support->name,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_person_name');?>
		<?php echo form_input($supportname);?><br>
		<?php echo form_label('KTP','ktpsupport',$attr)?>
		<?php $ktpsupport=array('id'=>'ktpsupport','name'=>'ktpsupport','value'=>$support->ktp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_ktp');?>
		<?php echo form_input($ktpsupport);?><br>
		<?php echo form_label('Telepon','telpsupport',$attr)?>
		<?php $telpsupport=array('id'=>'telpsupport','name'=>'telpsupport','value'=>$support->telp_hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($telpsupport);?><br>
		<?php echo form_label('HP','hpsupport',$attr)?>
		<?php $hpsupport=array('id'=>'hpsupport','name'=>'hpsupport','value'=>$support->hp,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hpsupport);?><br>
		<?php echo form_label('HP 2','hp2support',$attr)?>
		<?php $hp2support=array('id'=>'hp2support','name'=>'hp2support','value'=>$support->hp2,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_telp');?>
		<?php echo form_input($hp2support);?><br>
		<?php echo form_label('Email','emailsupport',$attr)?>
		<?php $emailsupport=array('id'=>'emailsupport','name'=>'emailsupport','value'=>$support->email,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left input_email');?>
		<?php echo form_input($emailsupport);?><br>
	</div>
	<div id='biayaberlangganan'>
		<?php echo form_label('Biaya Setup','biayasetup',$attr)?>
		<?php $biayasetup=array('id'=>'biayasetup','name'=>'biayasetup','value'=>$client->setup_fee,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left');?>
		<?php echo form_input($biayasetup)?><br>
		<?php echo form_label('Biaya Berlangganan Bulanan','biayalangganan',$attr)?>
		<?php $biayalangganan=array('id'=>'biayalangganan','name'=>'biayalangganan','value'=>$client->monthly_subscription_fee,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left');?>
		<?php echo form_input($biayalangganan)?><br>
		<?php echo form_label('Biaya Perangkat','biayaperangkat',$attr)?>
		<?php $biayaperangkat=array('id'=>'biayaperangkat','name'=>'biayaperangkat','value'=>$client->device_fee,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left');?>
		<?php echo form_input($biayaperangkat)?><br>
		<?php echo form_label('Biaya Lainnya','biayalainnya',$attr)?>
		<?php $biayalainnya=array('id'=>'biayalainnya','name'=>'biayalainnya','value'=>$client->other_fee,'class'=>'ui-autocomplete-input ui-widget ui-widget-content ui-corner-left');?>
		<?php echo form_input($biayalainnya)?>
	</div>
	<div id='aktivasi'>
	
	
		<?php if($client->status_id==0)
			echo '<input id="status1" name="status" type="radio" value="1" class="radio" checked="checked" />Pelanggan Aktif <br><br>';
		else 
			echo '<input id="status1" name="status" type="radio" value="1" class="radio" />Pelanggan Aktif <br><br>';
		if($client->status_id==1)
			echo '<input id="status2" name="status" type="radio" value="2" class="radio" checked="checked" />Pelanggan Non Aktif <br><br>';
		else
			echo '<input id="status2" name="status" type="radio" value="2" class="radio" />Pelanggan Non Aktif <br><br>';
		if($client->status_id==2)
			echo '<input id="status3" name="status" type="radio" value="3" class="radio" checked="checked" />Mantan Pelanggan <br><br>';
		else 
			echo '<label class="radio"><input id="status3" name="status" type="radio" value="3" class="radio" />Mantan Pelanggan</label> <br><br>';
		?>
	</div>
	</div><!-- end of tabs -->
	<?php echo form_submit('save','Simpan','id="save"');?>
	<a href='<?php echo $back_url;?>' id='backbutton'>Kembali</a>
	<?php echo form_close();?>
	</div>

</div><!-- End demo -->
<?php $this->load->view('common/footer');?>