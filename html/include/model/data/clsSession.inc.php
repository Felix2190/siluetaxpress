<?php
class clsSession 
{
	#-----------------------------------------------------------------------------------------------#
	#-------------------------------------------Variables-------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	private $user_name;
	private $email;
	private $userName;
	private $idRol;
	private $nombre;
	private $idSucursal;
	private $idUsuario;
	private $apellidos;
	private $correo;
	private $sucursal;
	private $tipoUsuario;
	private $lugar;
	private $abrev;
	
	
	
	public $_lastTime;
	public $_lastTimeSoporte;


	public $_ejecucionPendiente=array();

	private $_data=array();

	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------#
	#--------------------------------------------Control--------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	var $__s=array(	"userName",	"idUsuario","nombre","apellidos","tipoUsuario","sucursal","lugar","correo","idRol", "idSucursal","abrev");

	public function __construct()
	{

	}


	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	#-----------------------------------------------------------------------------------------------#
	#----------------------------------------Setter Getter------------------------------------------#
	#-----------------------------------------------------------------------------------------------#

	public function setData($k,$v)
	{
		$this->_data[$k]=$v;
	}

	public function getData($k)
	{
		return $this->_data[$k];
	}

	public function getUserName()
	{
		return $this->userName;
	}

	public function getCorreo()
	{
		return $this->correo;
	}
	
	public function getNombre()
	{
	    return $this->nombre;
	}
	
	public function getApellidos()
	{
	    return $this->apellidos;
	}
	
	public function getidUsuario()
	{
	    return $this->idUsuario;
	}
	
	public function getSucursal()
	{
	    return $this->sucursal;
	}
	
	public function getIdSucursal()
	{
	    return $this->idSucursal;
	}
	
	public function getLugar()
	{
	    return $this->lugar;
	}
		
	public function getTipoUsuario()
	{
	    return $this->tipoUsuario;
	}
	
	public function getidRol()
	{
	    return $this->idRol;
	}

	public function getAbrev()
	{
	    return $this->abrev;
	}
	
	public function isSessionActive()
	{
		return time()-$this->_lastTime<defined("SESSION_TIME")?SESSION_TIME:1800;
	}

	public function updateTime()
	{
		$this->_lastTime=time();
	}

	public function setObjetoGetInfo($oGI)
	{

		foreach($oGI as $k=>$v)
		{
			if(in_array($k, $this->__s))
			{
				$this->$k=$v;
			}
		}

	}


	public function resetError()
	{
		$this->error=false;
		$this->strError="";
	}


	
	public function setSucursal($sucursal)
	{
	    $this->sucursal=$sucursal;
	}
	public function setIdSucursal($idSucursal)
	{
	    $this->idSucursal=$idSucursal;
	}
	public function setLugar($lugar)
	{
	    $this->lugar=$lugar;
	}
	#-----------------------------------------------------------------------------------------------#
	#-----------------------------------------------------------------------------------------------#
} ?>