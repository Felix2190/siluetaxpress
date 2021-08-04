$(document).ready(function(){
	iniciar();
	
});
	 
function iniciar(){
	dibujarRuleta();
	$("#btnGirar").click(Girar);
}
/*
     $.ajax(
      {
      	method:"post",
					url: "adminFunciones.php",  					
					data: 
					{  						
					},
					
					success: function(data) 
					{
  					respuesta=JSON.parse(data);
					}
	    });

 
 */

var options = ["Opci贸n 1", "Opci贸n 2", "Opci贸n 3", "Opci贸n 4", "Opci贸n 5",
				"Opci贸n 1", "Opci贸n 2", "Opci贸n 3", "Opci贸n 4", "Opci贸n 5"];

// Initialize Variables
var inicioAngulo = 0;
var tiemoutGirar = null;
var optRuleta;
var GirarArcStart = 10;
var GirarTime = 0;
var GirarTimeTotal = 0;
var arc = Math.PI / (options.length / 2);


function byte2Hex(n) {
  var nybHexString = "0123456789ABCDEF";
  return String(nybHexString.substr((n >> 4) & 0x0F,1)) + nybHexString.substr(n & 0x0F,1);
}

// Funci髇 para RGB.
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
  GirarAngleStart = Math.random() * 10 + 10;
  GirarTime = 0;
  GirarTimeTotal = Math.random() * 3 + 4 * 1500;
  rotarRuleta();
}

// Funci髇 que realiza el giro de la ruleta.
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
  optRuleta.font = 'bold 30px Verdana, Arial';
  var text = options[index]
  optRuleta.fillText(text, 250 - optRuleta.measureText(text).width / 2, 250 + 10);
	caeConfeti();
var confettiElement = document.getElementById('confeti');

 setTimeout(function(){ 
particles.destroy();

	}, 3000);
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