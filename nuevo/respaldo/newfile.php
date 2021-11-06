<?php
//DEFINE("BASE_INCLUDE",$_SERVER['DOCUMENT_ROOT'] . "planet/include/");
///require_once(BASE_INCLUDE . "conf/constantes.php");
///require LIB_CONEXION;
/*
$query = "SELECT idRegisterTmp,domainName,full_name,full_lastname,password from registertmp where idRegisterTmp >=192";
//	return $query;
$result = mysqli_query ( $dbLink, $query );
if ($result) {
	while (mysqli_num_rows ( $result ) >0 ) {
		$row=mysqli_fetch_assoc($result);
		$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$passwordSalt = hash('sha512', $row['domainName'].'2016'. $random_salt);
		
		$sql="INSERT INTO login_user values(null, ".$row['idRegisterTmp'].", '".$row['domainName']."', '".$passwordSalt."', '".$random_salt."', '".$row['full_name']."', '".$row['full_lastname']."',0)";
		if (mysqli_query ( $dbLink, $sql ))
			echo true;
		else 
			echo false;
	//	echo  $row['domainName'].'<br />';
	}
}
*/
$ar=array(array('LezlieGR ','LezlieGR2018',6),array('Lizet','Lizet2018',7),array('Rosailian','Rosailian2018',8)
//,array('Nelly ','Salas','atenciontelefonica02@planetucc.com')
//,array('Ulises ','Trinidad','ulises@planetucc.com')
/*,array('Mario Antonio ','Lanz L&oacute;pez','mario@planetucc.com')
,array('Luis Enrique ','Leyva Monta&ntilde;o','luis@planetucc.com')
,array('Alejandro ','Moreno Linares','alejandro@planetucc.com')
,array('Oscar ','Rivera Romo','oscar@planetucc.com')*/
);
$int=1;
//$ar=array('ricardo@planetucc.com_2017');
foreach ($ar as $v=>$u){
	srand($int);
$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
$passwordSalt = hash('sha512', $u[1]. $random_salt);
	$sql2="INSERT INTO `login`  
			VALUES (NULL, '$u[2]', '".$u[0]."', '".$passwordSalt."', '".$random_salt."', 2, 'activo'";
$int++;
	echo '<br /> <br />'.$sql2.'<br /> <br /> <br />';
}
echo srand(5);
echo rand();


/*
 INSERT INTO `registertmp` (`idRegisterTmp`, `full_name`, `full_lastname`, `empresaTxt`, `phone`, `idCountry`, `state`, `city`, `addressTxt`, 
 `cpTxt`, `sameDir`, `full_fiscalname`, `emailfiscal`, `phonefiscal`, `addressFiscalTxt`, `cpFiscalTxt`, `idCountryFiscal`, `stateFiscal`, 
 `cityFiscal`, `vatFiscal`, `domainName`, `password`, `crmLanguage`, `invoiceLanguage`, `idAmadeoOptions`, `nbrUsers`, `orderTotal`, `fechaAlta`,
  `estatusPago`, `proveedorPago`, `email`, `agentId`, `estatus`, `type`, `idAccount`) VALUES (NULL, 'Gilberto ', 'Hernández ', '', '', '0', '', '', '', '0', '0', 'Gilberto ', 'gilbertohernandez@sypi.com.mx', '', '', '0', '0', '', '', '', 'gilbertohernandez@sypi.com.mx','gilbertohernandez@sypi.com.mx_2017', '', '', '', '0', '0', NULL, 'pendiente', '', 'gilbertohernandez@sypi.com.mx', '22253', 'pendiente', 'trial', '');

INSERT INTO `login_user` (`id_login`, `id_usuario`, `user_name`, `password`, `salt`, `first_name`, `last_name`, `id_rol`,email) 
VALUES (NULL, '282', 'gilbertohernandez@sypi.com.mx', '1c6004ed60aa95236eb00d46a437ddafb4f01b6eb0f56ff87df00a19cde1cc6bf2b79ee54d3500483e4bb2c77fbd3d71a61c437dfa76a12c3d501d466971e02d', 
'e039969ca462fb30a1b274de92e9a0f1747a79167963cd6448d81c31ecf5f206e6aded3f120602080f3d779b23c02ec35f8424022c73885540b97fd86f3b99e6', 
'Gilberto ', 'Hernández ', '1', '   ');

 *
 * */?>