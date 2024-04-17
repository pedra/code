<?php
	define("ROOT", dirname(__FILE__));
	define("ROOT_DB", dirname(__FILE__).'/inc');
	session_start();
// $_SESSION["user"] = ["id" => 1, "name" => "Joe Doe"];
// $_SESSION["user"] = ["id" => 2, "name" => "Jon Doe"];
$_SESSION["user"] = ["id" => 3, "name" => "Jane Doe"];
	/*
	
	include_once "./inc/db/messageDb.php";
	include_once "./inc/db/userDb.php";

	$msg = new MessageDb();

// Pegando mensagens do admin para o usuário indicado
	echo "<pre><h2>Message->getByUserId:</h2>
" . print_r($msg->getByUserId(2), true) . "</pre>";

// Pegando todas as mensagens para o admin
	echo "<pre><h2>Message->getToAdm:</h2>
" . print_r($msg->getToAdm(), true) . "</pre>"; 

	$user = new UserDb();

// Pegando usuários do sistema (ou especificado)
	echo "<pre><h2>User->getById:</h2>
" . print_r($user->getById(3), true) . "</pre>";

	echo "<pre><h2>User->getByHash:</h2>
" . print_r($user->getByHash("ee8c9c87caab7be1830ae701f61d2c5293772b74a9fa84497e8e1cea8b52d1e1"), true) . "</pre>";


	exit();
*/
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Users List</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/msg.css">
    <script src="/js/main.js"></script>
    <script src="/js/msg.js"></script>
  </head>
  <body>
<?php
    require "inc/lib-msg.php";
    $users = (new Message)->getUsers($_SESSION["user"]["id"]);
?>
	
    <div id="uLeft">
      <div id="uNow">
        <div><img src="/img/avatar_800.jpg" id="user_avatar"></div>
        <div id="user_name">&nbsp;</div>
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