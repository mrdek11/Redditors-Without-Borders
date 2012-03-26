<?php

class RWB {

function displayNews(){
	$query = Query("select * from News order by Timestamp desc limit 3;");
	while($row = mysql_fetch_object($query)){
		echo "<h1>$row->Title</h1>
		<span style='color:#cccccc;'>".date("M j, Y h:ia",$row->Timestamp)."</span>
		$row->body";		
	}
}	
function showCauses(){
	$userID = $_SESSION['userID'];
	?>
	<script tyle='text/javascript'>
		function subscribe(link){
			if(!loggedIn){
				scroll(2000,0);
				showLogin();
				return false;
			}
			link.innerHTML = "<img border='0' src='images/subscribe-pressed.png' />";
			link.onclick = function onclick(event){
				unsubscribe(this);
			};

			var xmlhttp;
			if (window.XMLHttpRequest){
				xmlhttp=new XMLHttpRequest();
			}else{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("GET","subscribe.php?sub=true&id="+link.id,true);
			xmlhttp.send();
		}
		function unsubscribe(link){
                        link.innerHTML = "<img border='0' src='images/subscribe.png' />";
			link.onclick = function onclick(event){
                                subscribe(this);
                        };
			var xmlhttp;
                        if (window.XMLHttpRequest){
                                xmlhttp=new XMLHttpRequest();
                        }else{
                                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.open("GET","subscribe.php?sub=false&id="+link.id,true);
                        xmlhttp.send();
                }
	</script>
	<?php
	echo "<table>";
	echo "<tr>
		<td style='width:100px;'>&nbsp;</td>
	     	<td>
			<table>";

	$query = Query("select c.*,(select count(*) from Subscriptions where CauseID=c.id) as subs,(select count(*) from Subscriptions s where CauseID=c.id and s.UserID='$userID') as sub from Causes c order by subs desc;");
	while($o = mysql_fetch_object($query)){
		$raised = 0;
		$total = $o->Goal;
		$perc = round(($raised / $total) * 100);
		$subs = number_format($o->subs,0);
		$subbed = ($o->sub == 0) ? false : true;
		echo "<tr>
				<td>
					<table>
						<tr>
							<td align='left' valign='top' style='border:1px solid #cccccc;padding:3px;width:200px;'><img src=\"$o->Image\" width='200' /></td>
							<td valign='top' style='width:320px;'>
								<span style='font-size:25px'><a href='#'>$o->Title</a></span><br/>
							$subs Subscribers<br/>
							Extra info<p />
							$o->Detail<br/>
							</td>
							<td align='right' valign='top'>
								<span style='font-size:25px;'>$perc%</span><br/>raised<br/>";
							if($subbed){
								echo "<a href='javascript:void(0);' onclick='unsubscribe(this);' id='link_$o->id'><img border='0' src='images/subscribe-pressed.png' /></a>";
							}else{
								echo "<a href='javascript:void(0);' onclick='subscribe(this);' id='link_$o->id'><img border='0' src='images/subscribe.png' /></a>";
							}
							echo "</td>
						</tr>
					</table>
				</td>
		      </tr>";
		echo "<tr>
			<td><hr /></td>
		      </tr>";
	}
	echo "</table>
	</td></tr>";
	
	echo "</table>";
}
function displayHeader(){
		echo "<style>
                       a { text-decoration: none; color:#5a83c3; }
                       a:hover { color:#F26019; }
		       body{ font-family:'Trebuchet MS', Trebuchet; }
                      </style> ";
		echo "<table width='100%'>";
		
		echo "<tr>
			<td style='padding-left:40px;padding-top:50px;'>
				<a href='index.php'><img src='images/logo.png' border='0' /></a><br /><br />
				<table>
					<tr>
						<td style='padding-left:20px;font-size:20px;'><a href='index.php'>home</a></td>
						<td style='padding-left:20px;font-size:20px;'><a href='causes.php'>causes</a></td>
					</tr>
				</table>
			</td>
		        <td valign='top' align='right'>";
		if(!isset($_SESSION['username'])){
			echo "<script>
			function showLogin(){
				hideRegistration();
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

			function showRegistration(){
				hideLogin();
                                link = document.getElementById('registrationLink');
                                div=document.getElementById('registrationForm');
                                div.style.display='block';
                                link.href='javascript:hideRegistration()';
                        }
                        function hideRegistration(){
                                link = document.getElementById('registrationLink');
                                div=document.getElementById('registrationForm');
                                div.style.display='none';
                                link.href='javascript:showRegistration()';
                        }
			</script>";
                	echo "<a id='loginLink' href='javascript:showLogin();'>Login</a> | <a id='registrationLink' href='javascript:showRegistration();'>Register</a>";
			echo "<script type='text/javascript'>loggedIn=false;</script>";
                }else{  
                	echo "<a href='profile.php'>Profile</a> | <a href='index.php?logout'>Logout {$_SESSION['username']}</a>";
			echo "<script type='text/javascript'>loggedIn=true;</script>";
                }
                echo "</div>";
		echo "<div id='loginForm' style='display:none;s-index:10;position:absolute;top:30px;right:20px;background-color:white;'>
			<form action='index.php' method='post'>
			Username: <input type='text' name='username' /><br />
			Password: <input type='password' name='password' /><br />
			<input type='hidden' name='form' value='login' />
			<input type='submit' value='Login' />
			</form>
		      </div>";
		echo "<div id='registrationForm' style='display:none;s-index:10;position:absolute;top:30px;right:20px;background-color:white;'>
                        <form action='index.php' method='post'>
                        Username: <input type='text' name='username' /><br />
                        Password: <input type='password' name='password' /><br />
			Email: <input type='text' name='email' /><br />
			<input type='hidden' name='form' value='registration' />
                        <input type='submit' value='Register' />
                        </form>
                      </div>";
		echo "</td></tr></table>";
	}
	function handleProfileUpdate(){
		$email = mysql_real_escape_string($_POST['email']);
		$assets = mysql_real_escape_string($_POST['assets']);

		Query("update Users set Email=\"$email\", Assets=\"$assets\" where id='{$_SESSION['userID']}';");
	}
	function handleRegistration(){
		$username = mysql_real_escape_string($_POST['username']);
		$password = md5($_POST['password']);
		$email = mysql_real_escape_string($_POST['email']);

		$query = Query("select * from Users where Username=\"$username\";");
		if(mysql_num_rows($query) > 0){
			echo "<span style='color:red'>This username is already taken.</span>";
			return false;
		}else{
			Query("insert into Users (Username,Password,Email,Registered,LastLogin) values (\"$username\",\"$password\",\"$email\",unix_timestamp(),0);");
			$this->handleLogin();
		}
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
			Query("update Users set LastLogin=unix_timestamp() where id = {$row['id']};");
		}
	}
}

?>
