$(document).ready(function(){
	iniciar();
	
});
	 
function iniciar(){
		$('.numeric').numeric({negative : false});
//	dibujarRuleta();		
	$("#btnBuscar").click(buscarNum);
	$("#btnGirar").click(Girar);
	$("#btnRegistrar").click(altaPaciente)
}

var idPaciente, promociones=[];

function buscarNum(){
	$("#btnBuscar").hide();
	var tel = $("#txtNumero").val();
	if(tel == ""){
		mostrarMsjError("Debe ingresar su n&uacute;mero!");
		$("#btnBuscar").show();
		return ;
	}
     $.ajax(
      {
      	method:"post",
		url: "adminFunciones.php",  					
		data: 
		{  numTel: tel						
		},
		success: function(data) {
  			respuesta=JSON.parse(data);
			if(respuesta[0]==true){
				$("#divNuevo").hide();
		  		idPaciente=respuesta[1];
				consultaCodigos();
				$("#spNombre").html(respuesta[2]);
				var x=1,texto="";
				$.each(respuesta[3], function (id,nombre) {
            		texto+="<tr><td>"+x+"</td><td>"+nombre+"</td></tr>";
					promociones[x-1]=nombre;
					x++;
				});
				$("#tbRuleta").html(texto);
				$(".divRuleta").show();
				$("#divInicial").hide();
				dibujarRuleta();
				$('html,body').animate({
				    scrollTop: $("#tbRuleta").offset().top
				}, 2000);
				
			}else{
		$("#divNuevo").show();
		$("#btnBuscar").show();
			}
		}
	    });
}
var top;
function obtenerSucursales(){
	 $.ajax({
				method : "post",
				url : "adminFunciones.php",
				data : {
					sucursalesRuleta:$( "#slcFranquicia" ).val()
				},
				success : function(data) {
					respuesta=JSON.parse(data);
					$( "#slcSucursal" ).html(respuesta);
				}
			});
		
}

function altaPaciente(){
	var existeError = false;
	var datos={},paciente={},hoja={};
	
	 paciente['Nombre']= $("#txtNombre").val().trim();
	if (paciente['Nombre'] == "") {
		existeError = true;
		console.log("Error: txtNombre");
	}

	paciente['Apellidos']= $("#txtApellidos").val().trim();
	if (paciente['Apellidos'] == "") {
		console.log("Error: txtApellido");
	}
	
	
	paciente['sexo'] = '';
    $("input[name=sexo]").each(function (index) { 
       if($(this).is(':checked')){
    	   paciente['sexo'] = $(this).val();
       }
    });
    
    if (paciente['sexo'] == "") {
		existeError = true;
		console.log("Error: txt");
	}
    
    paciente['franquicia']= $("#slcFranquicia").val().trim();
    if ( paciente['franquicia'] == "") {
		existeError = true;
		console.log("Error: franquicia");
	}
	paciente['sucursal']= $("#slcSucursal").val().trim();
    if ( paciente['sucursal'] == "") {
		existeError = true;
		console.log("Error: sucursal");
	}

    
	paciente['medio'] = '';
    $("input[name=medio]").each(function (index) { 
       if($(this).is(':checked')){
    	   paciente['medio'] = $(this).val();
       }
    });
    
    if (paciente['medio'] == "") {
		existeError = true;
		console.log("Error: txt");
	}
    
paciente['Email']= $("#txtCorreo").val().trim();
	if (paciente['Email'] == "") {
		//existeError2 = true;
		console.log("Error: txtEmail");
	}else{
		if(!validarEmail(paciente['Email'])){
			mostrarMsjError('El formato del correo electr&oacute;nico es incorrecto ',3);
			return false;
		}
	}

	paciente['txtNumero']= $("#txtNumero").val().trim();
	if (paciente['txtNumero'] != "") {
		if (paciente['txtNumero'].length<10) {
			mostrarMsjError('El n&uacute;mero telef&oacute;nico es incorrecto ',3);
			return false;
		}
	}else{
		existeError = true;
		
	}

	paciente['fechaNac']="1900-01-01"
		
	hoja['completitud']=0;
	datos['paciente']=paciente;
	datos['hojaclinica']=hoja;
		
	if(existeError){
		mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaci&oacute;n que se solicita',5);
		return false;
	}

	mostrarMsjEspera('Espere un momento... guardando informaci&oacute;n.', 3);
	
	$("#divRegistrar").hide();
	xajax_guardar(JSON.stringify(datos));
}

