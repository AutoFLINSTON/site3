<?php
session_start();
require_once "functions.php";
// если был сделан пост запрос
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $name = clear_data_str($_POST['name']);
    $last_name = clear_data_str($_POST['email']);
    $message  = clear_data_str($_POST['comment']);
    $file = $_FILES['upload'];
    $file_upload = null;

    // если есть пустые поля
    if(empty($name) || empty($last_name) || empty($message)){
        redirect("Заполните все поля", "alert-danger");
    }


    // Если файл был прикреплен
    if($file['size'] > 0){
        $file_upload = download_files($file);
    }

    // Если файл был отправлен
    if(send_message_to_email(array(
        'name' => $name,
        'email' => $last_name,
        'comment'   => $message
    ), $file_upload)){
        unlink($file_upload);
        redirect('Сообщение успешно отправлено', 'alert-success');
    } else {
        unlink($file_upload);
        redirect('Ошибка при отправке сообщения');
    }


} else {
    redirect("Не надо ломать мой сайт");
}
