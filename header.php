
 
	<?php
	if(isset($_SESSION['login']))
	{ ?>
	 <table width="100%" border="0">
  	<tr>
    	<table align="center" border="0" WIDTH="50%" height="250">
			<h1 class="text-center bg-warning">Welcome <?php echo $_SESSION['login']; ?> !Best of luck</h1>		
    	</table>
  	</tr>
  </table>
	 <?php }
	 
	?>

