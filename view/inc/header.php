<?php defined('peremen') or die();?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <link href="<?=TEMPLATE?>css/style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="<?=TEMPLATE?>js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="<?=TEMPLATE?>js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?=TEMPLATE?>js/workscripts.js"></script>
        <title></title>
    </head>
<body>
    <div class="header">
        Чат<?=$headeradd?>
    </div>
    <?php if(isset($_SESSION['res'])):
        echo $_SESSION['res'];
        unset ($_SESSION['res']);
    endif;?> 
