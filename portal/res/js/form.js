var errorBorder = "1px solid #F00";
var defaultBorder = "1px solid #CCC";

$("input").click(function (event) {
    $(this).css("border", defaultBorder);
});

$(".delete").click(function (event) {
    if(!confirm("Deseja remover "+$(this).attr("data")+"?")){
        event.preventDefault();
    };
});

$("#cpf").mask("999.999.999-99");
$("#nascimento").mask("99/99/9999");
$('#preco').bind('keypress',maskMoney.real);
$('#preco').bind('keyup',maskMoney.real);

function validarCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;   
    strCPF = strCPF.split(".").join("").replace("-", "");
    if(strCPF.length !== 11)
        return false;
    if (strCPF === "00000000000")
	return false;
    for (i=1; i<=9; i++)
	Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i); 
    Resto = (Soma * 10) % 11;
    if ((Resto === 10) || (Resto === 11)) 
	Resto = 0;
    if (Resto !== parseInt(strCPF.substring(9, 10)) )
	return false;
	Soma = 0;
    for (i = 1; i <= 10; i++)
       Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto === 10) || (Resto === 11)) 
	Resto = 0;
    if (Resto !== parseInt(strCPF.substring(10, 11) ) )
        return false;
    return true;
}

function isEmail(email){
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return filter.test(email);
}

function validarMoeda(v){
    v = v.replace("R$ ","");
    return v - parseFloat(v) >= 0;
}

$("#form-usuario").submit(function (event) {
    var submit = true;
    var inputName = $("#nome");
    var inputPswd = $("#senha");
    if (inputName.val().length < 3) {
        submit = false;
        inputName.css("border", errorBorder);
    }
    if (inputPswd.val().length < 6) {
        submit = false;
        inputPswd.css("border", errorBorder);
    }
    if (!submit) {
        alert("Por favor, verifique os campos em vermelho");
        event.preventDefault();
    }
});

$("#form-cliente").submit(function (event) {
    var submit = true;
    var inputName = $("#nome");
    var inputCPF = $("#cpf");
    var inputBirthday = $("#nascimento");
    var inputEmail = $("#email");
    var inputPswd = $("#senha");
    
    if(inputName.val().length < 3){
        submit = false;
        inputName.css("border", errorBorder);
    }
    if(!validarCPF(inputCPF.val())){
        submit = false;
        inputCPF.css("border", errorBorder);
    }
    if(inputBirthday.val().length !== 10){
        submit = false;
        inputBirthday.css("border", errorBorder);
    }
    if(!isEmail(inputEmail.val())){
        submit = false;
        inputEmail.css("border", errorBorder);
    }
    if(inputPswd.val().length < 6){
        submit = false;
        inputPswd.css("border", errorBorder);
    }
    if (!submit) {
        alert("Por favor, verifique os campos em vermelho");
        event.preventDefault();
    }
});

$("#form-pacote").submit(function (event) {
    var submit = true;
    var inputName = $("#nome");
    var inputDescription = $("#descricao");
    var inputPrice = $("#preco");
    
    if(inputName.val().length < 3){
        submit = false;
        inputName.css("border", errorBorder);
    }
    if(inputDescription.val().length < 10){
        submit = false;
        inputDescription.css("border", errorBorder);
    }
    if(!validarMoeda(inputPrice.val())){
        submit = false;
        inputPrice.css("border", errorBorder);
    }
    if (!submit) {
        alert("Por favor, verifique os campos em vermelho");
        event.preventDefault();
    }
});

$("#form-login").submit(function (event) {
    
    var submit = true;
    var inputLogin = $("#login");
    var inputPswd = $("#senha");
    
    if (inputLogin.val().length < 3) {
        submit = false;
        inputLogin.css("border", errorBorder);
    }
    if (inputPswd.val().length < 6) {
        submit = false;
        inputPswd.css("border", errorBorder);
    }
    if (!submit) {
        alert("Por favor, verifique os campos em vermelho");
        event.preventDefault();
    }
});