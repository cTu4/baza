<?php
include "db_config.php";
//var_dump($_POST);die;
$maker_id=0;
$interface_id=0;
$resolution_id=0;
$connection_id=0;
$model_id=0;
switch ($_POST['maker']) {
    case 'gigabyte':
        $maker_id=1;
        break;
    case 'asus':
        $maker_id=3;
        break;
    case 'palit':
        $maker_id=2;
        break;
}
switch ($_POST['interface']){
    case 'ddr3':
        $interface_id=1;
        break;
    case 'ddr4':
        $interface_id=2;
        break;
    case 'ddr5':
        $interface_id=3;
        break;
    case 'ddr6':
        $interface_id=4;
        break;
}
switch ($_POST['connection']){
    case 'pci-e v.2':
        $connection_id=1;
        break;
    case 'pci-e v.3':
        $connection_id=2;
        break;
}
switch ($_POST['resolution']){
    case '2560x1600':
        $resolution_id=1;
        break;
    case '4096x2160':
        $resolution_id=2;
        break;
    case '7680x4320':
        $resolution_id=4;
        break;
}
switch ($_POST['model']){
    case 'geforce rtx 2080':
        $model_id=1;
        break;
    case 'geforce rtx 2070':
        $model_id=2;
        break;
    case 'geforce gtx 1080':
        $model_id=3;
        break;
    case 'geforce gtx 1080 ti':
        $model_id=4;
        break;
    case 'geforce gtx 1070':
        $model_id=5;
        break;
    case 'geforce gtx 260':
        $model_id=6;
        break;
    case 'geforce gtx 960':
        $model_id=7;
        break;
    case 'geforce gtx 650':
        $model_id=8;
        break;
}

$sql="insert into heroku_16503ce43a6aad8.videocards values ('".$_POST['code']."',".(int)$maker_id.",".(int)$_POST['memory'].",".(int)$_POST['freqgpu'].",".(int)$_POST['freqmem'].",".(int)$interface_id.",".(int)$_POST['directx'].",".(int)$resolution_id.",".(int)$_POST['monitor'].",".(int)$connection_id.",".(int)$model_id.")";
if ($mysqli->connect_errno) {
    var_dump('Не подключились!');
    die;
}
if (!$mysqli->query($sql)) {

}
$arr_main = [];


// maker
$sql = "select DISTINCT maker, COUNT(maker) as count from heroku_16503ce43a6aad8.videocards inner join makers on heroku_16503ce43a6aad8.videocards.maker_id=makers.maker_id GROUP BY maker";
$maker = mysqli_query($mysqli,$sql);
$maker = mysqli_fetch_all($maker);
$arr_maker = [];
foreach($maker as $key => $val)
{
    array_push($arr_maker, ['name' => $val[0], 'y' => $val[1]]);
}

//  memory
$sql = "select DISTINCT memory, COUNT(memory) as count from heroku_16503ce43a6aad8.videocards GROUP BY memory";
$mem = mysqli_query($mysqli,$sql);
$mem = mysqli_fetch_all($mem);
//$mem = json_encode($mem, JSON_NUMERIC_CHECK);
$arr_memory = [];
foreach($mem as $key => $val)
{
    array_push($arr_memory, ['name' => $val[0] . ' ГБ', 'y' => $val[1]]);
}

// interface
$sql = "select DISTINCT interface, COUNT(interface) as count from heroku_16503ce43a6aad8.videocards inner join interface on heroku_16503ce43a6aad8.videocards.interface_id=interface.interface_id GROUP BY interface";
$interface = mysqli_query($mysqli,$sql);
$interface = mysqli_fetch_all($interface);
//$mem = json_encode($mem, JSON_NUMERIC_CHECK);
$arr_interface = [];
foreach($interface as $key => $val)
{
    array_push($arr_interface, ['name' => $val[0], 'y' => $val[1]]);
}


//freqmem
$sql = "select code,freqmem from heroku_16503ce43a6aad8.videocards order by freqmem";
$freqmem = mysqli_query($mysqli,$sql);
$freqmem = mysqli_fetch_all($freqmem);


//freqgpu
$sql = "select code,freqgpu from heroku_16503ce43a6aad8.videocards order by freqgpu";
$freqgpu = mysqli_query($mysqli,$sql);
$freqgpu = mysqli_fetch_all($freqgpu);


//directx
$sql = "select DISTINCT directx, COUNT(directx) as count from heroku_16503ce43a6aad8.videocards GROUP BY directx";
$directx = mysqli_query($mysqli,$sql);
$directx = mysqli_fetch_all($directx);
$arr_directx = [];
foreach($directx as $key => $val)
{
    array_push($arr_directx, ['name' => $val[0].' version', 'y' => $val[1]]);
}


//monitor
$sql = "select DISTINCT monitor, COUNT(monitor) as count from heroku_16503ce43a6aad8.videocards GROUP BY monitor";
$monitor = mysqli_query($mysqli,$sql);
$monitor = mysqli_fetch_all($monitor);
//$mem = json_encode($mem, JSON_NUMERIC_CHECK);
$arr_monitor = [];
foreach($monitor as $key => $val)
{
    array_push($arr_monitor, ['name' => 'Кол-во мониторов: '.$val[0], 'y' => $val[1]]);
}

//resolution
$sql = "select DISTINCT resolution, COUNT(resolution) as count from heroku_16503ce43a6aad8.videocards inner join resolution on heroku_16503ce43a6aad8.videocards.resolution_id=resolution.resolution_id GROUP BY resolution";
$resolution = mysqli_query($mysqli,$sql);
$resolution = mysqli_fetch_all($resolution);
//$mem = json_encode($mem, JSON_NUMERIC_CHECK);
$arr_resolution = [];
foreach($resolution as $key => $val)
{
    array_push($arr_resolution, ['name' => $val[0], 'y' => $val[1]]);
}

// connection
$sql = "select DISTINCT connection, COUNT(connection) as count from heroku_16503ce43a6aad8.videocards inner join connection on heroku_16503ce43a6aad8.videocards.connection_id=connection.connection_id GROUP BY connection";
$connection = mysqli_query($mysqli,$sql);
$connection = mysqli_fetch_all($connection);
//$mem = json_encode($mem, JSON_NUMERIC_CHECK);
$arr_conn = [];
foreach($connection as $key => $val)
{
    array_push($arr_conn, ['name' => $val[0], 'y' => $val[1]]);
}
array_push($arr_main,[$arr_maker,$arr_memory, $arr_interface,$freqmem,$freqgpu,$arr_directx,$arr_monitor,$arr_resolution,$arr_conn]);

echo json_encode($arr_main, JSON_NUMERIC_CHECK);





/*
$code=$_POST['code'];
$maker_id=$_POST['maker_id'];
$memory=$_POST['memory'];
$freqgpu=$_POST['freqgpu'];
$freqmem=$_POST['freqmem'];
$interface_id=$_POST['interface_id'];
$directx=$_POST['directx'];
$resolution_id=$_POST['resolution_id'];
$monitor=$_POST['monitor'];
$connection_id=$_POST['connection_id'];
$model_id=$_POST['model_id'];*/
/*
$sql="insert into video values("."'$code',"."$maker_id,"."$memory,"."$freqgpu,"."$freqmem,"."$interface_id,"."$directx,"."$resolution_id,"."$monitor,"."$connection_idm,"."$model_id".")";
$table = mysqli_query($dbconn,$sql);*/

