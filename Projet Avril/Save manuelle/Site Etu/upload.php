<?php
    print_r($_FILES);
    if(move_uploaded_file($_FILES['img_import']['tmp_name'], "API/img/".'coucou.png')){
        echo "YESSSSS";
    } else {
        echo "NOOOO";
    }
?>
