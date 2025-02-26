<?php
$_SERVER = "localhost";
$username = "root";
$password = "";
$databasename = "coba";

$koneksi = mysqli_connect($_SERVER, $username, $password, $databasename);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
	$email = $_POST["email"];
    $user_id = $_POST["user_id"];
    
	$key = $koneksi->prepare("insert into user(????,$user_id, $username, $email, $password)");
    
    $key->bind_param("ssss",$user_id, $username, $email, $password);

	$key->execute();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <header>Login</header>
    <form action="register.php" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Masukan Username">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukan Password">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukan email">

        <button type="Submit">Login</button>
    </form>

</body>
</html>

<!-- Code injected by live-server
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script> -->