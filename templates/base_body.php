    <?php
    include("base_body_header.php");
    include("base_sidebar.php");
    if ($CONTENT != "") {
        if ($TYPE_CONTENT == "html")
            echo $CONTENT;
        else if ($TYPE_CONTENT == "file")
            require $CONTENT;
        else
            echo 'Тип содержимого контента не установлен!';
    }
    include("base_body_footer.php");