function validarEmail(email) {
	  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
	}


var options = ["Opción 1", "Opción 2", "Opción 3", "Opción 4", "Opción 5",
				"Opción 6", "Opción 7", "Opción 8", "Opción 9", "Opción 10"];

// Initialize Variables
var inicioAngulo = 0;
var tiemoutGirar = null;
var optRuleta;
var GirarArcStart = 10;
var GirarTime = 0;
var GirarTimeTotal = 0;
var arc = Math.PI / (options.length / 2);

function consultaCodigos(){
	let top = $("#hdTop").val();
	console.log("---"+$("#hdTop").val());
	 $.ajax(
		      {
      			method:"post",
				url: "adminFunciones.php",  					
				data: 
				{ idPacienteRuleta:idPaciente
				},
				success: function(data) {
  					respuesta2=JSON.parse(data);
					$("#divCodigos").html('');
					$.each(respuesta2[1], function (codigo,nombre) {
            			$("#divCodigos").append('<div class="4u 12u$(xsmall)"><label style="float: left">'+codigo+'&emsp;</label> ('+nombre+')</div>');
					});
				$("#spCodigo").html(respuesta2[0]);
				$("#spOportunidades").html(Number(top)-(parseInt(respuesta2[0])));
				if(parseInt(respuesta2[0])>=Number(top))
					$("#btnGirar").hide();
				}
		    });
			
}

function asignaCodigoNuevo(codigo){
	$("#hdCodigo").val(codigo);
}

function byte2Hex(n) {
  var nybHexString = "0123456789ABCDEF";
  return String(nybHexString.substr((n >> 4) & 0x0F,1)) + nybHexString.substr(n & 0x0F,1);
}

// Funci�n para RGB.
function RGB2Color(r,g,b) {
	return '#' + byte2Hex(r) + byte2Hex(g) + byte2Hex(b);
}

// Obtenemos los colores, determinando el RGB.
function getColor2RGB(item, maxitem) {
  var fase = 0;
  var centrar = 168;
  var width = 70;
  var frecuencia = Math.PI*2/maxitem;

// R G B.
  red   = Math.sin(frecuencia*item+2+fase) * width + centrar;
  green = Math.sin(frecuencia*item+0+fase) * width + centrar;
  blue  = Math.sin(frecuencia*item+4+fase) * width + centrar;

  return RGB2Color(red,green,blue);
}

// Dibujamos la ruleta.
function dibujarRuleta() {
  // Obtenemos el canvas desde el Id Canvas.
  var canvas = document.getElementById("canvas");

  if (canvas.getContext) {
    var outsideRadius = 250;
    var textRadius = 160;
    var insideRadius = 125;
    optRuleta = canvas.getContext("2d");
    optRuleta.clearRect(0,0,500,500);
    optRuleta.strokeStyle = "white";
    optRuleta.lineWidth = 2;
    optRuleta.font = '14px Verdana, Arial';
    for(var i = 0; i < options.length; i++) {
      var angle = inicioAngulo + i * arc;
      optRuleta.fillStyle = getColor2RGB(i, options.length);
      optRuleta.beginPath();
      optRuleta.arc(250, 250, outsideRadius, angle, angle + arc, false);
      optRuleta.arc(250, 250, insideRadius, angle + arc, angle, true);
      optRuleta.stroke();
      optRuleta.fill();
      optRuleta.save();
      optRuleta.shadowOffsetX = -1;
      optRuleta.shadowOffsetY = -1;
      optRuleta.shadowBlur = 0;
      optRuleta.shadowColor = "rgb(220,110,220)";
      optRuleta.fillStyle = "black";
      optRuleta.translate(250 + Math.cos(angle + arc / 2) * textRadius,
                    250 + Math.sin(angle + arc / 2) * textRadius);
      optRuleta.rotate(angle + arc / 2 + Math.PI / 2);
      var text = options[i];
      optRuleta.fillText(text, - optRuleta.measureText(text).width / 2, 0);
      optRuleta.restore();
    }

    // Flecha, color y "movimiento".
    optRuleta.fillStyle = "red";
    optRuleta.beginPath();
    optRuleta.moveTo(250 - 4, 250 - (outsideRadius + 5));
    optRuleta.lineTo(250 + 4, 250 - (outsideRadius + 5));
    optRuleta.lineTo(250 + 4, 250 - (outsideRadius - 5));
    optRuleta.lineTo(250 + 9, 250 - (outsideRadius - 5));
    optRuleta.lineTo(250 + 0, 250 - (outsideRadius - 13));
    optRuleta.lineTo(250 - 9, 250 - (outsideRadius - 5));
    optRuleta.lineTo(250 - 4, 250 - (outsideRadius - 5));
    optRuleta.lineTo(250 - 4, 250 - (outsideRadius + 5));
    optRuleta.fill();
  }
}

