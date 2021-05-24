<?php
include('classSimpleImage.php');



define("IMG_DIR", "img/");
define("IMG_DIR_BIG", "img/big/");

$messages = [
        'OK' => 'Файл загружен!',
        'ERROR' => 'Ошибка.',
];

    if (isset($_FILES['myfile'])) {
        $path = IMG_DIR_BIG . $_FILES['myfile']['name'];

        //Проверка файла на безопасность
        $imageinfo = getimagesize($_FILES['myfile']['tmp_name']);
        if($imageinfo){
            if (move_uploaded_file($_FILES['myfile']['tmp_name'], $path)) {
            
                $image = new SimpleImage();
                $image->load($_FILES['myfile']['name']);
                $image->resize(200, 200);
                $image->save(IMG_DIR . $_FILES['myfile']['name']);
                header("Location: /?message=OK");
                die();
            } else {
            
                header("Location: /?message=ERROR");
                die();
            }
        } else {
            
            header("Location: /?message=ERROR");
            die();
        }
    }

$message = '';
if (isset($_GET['message']))   
$message = $messages[$_GET['message']];

$files = scandir(IMG_DIR);
$files = array_splice($files, 3);//иначе выдавалось Notice: Only variables should be passed by reference

$content = '<div style="width:80%; margin: 0 auto;">';
$content .= '<ul style=" display:flex; flex-wrap: wrap; justify-   content: space-between; list-style:none">';

foreach ($files as $file){
    $content .="<li >
    <div style='width:300; text-align:center;margin-top:50;'>
        <a target=\"_blank\" href=" . IMG_DIR . "big/" . $file . ">
            <img src=" . IMG_DIR . $file . " alt='' width='200'>
        </a>
    </div>
 </li>";
} 
$content .='</ul></div>';



echo $content;

$upload = '<br>
<p>' . $message . '</p>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="myfile">
    <input type="submit" value="Загрузить файл">
</form>';

echo $upload;

//($imageinfo['mime'] == 'image/gif' || $imageinfo['mime'] == 'image/jpg')
