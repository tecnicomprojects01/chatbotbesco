var script_tag = document.getElementById('API_CHATBOT_TECNICOM');

var query = script_tag.src.replace(/^[^\?]+\??/,''); 
var vars = query.split("&");
var args = {};
for (var i=0; i<vars.length; i++) {
    var pair = vars[i].split("=");
    args[pair[0]] = decodeURI(pair[1]).replace(/\+/g, ' ');   
}
var CLIENTE = '';
var API_KEY = args['key'];
console.log('event->caller');

document.addEventListener('DOMContentLoaded', function(e) {
    
  console.log('DOMContentLoaded');

  setTimeout(function(){ console.log('event->timeout'); loadAPI(API_KEY); }, 500);
  
}, true);

// 

function loadAPI(key){
	switch(key) {
		case 'L5437788':
		CLIENTE = 'besco';
		enterDiv('besco',key);
		break;
	 }
}

function enterDiv(cliente,key){

	if(cliente == 'besco'){

		var tmp = cliente.toUpperCase();

		var html = '<span id="minimize_c" onclick="document.getElementById(\'minimize_c\').style.display = \'none\';document.getElementById(\'CB_TCOM_'+tmp+'\').style.display = \'none\';document.getElementById(\'MIN_TCOM_'+tmp+'\').style.display = \'\';"><i style="padding: 0px 12px;border-bottom: white 4px solid;"></i></span>';

		html += '<audio id="audio" style="display:none" preload="none" controls><source type="audio/wav" src="https://chat.tecnicom.pe/public/frontend/notify/chat.wav"></audio>';
		
		html += '<iframe id="CB_TCOM_'+tmp+'" class="chat_frame" src="https://chat.tecnicom.pe/index.php/index?key='+key+'"></iframe>';
		
		html += '<div id="MIN_TCOM_'+tmp+'" onclick="document.getElementById(\'minimize_c\').style.display = \'\';document.getElementById(\'MIN_TCOM_'+tmp+'\').style.display = \'none\';document.getElementById(\'CB_TCOM_'+tmp+'\').style.display = \'\';" class="min_box_chat" style="display:none;"><p style=" margin-top: 13px;color: white;font-weight: bold;"><img src="https://chat.tecnicom.pe/public/frontend/img/asistente.png?v=1549323351" class="rounded-circle user_img" style="width: 34px; border-radius: 100%;border: white 1px solid;height: 33px; margin-left: 16px; margin-right: 6px;"> Continuar Chateando con Besco</p></div>';
		
		document.body.insertAdjacentHTML('afterend',html);

		var URL_CSS = "https://chat.tecnicom.pe/public/script/css/chat_frame.css";

  		addCSS(URL_CSS);

		console.log("empezar audioaaa");

		sessionStorage.setItem('sonar_audio', 0);

		var sonar_audio = sessionStorage.getItem('sonar_audio');

		console.log(sonar_audio);
		if(sonar_audio != 1){

			console.log("entro audio");

			var playPromise = document.getElementById("audio").play();

		  	if (playPromise !== undefined) {
		    	playPromise.then(_ => {
		      	// Automatic playback started!
		     	// Show playing UI.
		    	})
		    	.catch(error => {
		    		console.log(error);
		      	// Auto-play was prevented
		      	// Show paused UI.
		    	});
		  	}
		}
		
		//sessionStorage.setItem('sonar_audio', 1);
		
		console.log("terminar audio");
	}

}

function addCSS(filename){
 var head = document.getElementsByTagName('head')[0];

 var style = document.createElement('link');
 style.href = filename;
 style.type = 'text/css';
 style.rel = 'stylesheet';
 head.append(style);
}
