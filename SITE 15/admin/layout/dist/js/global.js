$(function () {
	
	$('#checkAll').change(function(){
		if($(this).prop('checked') == false) {
			$('input.checkAll').prop('checked', false);
		} else {
			$('input.checkAll').prop('checked', true);
		}
	});
	
	$('body').on('change', '#selectWorld select', function(){
		var world = $('#selectWorld select').val();
		document.location.replace('./?world='+world);
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
	});
	
	$('a.usarJquery').click(function(e) {
		
		e.preventDefault();
		
		var theHref = $(this).attr('href');
		var submitButton = $(this);
		
		if(!$(submitButton).hasClass('loading')) {
			
			$(submitButton).attr('data-oldtext', ''+$(submitButton).text()+'').addClass('loading').text('Aguarde...');
			
			$.ajax({
				type: 'POST',
				url: ''+theHref+'',
				cache: false,
				data: 'isJS=1',
				dataType: 'json',
				timeout: 40000,
				async: false,
				success: function(data)
				{
					
					$(submitButton).text(''+$(submitButton).attr('data-oldtext')+'').removeClass('loading');
					
					if(data.url != '' && data.msg == '') {
						document.location.href=''+data.url+'';
						return;
					}
					
					atualAlert(data.msg, data.act, data.url);
					
				},
			    error: function(jqXHR, textStatus){
			    	$(submitButton).text(''+$(submitButton).attr('data-oldtext')+'').removeClass('loading');
			    	if(textStatus == 'timeout') {
				        atualAlert('Por favor, verifique sua conexão com a internet. A página está demorando demais para responder.');
			    	} else if(textStatus != 'abort') {
				        atualAlert('Desculpe, ocorreu algum erro! Por favor, tente novamente. #2');
				    }
			    }
			});
			
		}
		
		return false;
		
	});
	
	$('body').on('submit', 'form.usarJquery', function() {
		
		var theForm = $(this);
		var submitButton = $(this).find("input[type='submit']");
		
		if(!$(submitButton).hasClass('loading') && !$(submitButton).hasClass('sucesso')) {
			
			$(submitButton).attr('data-oldtext', ''+$(submitButton).val()+'').addClass('loading').val('Aguarde...');
			
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
					
					if(data.act == 'OK') {
						
						$(submitButton).addClass('sucesso');
						$(theForm).addClass('sucedido');
						
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
				        atualAlert('Por favor, verifique sua conexão com a internet. A página está demorando demais para responder.');
			    	} else if(textStatus != 'abort') {
				        atualAlert('Desculpe, ocorreu algum erro! Por favor, tente novamente. #3');
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
	
	$('a.formExcluir').click(function(){
		$('form#formExcluir').submit();
	});
	
	sidebarEsconde = function() {
		if($('body').hasClass('sidebar-collapse')) {
			$('input[type="checkbox"][data-layout="sidebar-collapse"]').prop('checked', true);
			$.cookie('sidebarCollapse', '1', { path: '/', expires: 60 });
		} else {
			$('input[type="checkbox"][data-layout="sidebar-collapse"]').prop('checked', false);
			$.cookie('sidebarCollapse', '0', { path: '/', expires: 1 });
		}
	};
	
	$('.sidebar-toggle').click(function(){
		sidebarEsconde();
	});
	
	$('body').on('change', 'input[type="checkbox"][data-layout="sidebar-collapse"]', function(){
		sidebarEsconde();
	});
	
	$('body').on('change', 'input[type="checkbox"][data-layout="layout-boxed"]', function(){
		if($('body').hasClass('layout-boxed')) {
			$.cookie('layoutBoxed', '1', { path: '/', expires: 60 });
		} else {
			$.cookie('layoutBoxed', '0', { path: '/', expires: 1 });
		}
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