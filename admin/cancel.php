		<?php
		include("../db/dbconn.php");

		$t_id = $_GET['id'];

		mysqli_query($conn, "UPDATE transaction SET order_stat = 'Cancelled' WHERE transaction_id = '$t_id'");

		header("location: transaction.php");

		?>