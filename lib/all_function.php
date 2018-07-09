<?php
	date_default_timezone_set('Asia/Jakarta');

	function anti_inject($data)
	{
		$filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
		return $filter_sql;
	}

	function selisih_tanggal($dt, $newdt)
	{
		include"koneksi.php";
		$lama = mysql_fetch_assoc(mysql_query("SELECT DATEDIFF('$dt', '$newdt') AS sel"));

		return $lama['sel'];
	}


?>