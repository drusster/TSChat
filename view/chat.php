<?php defined('peremen') or die();?>
<div class="chat_content">
    <span>Сообщение</span>
    <form method="POST" name="send_message">
        <input type="text" name="message" placeholder="Текст сообщения" autofocus >
        <div class="btn-conteiner-chat send">
            <a href="" id="button_send_message">
                Отправить
            </a>
        </div>
        <div class="btn-conteiner-chat exit">
            <a href="/?do=logout" id="button_exit">
                Выход
            </a>
        </div>
    </form>
</div>
<input type="hidden" name="last_messages" value="<?=$messages[0]['message_id']?>"/>
<?php
    foreach ($messages as $text) {
        ?>
        <div class="message <?=($text['login'] === $_SESSION['login'])? 'my': 'alien';?>">
            <span><?=$text['login']?></span><?=$text['text']?>
        </div>
<?php
    }
?>
<!--<div class="message alien">
    <span>Первый логин</span>Сообщение от первого логина
</div>
<div class="message my">
    <span>Мой логин</span>Моё сообщение
</div>-->