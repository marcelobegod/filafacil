<?php
    if(isset($_GET['page'])){

        switch ($_GET['page']) {
            case 'home':
                include 'home.php';
                break;

            case 'logar':
                include 'logar.php';
                break;

        }
    }
?>