<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login");
}
require_once "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../assets/icon.png">
    <link rel="stylesheet" href="bulma.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Leads - Cryptomania</title>
</head>
<body>
    <?php echo "<input type='hidden' id='unm' style='display:none' value={$_SESSION["username"]}>"; ?>
    <div class="title-wrapper container">
        <div class="tr5"><a href="../play.php"><img src="back.svg" height="30"></a></div>
        <div class="title">Lead Confirmations&nbsp;
            <svg class="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M17 11v3l-3-3H8a2 2 0 01-2-2V2c0-1.1.9-2 2-2h10a2 2 0 012 2v7a2 2 0 01-2 2h-1zm-3 2v2a2 2 0 01-2 2H6l-3 3v-3H2a2 2 0 01-2-2V8c0-1.1.9-2 2-2h2v3a4 4 0 004 4h6z"></path></svg>
        </div>
        <div class="tr5"></div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="chatbox">
                <div class="chatMsg admsg">
                    <div id="userName">BOT <div class="time">2020-09-14 18:33</div></div>
                    <div class="message">Welcome to Envoy Messenger!<br>Looks like you are alone.<br>Invite some friends to chat or go away. 😉</div>
                </div>
            </div>
        </div>
        <div class="send">
            <form method="post" action="chat.php" class="field" autocomplete="off">
                <textarea autofocus name="msg" maxlength="1000" type="text" class="input" placeholder="Enter message..."></textarea>
                <button name="submit" class="button" type="submit" id="send-btn">
                    <svg class="send-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M0 0l20 10L0 20V0zm0 8v4l10-2L0 8z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="chat.js"></script>
</body>
</html>