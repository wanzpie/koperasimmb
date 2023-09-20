<?php
$dbhost = '192.168.200.6\mlcrm';
$dbuser = 'mapt';
$dbpass = 'm3tl4ndapt';
$dbname = 'METLANDSOFT_TENANT';
$koneksi = mssql_connect($dbhost,$dbuser,$dbpass)or die('Error connecting to the SQL Server database.');

mssql_select_db($dbname,$koneksi);

$resetCounterJournal  = "UPDATE a set a.ACC_SOURCODE_COUNTER = 1 FROM ACC_SOURCODE as a";

mssql_query($resetCounterJournal);

$resetCounterBV  = "update counter_table set invoiced_count=1,kwt_count=1,
                     optutility_count=1,invoiceman_count=1,scutim_count=1,bvjurnal_count=1,bank_voucher_int=1 ";

mssql_query($resetCounterBV);

$resetpwd = "update users set isChange=0";

mssql_query($resetpwd);
