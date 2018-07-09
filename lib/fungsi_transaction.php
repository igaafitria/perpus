<?php
	function start_transaction()
	{
		$koneksi->query("START TRANSACTION");
	}

	function commit()
	{
		$koneksi->query("COMMIT");
	}

	function rollback()
	{
		$koneksi->query("ROLLBACK");
	}


?>