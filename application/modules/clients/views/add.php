<?php $this->load->view('common/header'); ?>
<?php
echo form_open('clients/add_handler');
echo form_label('Branch','branch_id');
echo form_input('branch_id');
echo form_label('Category','category_id');
echo form_input('category_id');
echo form_label('Service','service_id');
echo form_input('service_id');

echo form_label('Other','LAINNYA');
echo form_input('LAINNYA');
echo form_label('Client Name','NAMA PELANGGAN');
echo form_input('NAMA_PELANGGAN');
echo form_label('Type of Business','JENIS_USAHA');
echo form_input('JENIS_USAHA');
echo form_label('SIUP','SIUP');
echo form_input('SIUP');
echo form_label('NPWP','NPWP');
echo form_input('NPWP');
echo form_label('Address','ALAMAT');
echo form_input('ALAMAT');

echo form_label('Telp','TELP');
echo form_input('TELP');
echo form_label('Fax','FAX');
echo form_input('FAX');
echo form_label('Applicant Name','NAMA_PEMOHON');
echo form_input('NAMA_PEMOHON');

echo form_label('Form Number','NO_FB');
echo form_input('NO_FB');
echo form_label('Form Date','TGL_FB');
echo form_input('TGL_FB');
echo form_label('Id Num','NO_ID');
echo form_input('NO_ID');
echo form_label('Telp HP','TELP_HP');
echo form_input('TELP_HP');
echo form_label('HP','HP');
echo form_input('HP');
echo form_label('HP2','HP2');
echo form_input('HP2');

echo form_label('Email','EMAIL');
echo form_input('EMAIL');
echo form_label('Setup Fee','BIAYA_SETUP');
echo form_input('BIAYA_SETUP');
echo form_label('Monthly Fee','BIAYA_BERLANGGANAN_BULANAN');
echo form_input('BIAYA_BERLANGGANAN_BULANAN');

echo form_label('Device Fee','BIAYA_PERANGKAT');
echo form_input('BIAYA_PERANGKAT');
echo form_label('Branch','BIAYA_LAINNYA');
echo form_input('BIAYA_LAINNYA');
echo form_label('Service Desc','KETERANGAN_LAYANAN');
echo form_input('KETERANGAN_LAYANAN');

echo form_label('Activation Date','TGL_AKTIVASI');
echo form_input('TGL_AKTIFASI');
echo form_label('Period','PERIODE_LANGGANAN');
echo form_input('PERIODE_LANGGANAN');
echo form_label('Special Request','REQUEST_KHUSUS');
echo form_input('REQUEST_KHUSUS');
echo form_label('Account Manager','ACCOUNT_MANAGER');
echo form_input('ACCOUNT_MANAGER');
echo form_label('Status','STATUS');
echo form_input('STATUS');
echo form_label('Tanggal','tanggal');
echo form_input('tanggal');
echo form_label('Client Code','KODE_PELANGGAN');
echo form_input('KODE_PELANGGAN');
echo form_submit('Save','save')
?>
<?php $this->load->view('common/footer'); ?>