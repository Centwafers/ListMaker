<?php	

	function test_input($data) 
	{
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = stripslashes($data);
		return $data;
	}
	
	function test_md5($data)
	{
		define('R_MD5_MATCH', '/^[a-f0-9]{32}$/i');
		
		return preg_match(R_MD5_MATCH, $data);
	}
	
?>
