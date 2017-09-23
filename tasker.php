<?php
if(isset($_SERVER["REMOTE_ADDR"]))
{
	header("Location: ".base_url());
}

require dirname(__FILE__) . "/index.php";