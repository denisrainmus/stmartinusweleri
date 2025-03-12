<?php
$server= 'localhost'; 
$user= 'u640147570_santomartinus';
$password= 'SantoMartinus119'; 
$database= 'u640147570_stmartinus';
$konek= mysqli_connect($server,$user,$password,$database);
if ($konek){
		echo "";
	}else
		{							
		echo "GAGAL KONEK KE DATABASE";
}
?>
