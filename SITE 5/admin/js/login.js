/*
	Desenvolvido por Ramon Costa
	www.atualstudio.com
*/
	
function tentarLogar() {
	var form_pass = $('#form_pass').val();
	var form_url = $('#form_url').val();
	if(form_pass.length == 0) {
		alert('Insira pelo menos 1 caractere!');
	} else {
		$.post('engine/login.php', { form_pass: form_pass }, function(resposta) {
			if(resposta == '1') {
				if(form_url.length == 0) {
					document.location.replace('./');
				} else {
					document.location.replace('http://'+decodeURIComponent(form_url));
				}
			} else {
				alert('Senha incorreta!');
				$('#form_pass').val('').attr('placeholder', 'Tente novamente').focus();
			}
		});
	}
	
}

$(document).ready(function(){
	
	$('#form_pass').keypress(function(e) {
		if(e.which == 13) {
			tentarLogar();
		}
	});
	
	$('#form_submit').click(function(){
		tentarLogar();
	});
	
});