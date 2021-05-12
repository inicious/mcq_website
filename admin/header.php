<Table width="100%">
	<tr>
		<td>
			<?php
			if(isset($_SESSION['login_id']))
			{
				echo "<div align=\"right\"><strong><a href=\"signout.php\">Signout</a></strong></div>";
	 		}
	 		else
	 		{
	 			echo "&nbsp;";
	 		}
			?>
		</td>
	</tr>
</table>
