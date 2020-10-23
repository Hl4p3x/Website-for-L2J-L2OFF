$(function () {
	
	$('input#password').focus().val('');
	
	$('body.login .passArea').css({ 'padding-top': ''+(($(window).height()-160)/2)+'px', 'padding-bottom': ''+((($(window).height()-160)/2)-100)+'px' });
	
	login = function() {
		
		var submitButton = $('#submit');
		
		if(!$(submitButton).hasClass('invis')) {
			
			$(submitButton).addClass('invis');
			
			$.ajax({
				type: 'POST',
				url: './?login',
				cache: false,
				data: 'pass='+$('#password').val()+'&isJS=1',
				dataType: 'json',
				timeout: 10000,
				async: false,
				success: function(data)
				{
					
					if(data.act == 'OK') {
						document.location.href='./';
						return;
					} else {
						$(submitButton).removeClass('invis');
						atualAlert(data.msg, data.act, data.url);
					}
					
				},
			    error: function(jqXHR, textStatus){
			    	$(submitButton).removeClass('invis');
			    	if(textStatus == 'timeout') {
				        atualAlert('Por favor, verifique sua conexão com a internet. A página está demorando demais para responder.');
			    	} else if(textStatus != 'abort') {
				        atualAlert('Desculpe, ocorreu algum erro! Por favor, tente novamente. #2');
				    }
			    }
			});
			
		}
		
		return false;
	};
	
	$('input#password').keypress(function(e){
		if(e.keyCode == '13') {
			login();
		}
	});
	
	$('#submit').click(function() {
		login();
	});

	
	$('body').on('click', '#alerta .ok > div', function(){
		var url = $(this).attr('data-url');
		if(url.length > 0 && url != undefined && url != 'undefined') {
			document.location.href=''+url+'';
		} else {
			$("#backblack, #alerta").fadeOut('fast', function(){
				$("#backblack, #alerta").finish().remove();
			});
		}
		$('input#password').val('').focus();
	});
	
	
});

function atualAlert(texto, act='', url='') {
	$("#modal, #backblack, #alerta").remove();
	$('*:focus').blur();
	if(act == 'OK') { var aaClass = 'ok sucesso'; } else { var aaClass = 'ok'; }
	$('body').append("<div id='backblack'></div><div id='alerta'>"+texto+"<div class='"+aaClass+"'><div data-url='"+url+"'>Ok</div></div></div>");
	if($('#alerta').width() > 700) { $('#alerta').css({ 'width': '700px' }); }
	$('#alerta').css({ 'left': ''+(($(window).width()-($('#alerta').width()+60))/2)+'px', 'top': ''+(($(window).height()-($('#alerta').height()+50))/2)+'px', 'visibility': 'visible' });
}
