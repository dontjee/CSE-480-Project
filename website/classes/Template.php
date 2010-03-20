<?php
/*
Template class to allow for easy html templating
*/
class Template{
	
	public $title = "";
	
	public $css = Array();
	public $js = Array();
	
	//Include the specified CSS file.
	public function CSS($src){
		array_push($this->css, $src);
	}
	
	//Include the specified Javascript file.
	public function JS($src){
		array_push($this->js, $src);
	}
	
	//Include the specified CSS and Javascript file.
	public function CSS_JS($src){
		Template::CSS($src);
		Template::JS($src);
	}
	
	//Set the title of the page
	public function Title($title){
		$this->title = $title;
	}
	
	//Writes the HTML for the header onto the page using the options specified
	public function Header(){
	
		$menu_xml = simplexml_load_file("Menu.xml");

		global $Auth, $CurrentUser;
		
		//Decide which tabs to grab from the XML menu
		$tabs = $menu_xml->none;
		if($Auth->LoggedIn()){
			switch($CurrentUser->type){
				case User::$EMPLOYEE:
					$tabs = $menu_xml->employee;
					break;
				case User::$EMPLOYER:
					$tabs = $menu_xml->employer;
					break;
				case User::$ADMIN:
					$tabs = $menu_xml->admin;
					break;
			}
		}
		
		?>

		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
		 "http://www.w3.org/TR/html4/strict.dtd">
		<html>
			<head>
			
				<title><?php echo $this->title; ?></title>
			
				<!-- YUI CSS Reset -->
				<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/reset/reset-min.css">
			
				<!-- Stylesheets -->
				<link rel="stylesheet" type="text/css" href="css/main.css">
				<?php foreach ($this->css as $css)
					echo "<link rel='stylesheet' type='text/css' href='css/{$css}.css'>";
				?>
				
				<!-- Scripts -->
				<script type="text/javascript" src="js/jquery.js"></script>
				<script type="text/javascript" src="js/main.js"></script>
				<?php foreach ($this->js as $js)
					echo "<script type='text/javascript' src='js/{$js}.js'></script>";
				?>
				
			</head>
			<body>

				<!-- Header -->
				<div id="hd_frame">
					<div id="hd">
						<div id="login">
						<?php
							if($Auth->LoggedIn()){
								?>
								<span id="name">Logged in as <?php echo $CurrentUser->loginID;?></span>
								<a href="logout_action.php" id="action">Logout</span>	
								<?php
							}else{
								?>
								<a href="login.php" id="action">Login</span>	
								<?php
							}
						?>
						</div>
					</div>
				</div>
				
				<!-- Body -->
				<div id="main">
					
					<!-- Navigation bar -->
					<ul id="nav">
						<?php
							$path = $_SERVER['PHP_SELF'];
							
							foreach ($tabs->tab as $tab) {
								$src = (string)$tab->attributes()->src;
								
								$id = "";
								if(strripos($path, $src) ==  (strlen($path) - strlen($src))){
									$id = "selected";
								}
								
								echo "	<li id='{$id}'>
											<a href='{$src}'>
												$tab
											</a>
										</li>";
							}
						?>
					</ul>
					
					<div id="bd">
		<?php
	}
	
	//Writes the HTML for the footer onto the page
	public function Footer(){
		?>
					</div>
									
					<!-- Footer -->
					<div id="ft">
					</div>
				
				</div>
				
			</body>
		</html>
		<?php
	
	}
	
}