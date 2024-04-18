<?php

if (isset($_POST["req"])) {
	require ROOT . "/inc/lib-msg.php";
	$_MSG = new Message();
	
	switch ($_POST["req"]) {
		// (A) SHOW MESSAGES
		case "show":
			$msg = $_MSG->getMsg($_POST["uid"], $_SESSION["user"]["id"]);
			if (count($msg) > 0) {
				foreach ($msg as $m) {
					$out = $m["user_from"] == $_SESSION["user"]["id"]; ?>
					<div class="mRow <?= $out ? "mOut" : "mIn" ?>">
						<div class="mDate"><?= $m["date_send"] ?></div>
					</div>
					<div class="mRow <?= $out ? "mOut" : "mIn" ?>">
						<div class="mRowMsg">
							<div class="mSender"><?= $m["user_name"] ?></div>
							<div class="mTxt"><?= $m["message"] ?></div>
						</div>
					</div>
				<?php }
			}
			break;

		// (B) SEND MESSAGE
		case "send":
			echo $_MSG->send($_SESSION["user"]["id"], $_POST["to"], $_POST["msg"])
				? "OK" : $_MSG->error;
			break;
	}
}

else {
	$lh = isset($_POST["hash"]) ? $_POST["hash"] : false;
	$hash = hash(
		'sha256',
		$_SERVER["REMOTE_ADDR"] .
		$_SERVER["HTTP_USER_AGENT"] .
		$_SERVER["HTTP_ACCEPT"] .
		$_SERVER["HTTP_ACCEPT_LANGUAGE"] .
		$_SERVER["HTTP_ACCEPT_ENCODING"]
	);

	$user = [];
	$msg = [];

	// echo "<pre>Hash: $hash
	// Lh: $lh</pre>";

	// Get user data and messages
	if($lh && $lh === $hash) {

		include_once ROOT . "/inc/db/userDb.php";
		include_once ROOT . "/inc/db/messageDb.php";

		$User = new UserDb();		
		$user = $User->getByHash($hash)[0];

		$Msg = new MessageDb();
		$msg = $Msg->getByUserId($user["uid"]);
	}

	if($lh && $lh !== $hash) $hash = false;

	// Gravando na SESSION
	$_SESSION["hash"] = $hash;

	echo json_encode([
		"hash" => $hash,
		"user" => $user,
		"msg" => $msg,
		"SESSION" => $_SESSION["hash"]
	]);

}