$(document).ready(function(){
	
	closeModal = function(instant) {
		if($("#modal:visible, #backblack:visible, #alerta:visible").length > 0) {
			if(instant == '1') {
				$("#modal, #backblack, #alerta").finish().remove();
			} else {
				$("#modal, #backblack, #alerta").fadeOut('fast', function(){
					$("#modal, #backblack, #alerta").finish().remove();
				});
			}
		}
	};
	
	opencaptcha = function() {
		var l11017 = $('#l11017').val();
		var l11018 = $('#l11018').val();
		var newCode = Math.random();
		$('.captchaImage').attr('src', 'captcha/securimage_show.php?sid='+newCode+'');
		$('body').append("<div id='backblack'></div><div id='modal' style='display:none;'><h1>Captcha &bullet; "+l11017+"</h1>"+l11018+"<br /><br /><label class='formpadrao captcha'><div><div class='desc'><img style='margin:5px 0 0 0;' class='captchaImage' src='captcha/securimage_show.php?sid="+newCode+"' /></div><div class='camp'><input type='text' id='captchaInput' maxlength='5' name='captcha' autocomplete='off' /></div><a tabindex='-1' href='#'><img src='captcha/refresh.png' /></a></div></label><input style='margin: 20px auto; display: table;' type='submit' class='default dbig' value='Continue' onclick='logucp();' /></div>");
		$('#modal').fadeIn('fast', function() { $('#modal input#captchaInput').focus(); });
	};
	
	logucp = function() {
		var ucp_captcha_send = $('#modal input#captchaInput').val();
		$('#ucp_captcha').val(ucp_captcha_send);
		$('form#login_form').submit();
	};
	
	$("body").on('click', '.captcha a', function() {
		$('.captchaImage').attr('src', 'captcha/securimage_show.php?sid='+Math.random()+'');
		$(this).parent().parent().find('#captchaInput').val('').focus();
		return false;
	});
	
	$("body").on('click', '#backblack', function() {
		if($('#alerta').length == 0) {
			closeModal();
		}
	});
	
	$('form#login_form').submit(function(e){
		e.preventDefault();
		closeModal(1);
		var l11015 = $('#l11015').val();
		var l12055 = $('#l12055').val();
		var l40044 = $('#l40044').val();
		$('form#login_form').css({ 'visibility': 'hidden' });
		$('.loginarea .error').remove();
		$('.loginarea').append('<div class="loader"></div>');
		$.ajax({
			type: 'POST',
			url: ''+$('form#login_form').attr('action')+'',
			cache: false,
			data: $('form#login_form').serialize()+'&isJS=1',
			dataType: 'json',
			timeout: 30000,
			async: false,
			success: function(data)
			{
				if(data.act == 'OK') {
					document.location.href=''+data.url+'';
				} else if(data.act == 'SESSION') {
					atualAlert(l40044, 'ERROR', data.url);
					return false;
				} else {
					$('.loginarea').prepend('<div class="error">'+data.msg+'</div>');
					$('form#login_form').css({ 'visibility': 'visible' });
					$('.loginarea .loader').remove();
				}
			},
		    error: function(jqXHR, textStatus){
		    	$(submitButton).removeClass('loading');
		    	if(textStatus == 'timeout') {
			        atualAlert(l11015+' #1');
		    	} else if(textStatus != 'abort') {
			        atualAlert(l12055+' #2');
			    }
		    }
		});
		
	});
	
	$('form#login_form input').keypress(function(e){
		if(e.keyCode == '13') {
			if($('form#login_form').find('input[type="submit"]').length == 0) {
				opencaptcha();
			} else {
				$('form#login_form').submit();
			}
		}
	});
	
	$('body').on('keypress', '#captchaInput', function(e){
		if(e.keyCode == '13') {
			logucp();
		}
	});
	
	$('body').on('click', '#alerta .ok > div', function(){
		var url = $(this).attr('data-url');
		if(url.length > 0 && url != undefined && url != 'undefined') {
			document.location.href=''+url+'';
		} else {
			closeModal();
		}
	});
	
	$('body').on('submit', 'form.usarJquery', function() {
		
		if($('#acceptrules').length > 0) {
			var l12004 = $('#l12004').val();
			if($('#acceptrules').prop('checked') != true) {
				atualAlert(l12004);
				return false;
			}
		}
		
		var theForm = $(this);
		var submitButton = $(this).find("input[type='submit']");
		var l11015 = $('#l11015').val();
		var l12055 = $('#l12055').val();
		var l20001 = $('#l20001').val();
		var l40044 = $('#l40044').val();
		
		if(!$(submitButton).hasClass('loading') && !$(submitButton).hasClass('sucesso')) {
			
			$(submitButton).attr('data-oldtext', ''+$(submitButton).val()+'').addClass('loading').val(l20001);
			
			$.ajax({
				type: 'POST',
				url: ''+$(theForm).attr('action')+'',
				cache: false,
				data: $(theForm).serialize()+'&isJS=1',
				dataType: 'json',
				timeout: 40000,
				async: false,
				success: function(data)
				{
					
					$(submitButton).val(''+$(submitButton).attr('data-oldtext')+'').removeClass('loading');
					
					$('.captchaImage').attr('src', './captcha/securimage_show.php?sid='+Math.random());
					$('input[name="captcha"]').val('');
					
					if(data.act == 'OK') {
						
						if($(theForm).hasClass('registerForm') && data.email != '' && data.login != '' && data.email != undefined && data.login != undefined) {
							document.location.replace('./?engine=download_account_txt&eConf='+data.email+'&lConf='+data.login);
						}
						
						$(submitButton).addClass('sucesso');
						$(theForm).addClass('sucedido');
						
					} else if(data.act == 'SESSION') {
						
						atualAlert(l40044, 'ERROR', data.url);
						return false;
						
					}
					
					if(data.url != '' && data.msg == '') {
						document.location.href=''+data.url+'';
						return;
					}
					
					atualAlert(data.msg, data.act, data.url);
					
				},
			    error: function(jqXHR, textStatus){
			    	$(submitButton).val(''+$(submitButton).attr('data-oldtext')+'').removeClass('loading');
			    	if(textStatus == 'timeout') {
				        atualAlert(l11015+' #3');
			    	} else if(textStatus != 'abort') {
				        atualAlert(l12055+' #4');
				    }
			    }
			});
			
		}
		
		return false;
		
	});
	
	$('body').on('change keydown', 'form.usarJquery.sucedido', function() {
		var submitButton = $(this).find("input[type='submit']");
		var theForm = $(this);
		if($(submitButton).hasClass('sucesso')) {
			$(submitButton).text(''+$(submitButton).attr('data-oldtext')+'').removeAttr('data-oldtext').removeClass('sucesso');
			$(theForm).removeClass('sucedido');
		}
	});
	
});

function atualAlert(texto, act, url) {
	$("#modal, #backblack, #alerta").remove();
	$('*:focus').blur();
	if(act == 'OK') { var aaClass = 'ok sucesso'; } else { var aaClass = 'ok'; }
	$('body').append("<div id='backblack'></div><div id='alerta'>"+texto+"<div class='"+aaClass+"'><div data-url='"+url+"'>Ok</div></div></div>");
	if($('#alerta').width() > 700) { $('#alerta').css({ 'width': '700px' }); }
	$('#alerta').css({ 'left': ''+(($(window).width()-($('#alerta').width()+60))/2)+'px', 'top': ''+(($(window).height()-($('#alerta').height()+50))/2)+'px', 'visibility': 'visible' });
}

