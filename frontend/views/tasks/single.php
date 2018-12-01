<?php
/** @var \common\models\Tasks $model */
/** @var \common\models\Chat[] $history */
?>

<h1><?= $model->name ?></h1>

<form action="#" name="chat_form" id="chat_form">
    <label>
        Type the message
        <input type="hidden" name="channel" value= "<?= $channel ?>">
        <input type="hidden" name="user_id" value= "<?= Yii::$app->user->getId() ?>">
        <input type="text" name="message">
        <input type="submit">
    </label>
</form>
<hr>
<div id="root_chat">
    <?php foreach ($history as $msg) :?>
    <div><?=$msg->message ?></div>
    <?php endforeach;?>
</div>

<script>
    if(!window.WebSocket) {
        alert("Without WebSocket");
    };

    var webSocket = new WebSocket("ws://frontend.courses.local:8080?channel=<?= $channel ?>");

    document.getElementById("chat_form")
        .addEventListener("submit", function(event) {
            var data = {
                message: this.message.value,
                channel: this.channel.value,
                user_id: this.user_id.value
            };
            webSocket.send(JSON.stringify(data));
            event.preventDefault();
            return false;
        });

    webSocket.onmessage = function(event) {
        var data = event.data;
        var messageContainer = document.createElement('div');
        var textNode = document.createTextNode(data);
        messageContainer.appendChild(textNode);
        document.getElementById("root_chat")
            .appendChild(messageContainer);

    }

</script>