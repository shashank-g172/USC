<!DOCTYPE html>
<html>
 <head>
        <meta http-equiv="refresh" content="3;url=../index.php" />
    </head>
    <body>
    <?php 
		require_once('connection.php');
		define('ROOT_DIR', '../');
		require_once(ROOT_DIR . 'Pages/ProfilePage.php');

		$page =  new ProfilePage();
		$page->Display('globalheader.tpl');
    
        echo '<h1 style = "text-align:center;">Registeration successful. You will be automatically redirected.</h1>';
	    $page->Display('globalfooter.tpl');
	 ?>
    </body>
</html>