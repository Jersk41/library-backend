<?php

require "config.php";

/**
 * Membaca todolist dari database
 *
 * Mengambil semua todolist dari table dalam database
 *
 * @return array array yang berisi data dari dalam table
 * @throws error dengan kode 1 jika terjadi error sql/php
 **/
function todoList(){
    global $conn;
    $data = [];
    $result = $conn->query("SELECT * FROM todo");
    if (!$result) {
        header("location:index.php?error=1");
    }else {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}

/**
 * Menambahkan todo list baru
 *
 * Menambah todo list ke table dalam database
 *
 * @param string $values Berisi parameter values yang untuk menambah data baru
 * @throws error dengan kode 2 jika terjadi error sql/php
 **/
function tambahTodo($values){
    global $conn;
    $result = 
    $conn->query("INSERT INTO todo VALUES($values)");
    if($conn->affected_rows > 0){
        echo "Data berhasil ditambahkan";
        header("location:index.php");
    }else{
        header("location:index.php?error=2");
    };
}
/**
 * edit kondisi todo
 *
 * Mengedit field selesai dalam table karena todolist sudah selesai
 *
 * @param string $key berisi id dari todo yang akan dirubah kondisinya
 * @param string $kondisi rubah kondisi menjadi Y/T
 * @throws error dengan kode 3 jika terjadi error sql/php
 **/
function editTodo($key,$kondisi){
    global $conn;
    $todo_id = $key;
    $result = $conn->query("UPDATE todo SET selesai='$kondisi' WHERE id='$todo_id'");
    if ($conn->affected_rows > 0) {
        echo "Data Berhasil dirubah";
        header("location:index.php");
    }else{
        header("location:index.php?error=3");
    }
}

/**
 * Menghapus todo
 *
 * Mengahapus todo list berdasarkan key/id nya
 *
 * @param string $key ID todolist
 * @throws error dengan kode 4 jika terjadi error sql/php
 **/
function hapusTodo($key){
    global $conn;
    $id = $key;
    $result = $conn->query("DELETE FROM todo WHERE id='$id'");
    if($conn->affected_rows > 0){
        echo "Data berhasil dihapus";
        echo '<meta http-equiv="refresh" content="0;">';
    }else{
        header("location:index.php?error=4");
    };
}
?>