/*
*    Script:    Mascaras em Javascript
*    Autor:    Matheus Biagini de Lima Dias
*    Data:    26/08/2008
*    Obs:    
*/
    /*Função Pai de Mascaras*/
    function mask(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmask()",1)
    }
    
    /*Função que Executa os objetos*/
    function execmask(){
        v_obj.value=v_fun(v_obj.value)
    }
function fdata(valor){
	valor=valor.replace(/\D/g,"")
	valor=valor.replace(/(\d{2})(\d)/,"$1/$2")
	valor=valor.replace(/(\d{2})(\d)/,"$1/$2")
	return valor;
}

function fhora(valor){
	valor=valor.replace(/\D/g,"")
	valor=valor.replace(/(\d{2})(\d)/,"$1:$2")
	return valor;
}