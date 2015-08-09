<?php

require_once "../plugins/autoload.php";
require_once "../plugins/phpmailer/phpmailer/language/phpmailer.lang-ru.php";


/**
 *  Функция загрузки файлов
 *
 * @param $file
 * @param $url
 * @return string
 */
function download_files($file){

    $dir = __DIR__.'/uploads/';
    $filename  = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename_upload = $dir.$filename.'.'.$extension;

    if(move_uploaded_file($file['tmp_name'], $filename_upload)){
        return $filename_upload;
    }

}

/**
 * @param $data
 * @param null $file
 * @return bool
 * @throws Exception
 * @throws phpmailerException
 */
function send_message_to_email($data, $file = null){

    $mail = new PHPMailer;
    $mail->isSendmail();
    // Указываем отправителя письма
    $mail->setFrom('vadimslim2@yandex.ru', 'Вадим Клычев');
    // Указываем получателя письма
    $mail->addAddress('vadimslim@yandex.ru', "Вадиму Клычеву");
    // Указываем тему письма
    $mail->Subject = "Отправка письма с сайта WWW-Ka.ru";
    // Устанавливаем текст сообщения
    $mail->msgHTML("Тестовое письмо с вебинара от ".$data['email'].' '.$data['name']);

    if($file){
        $mail->addAttachment($file);
    }

    return $mail->send();

}

function redirect($message, $class = "alert-info"){
    $_SESSION['comment'] = $message;
    $_SESSION['message_class'] = $class;
    header("HTTP/1.1 307 Temporary Redirect");
    header("Location: index.php");
    exit;
}

function clear_data_str($data){
    return htmlentities(strip_tags(trim($data)));
}
