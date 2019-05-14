<?php
include "db_config.php";
$sql="delete from heroku_16503ce43a6aad8.videocards where code='".$_POST['code']."'";
if ($mysqli->query($sql)) {
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