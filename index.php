<!DOCTYPE html>
<html>
  <head>
    <title>Users List</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/msg.css">
    <script src="/js/msg.js"></script>
  </head>
  <body>
    <?php
    require "inc/lib-msg.php";
    $users = $_MSG->getUsers($_SESSION["user"]["id"]); ?>

    <div id="uLeft">
      <div id="uNow">
        <div><img src="/img/1.jpg"></div>
        <div><?=$_SESSION["user"]["name"]?></div>
      </div>

      <?php foreach ($users as $uid=>$u) { ?>
      <div class="uRow" id="usr<?=$uid?>" onclick="msg.show(<?=$uid?>)">
        <div class="uName"><?=$u["user_name"]?></div>
        <div class="uUnread"><?=isset($u["unread"])?$u["unread"]:0?></div>
      </div>
      <?php } ?>
    </div>

    <div id="uRight">
      <form id="uSend" onsubmit="return msg.send()">
        <input type="text" id="mTxt" required>
        <input type="submit" value="Send">
      </form>

       <div id="uMsg"></div>
    </div>
  </body>
</html>