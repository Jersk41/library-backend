<?php

// todo list ribet!!!
require "config.php";
$conn = Connect();
// $conn = new mysqli("localhost","root","","todolist");
function createRequest($agenda,$waktu){
    $arr = array();
    return $arr;
}
// $data = array();
// $data['agenda'] = "cek";
// $data['detail'] = array(
//     'time'=>"123",
//     'completed'=>false,
// );
// $arr = array("0"=>$data);
// $json = json_encode($arr,JSON_PRETTY_PRINT);
// array_push($arr,$data);
// var_dump($arr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
</head>

<body>
    <main>
        <div class="form-input">
            <form method="post" target="">
                <!-- <input type="date" name="tanggal" id="tanggal"> -->
                <input type="text" name="agenda" id="agenda" placeholder="Mau ngapain aja nih?">
                <button type="submit" name="send">+Tambah</button>
            </form>
        </div>
        <div class="data-list" name="todo">
            <ul id="lists">
            </ul>
        </div>
    </main>
    <?php
    
    if(isset($_POST['agenda'])){
        // ambil waktu dan agenda
        $waktu = date('yy-m-d H:m');
        $agenda = $_POST['agenda'];
        /**
         *  cek data todo list
         * jika ada maka akan ditambah
         * jika tidak buat file baru */
        if (is_file("data.json")) {
            $inp = file_get_contents('data.json');
            $temp = json_decode($inp,true);
            // echo "<script>alert(".var_dump($temp).")</script>";
            $data = array();
            $data['agenda'] = $agenda;
            $data['detail'] = array(
                'time'=>$waktu,
                'completed'=>false,
            );
            array_push($temp,$data);
            $jsonData = json_encode($temp,JSON_PRETTY_PRINT);
            file_put_contents("data.json",$jsonData);
        }else{
            $list = array();
            $data = array();
            $data['agenda'] = $agenda;
            $data['detail'] = array(
                'time'=>$waktu,
                'completed'=>false,
            );            
            // print_r($data);
            $list = array("\0"=>$data);
            $json = json_encode($list,JSON_PRETTY_PRINT);
            header("Content-type:application/json;charset:utf-8;");
            var_dump($json);
            file_put_contents("data.json",$json);
        }
    }
    ?>
    <script src="res.js"></script>
</body>

</html>