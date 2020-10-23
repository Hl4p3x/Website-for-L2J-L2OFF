$(document).ready(function(){
	
	closeModal = function() {
		if($("#modal:visible, #backblack:visible, #alerta:visible").length > 0) {
			$("#modal, #backblack, #alerta").fadeOut('fast', function(){
				$("#modal, #backblack, #alerta").finish().remove();
			});
		}
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
		var l11016 = $('#l11016').val();
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
					
					if(data.debit != 0) {
						var saldo = $('.saldo .total span > span').text();
						$('.saldo .total span > span').text(parseInt(saldo-data.debit));
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
				        atualAlert(l11015+' #1');
			    	} else if(textStatus != 'abort') {
				        atualAlert(l11016+' #2');
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
	
	$('.mult .selec > div').click(function(){
		var charid = $(this).attr('data-id');
		var charname = $(this).children('div').text();
		if($(this).attr('data-hero') != undefined) { var hero = $(this).attr('data-hero'); } else { var hero = 0; }
		if($(this).attr('data-vip') != undefined) { var vip = $(this).attr('data-vip'); } else { var vip = 0; }
		$('.mult .infos').removeClass('actived');
		$('.mult .infos[data-id="'+charid+'"]').addClass('actived');
		$('.mult .selec > div').removeClass('actived');
		$('.mult .selec > div[data-id="'+charid+'"]').addClass('actived');
		$('.charSelected').val(charid);
		$('.charSelectedTxt b, .confirmChar b').text(charname);
		$('.atualEnd').addClass('invis');
		if(hero != 0) {
			var l39055 = $('input#l39055').val();
			$('.charHeroEnd').removeClass('invis').html(l39055+'<b>'+hero+'</b>.');
		}
		if(vip != 0) {
			var l39056 = $('input#l39056').val();
			$('.charVipEnd').removeClass('invis').html(l39056+'<b>'+vip+'</b>.');
		}
	});
	
	$('nav > span.actived > span').addClass('dropped');
	
	$('nav > a, nav > span > span').click(function(){
		if($(this).prop("tagName") == 'A') {
			$('nav span .dropdown:visible').toggle('medium');
			$('nav .dropped').removeClass('dropped');
		} else {
			if(!$(this).hasClass('dropped')) {
				$('nav span .dropdown:visible').toggle('medium');
				$('nav .dropped').removeClass('dropped');
				$(this).parent().children('.dropdown').toggle('medium');
				$(this).addClass('dropped');
			} else {
				$('nav span .dropdown:visible').toggle('medium');
				$('nav .dropped').removeClass('dropped');
			}
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
