<?php
include "db_config.php";
$sql="insert into video values ('".$_POST['code']."',".$_POST['maker_id'].",".$_POST['mamory'].",".$_POST['freqgpu'].",".$_POST['freqmem'].",".$_POST['interface_id'].",".$_POST['directx'].",".$_POST['resolution_id'].",".$_POST['monitor'].",".$_POST['connection_id'].",".$_POST['model_id'].")";
