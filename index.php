<?php
require "function.php";
// pesan error
$error = "";

$data = todoList();

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    hapusTodo($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
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
            $i = 0;
            foreach ($data as $field) {
                $done = "";
                $checked = "";
                if ($field['selesai']=="Y") {
                    $done  ="style='text-decoration:line-through'";
                    $checked = "checked";
                }
                echo "<li class='list-group-item'>
                    <div class='input-group form-check-inline'>
                        <input type='checkbox' class='form-check m-auto' name='check' id='check-$i' $checked>
                        <label for='check-$i' class='form-check-label m-auto col-10' $done>$field[todo]</label>
                        <span class='input-group-append'>
                            <a href='?del=$field[id]'><i class='fa fa-trash' aria-hidden='true'></i></a>
                        </span>
                    </div>
                </li>";
                $i++;
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
        $parameter = "'null','$waktu','$agenda','T'";
        tambahTodo($parameter);
    }
    ?>
    <script>
    $('.form-check-inline').click(function(e){
        console.log(e);
        let checkbox = this.children[0];
        let label = this.children[1];
        let id_todo = this.children[2].children[0].attributes[0].value;
        let key = id_todo.slice(5);
        if (checkbox.checked) {
            label.style.textDecoration = "line-through";
            $.post('index.php',{
                todo_id: key,
                check:"Y"
            }, function(data){
                console.log(data);
            }).fail(function(){
                alert("posting failed");
                return false;
            });
        }else{
            label.style.textDecoration = "none";
            $.post('index.php',{
                todo_id: key,
                check: "T"
            }, function(data){
                console.log(data);
            }).fail(function(){
                alert("posting failed");
                return false;
            });
        }
    });
    </script>

    <?php
    if (isset($_POST['todo_id'])) {
        $selesai = $_POST['check'];
        $id = $_POST['todo_id'];
        editTodo($id,$selesai);
    }
    ?>
</body>

</html>