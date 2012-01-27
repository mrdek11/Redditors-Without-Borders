<?php

class RWB {
	function displayHeader(){
		echo "<div align='right'>";
		if(!isset($_SESSION['username'])){
			echo "<script>
			function showLogin(link){
				link = document.getElementById('loginLink');
				div=document.getElementById('loginForm');
				div.style.display='block';
				link.href='javascript:hideLogin()';
			}
			function hideLogin(){
				link = document.getElementById('loginLink');
				div=document.getElementById('loginForm');
				div.style.display='none';
				link.href='javascript:showLogin()';
			}
			</script>";
                	echo "<a id='loginLink' href='javascript:showLogin();'>Login</a> | <a href='#'>Register</a>";
                }else{  
                	echo "<a href='index.php?logout'>Logout {$_SESSION['username']}</a>";
                }
                echo "</div>";
		echo "<div id='loginForm' style='display:none;s-index:10'>
			<form action='index.php' method='post'>
			Username: <input type='text' name='username' /><br />
			Password: <input type='password' name='password' /><br />
			<input type='submit' value='Login' />
			</form>
		      </div>";
	}
	function handleLogin(){
		$username = mysql_real_escape_string($_POST['username']);
		$password = md5($_POST['password']);
	
		$query = Query("select * from Users where Username=\"$username\" and Password=\"$password\";");
		if(mysql_num_rows($query) == 0){
			echo "<span style='color:red'>Incorrect username or password.</span>";
			return false;
		}else{
			$row = mysql_fetch_array($query);
			$_SESSION['username'] = $row['Username'];
			$_SESSION['userID'] = $row['id'];
			$_SESSION['email'] = $row['Email'];
		}
	}
}

?>
