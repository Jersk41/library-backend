<?php
require "config.php";
// pesan error
$error = "";

$data = [];
$result = $conn->query("SELECT id,todo FROM todo");
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $result = $conn->query("DELETE FROM todo WHERE id='$id'");
    if($conn->affected_rows > 0){
        echo "Data berhasil dihapus";
        echo '<meta http-equiv="refresh" content="0;url=./">';
    }else{
        $error = "Data Gagal dihapus";
    };
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="C:\xampp\htdocs\Todolist\assets\all.min.css">
    <script src="assets/jquery-3.5.1.min.js"></script>
    <script src="assets/bootstrap.bundle.min.js"></script>
    <title>To Do List</title>
</head>

<body class="container-sm p-sm-0">
    <header class="text-center">
        <h1 class="display-4">ToDoList</h1>
    </header>
    <main class="container-fluid col-sm-11 col-md-11 col-lg-10">
        <div class="form-group">
            <form method="post" target="todo" action="" class="form-inline">
                <!-- <input type="date" name="tanggal" id="tanggal"> -->
                <input type="text" name="agenda" class="form-control col-10 col-sm-9 col-md-10 col-lg-11" id="agenda" placeholder="Mau ngapain aja nih?">
                <button type="submit" class="btn btn-primary col-2 col-sm-3 col-md-2 col-lg-1" name="send"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="list-group" name="todo">
            <ul id="lists" class="list-group">
            <?php
            // $i = 0;
            foreach ($data as $field) {
                echo "<li class='list-group-item'>
                    <div class='input-group form-check-inline'>
                        <input type='checkbox' class='form-check-box m-auto' name='check' id='cek'>
                        <label for='cek' class='form-check-label m-auto col-10'>$field[todo]</label>
                        <span class='input-group-append'>
                            <a href='?del=$field[id]'><i class='fa fa-trash' aria-hidden='true'></i></a>
                        </span>
                    </div>
                </li>";
            }
            ?>
            </ul>
        </div>
    </main>
    <?php
    
    if(isset($_POST['agenda'])){
        // ambil waktu dan agenda
        $waktu = date('yy-m-d H:m');
        $agenda = $_POST['agenda'];
        $selesai = true;

        $result = $conn->query("INSERT INTO todo VALUES('null','$waktu','$agenda','T')");
        if($conn->affected_rows > 0){
            echo "Data berhasil ditambahkan";
            header("location:index.php");
        }else{
            $error = "Data Gagal ditambahkan";
        };
    }
    ?>
    <script src="controller.js"></script>
</body>

</html>