function Girar() {
	$("#btnGirar").hide();
	
  GirarAngleStart = Math.random() * 10 + 10;
  GirarTime = 0;
  GirarTimeTotal = Math.random() * 3 + 4 * 1500;
  rotarRuleta();
}

// Funci�n que realiza el giro de la ruleta.
function rotarRuleta() {
  GirarTime =  GirarTime + 30;
  if(GirarTime >= GirarTimeTotal) {
    detenerRotacionRuleta();
    return;
  }
  var GirarAngle = GirarAngleStart - mathOperations(GirarTime, 0, GirarAngleStart, GirarTimeTotal);
  inicioAngulo += (GirarAngle * Math.PI / 180);
  dibujarRuleta();
  tiemoutGirar = setTimeout('rotarRuleta()', 30);
}

// Detener la ruleta.
function detenerRotacionRuleta() {
  clearTimeout(tiemoutGirar);
  var degrees = inicioAngulo * 180 / Math.PI + 90;
  var arcd = arc * 180 / Math.PI;
  var index = Math.floor((360 - degrees % 360) / arcd);
  optRuleta.save();
  optRuleta.font = 'bold 20px Verdana, Arial';
  var text = promociones[index];
//  optRuleta.fillText(text, 250 - optRuleta.measureText(text).width / 2, 250 + 10);
	$("#canvas").hide();
	$("#hPremio").html(text);
	$("#spCod").html($("#hdCodigo").val());
	$(".premio").show();
	caeConfeti();
	
	
 setTimeout(function(){ 
	particles.destroy();
	$("#canvas").show();
	$("#btnGirar").show();
	$(".premio").hide();
	$('html,body').animate({
		 scrollTop: $("#divInfo").offset().top
	}, 1000);
	
	xajax_agregaCodigo(idPaciente,text,$("#hdCodigo").val()	);		
	}, 8000);
}

function mathOperations(GirarTime, b, GirarAngleStart, GirarTimeTotal) {
  var ts = (GirarTime/=GirarTimeTotal)*GirarTime;
  var tc = ts*GirarTime;
  return b+GirarAngleStart*(tc + -3*ts + 3*GirarTime);
}

function caeConfeti(){
	tsParticles.load("tsparticles", {
  fullScreen: {
    enable: true,
    zIndex: -1
  },
  particles: {
    color: {
      value: ["#1E00FF", "#FF0061", "#E1FF00", "#00FF9E"],
      animation: {
        enable: true,
        speed: 30
      }
    },
    move: {
      direction: "bottom",
      enable: true,
      outModes: {
        default: "out"
      },
      size: true,
      speed: {
        min: 1,
        max: 3
      }
    },
    number: {
      value: 700,
      density: {
        enable: true,
        area: 800
      }
    },
    opacity: {
      value: 1,
      animation: {
        enable: false,
        startValue: "max",
        destroy: "min",
        speed: 0.3,
        sync: true
      }
    },
    rotate: {
      value: {
        min: 0,
        max: 360
      },
      direction: "random",
      move: true,
      animation: {
        enable: true,
        speed: 60
      }
    },
    tilt: {
      direction: "random",
      enable: true,
      move: true,
      value: {
        min: 0,
        max: 360
      },
      animation: {
        enable: true,
        speed: 60
      }
    },
    shape: {
      type: ["circle", "square", "polygon"],
      options: {
        polygon: [
          {
            sides: 5
          },
          {
            sides: 6
          }
        ]
      }
    },
    size: {
      value: {
        min: 3,
        max: 5
      }
    },
    roll: {
      darken: {
        enable: true,
        value: 30
      },
      enlighten: {
        enable: true,
        value: 30
      },
      enable: true,
      speed: {
        min: 15,
        max: 25
      }
    },
    wobble: {
      distance: 30,
      enable: true,
      move: true,
      speed: {
        min: -15,
        max: 15
      }
    }
  }
});
particles = tsParticles.domItem(0);
}