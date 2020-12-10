var $input = document.getElementById('input-file'),
    $fileName = document.getElementById('file-name');

$input.addEventListener('change', function () {
    $fileName.textContent = this.value;
});

usNome.addEventListener('input', function () {
    document.getElementById('retornoNome').innerHTML = 'Total de caracteres restantes: ' + (128 - usNome.value.length);
    if (usNome.value.length == 128) {
        document.getElementById('retornoNome').innerHTML = 'Ops, você chegou no limite :(';
        usNome.style.borderColor = 'orange';
    } else if (usNome.value.length != 0) {
        usNome.style.borderColor = 'green';
    } else {
        usNome.style.borderColor = '#ced4da';
    }
});

var usEmailValidado = 'n';
usEmail.addEventListener('input', function () {
    if (usEmail.value.indexOf('@') != -1) {
        if (usEmail.value.indexOf('.') != -1) {
            usEmail.style.borderColor = 'green';
            document.getElementById('retornoEmail').innerHTML = 'YEY! E-mail válido :D';
            usEmailValidado = 's';
        }
    } else {
        document.getElementById('retornoEmail').innerHTML = 'Digite um e-mail válido ;)';
        usEmail.style.borderColor = 'red';
    }
});

var cpfValidado = false;
usCpf.addEventListener('input', function () {
    document.getElementById('retornoCPF').innerHTML = 'Total de caracteres restantes: ' + (11 - usCpf.value.length);

    if (usCpf.value.length > usCpf.maxLength) usCpf.value = usCpf.value.slice(0, usCpf.maxLength);

    if (usCpf.value.length == 11) {
        document.getElementById('retornoCPF').innerHTML = 'Ops, você chegou no limite :(';
        usCpf.style.borderColor = 'orange';
    } else if (usCpf.value.length > 0 && usCpf.value.length < 11) {
        usCpf.style.borderColor = 'green';
    } else if (usCpf.value.length == 0) {
        usCpf.style.borderColor = '#ced4da';
        document.getElementById('retornoCPF').innerHTML = 'Total de caracteres restantes: 11';
    } else {
        document.getElementById('retornoCPF').innerHTML = 'Ops, você excedeu o limite >:(';
        usCpf.style.borderColor = 'red';
    }
    if (usCpf.value == 00000000000 ||
        usCpf.value == 11111111111 ||
        usCpf.value == 22222222222 ||
        usCpf.value == 33333333333 ||
        usCpf.value == 44444444444 ||
        usCpf.value == 55555555555 ||
        usCpf.value == 66666666666 ||
        usCpf.value == 77777777777 ||
        usCpf.value == 88888888888 ||
        usCpf.value == 99999999999) {
        document.getElementById('retornoCPF').innerHTML = 'Por favor, digite um CPF válido ;)';
        usCpf.style.borderColor = 'red';
    } else {
        if (usCpf.value.length == 11) {
            let arrayCPF = usCpf.value.split('');
            let total1 = 0;
            let total2 = 0;
            let resto1Div = 0;
            let resto2Div = 0;

            if (arrayCPF[9] == 0 && arrayCPF[10] == 0) {
                document.getElementById('retornoCPF').innerHTML = 'Por favor, digite um CPF válido ;)';
                usCpf.style.borderColor = 'red';
            } else {
                for (let i = 0; i < 9; i++) {
                    total1 = total1 + (arrayCPF[i] * (10 - i));
                }

                parseInt(resto1Div = (total1 * 10) % 11);

                if (resto1Div == 10 || resto1Div == 11) {
                    resto1Div = 0;
                }

                if (resto1Div == Number(arrayCPF[9])) {
                    for (let x = 0; x < 10; x++) {
                        total2Ant = total2;
                        total2 = total2 + (arrayCPF[x] * (11 - x));
                        // console.log(total2Ant + '+' + arrayCPF[x] + '*' + (11 - x) + '=' + total2);
                    }

                    resto2Div = (total2 * 10) % 11;

                    if (resto2Div == 10 || resto2Div == 11) {
                        resto2Div = 0;
                    }

                    if (resto2Div == Number(arrayCPF[10])) {
                        document.getElementById('retornoCPF').innerHTML = 'YEY! CPF válido :D';
                        usCpf.style.borderColor = 'green';
                        return cpfValidado = true
                    } else {
                        document.getElementById('retornoCPF').innerHTML = 'Por favor, digite um CPF válido ;)';
                        usCpf.style.borderColor = 'red';
                    }

                } else {
                    document.getElementById('retornoCPF').innerHTML = 'Por favor, digite um CPF válido ;)';
                    usCpf.style.borderColor = 'red';
                }
            }
        }
    }
});

usCpf.addEventListener('blur', function () {
    if (usCpf.value.length == 0) {
        usCpf.style.borderColor = '#ced4da';
        document.getElementById('retornoCPF').innerHTML = 'Total de caracteres restantes: 11';
    }
});

enviar.addEventListener('usck', function () {
    let ok = 0;

    if (usNome.value.length > 0 && usNome.value.length <= 10) {
        ok++;
    } else if (usNome.value.length > 10) {
        usNome.style.borderColor = 'red';
        document.getElementById('caracteres').innerHTML = 'Ops, você excedeu o limite >:(';
    } else {
        usNome.style.borderColor = 'red';
        document.getElementById('caracteres').innerHTML = 'Digite o nome >:(';
    }

    if (usCpf.value.length > 0 && usCpf.value.length <= 11) {
        if (usEmailValidado == 's') {
            ok++;
        } else {
            document.getElementById('retornoEmail').innerHTML = 'Digite um e-mail válido ;)';
            usEmail.style.borderColor = 'red';
        }
    } else if (usCpf.value.length > 11) {
        usCpf.style.borderColor = 'red';
        document.getElementById('retornoCPF').innerHTML = 'Ops, você excedeu o limite >:(';
    } else {
        usCpf.style.borderColor = 'red';
        document.getElementById('retornoCPF').innerHTML = 'Digite o CPF >:(';
    }

    if (usEmail.value.length > 0 && usEmail.value.length <= 254) {
        if (cpfValidado == 's') {
            ok++;
        } else {
            document.getElementById('retornoCPF').innerHTML = 'Por favor, digite um  válido ;)';
            usCpf.style.borderColor = 'red';
        }
    } else if (usEmail.value.length > 254) {
        usEmail.style.borderColor = 'red';
        document.getElementById('retornoEmail').innerHTML = 'Ops, você excedeu o limite >:(';
    } else {
        usEmail.style.borderColor = 'red';
        document.getElementById('retornoEmail').innerHTML = 'Digite o usEmail >:(';
    }

    if (ok == 3) {
        document.getElementById('retornoCadastro').innerHTML = 'Cadastrado com sucesso ;D';
    } else {
        document.getElementById('retornoCadastro').innerHTML = 'Dados inválidos ;(';
    }
});

senha1.addEventListener('input', function () {
    document.getElementById('retornoSenha1').innerHTML = 'Total de caracteres restantes: ' + (16 - senha1.value.length);
    if (senha1.value.length == 128) {
        document.getElementById('retornoSenha1').innerHTML = 'Ops, você chegou no limite :(';
        senha1.style.borderColor = 'orange';
    } else if (usNome.value.length != 0) {
        senha1.style.borderColor = 'green';
    } else {
        senha1.style.borderColor = '#ced4da';
    }
});

function validarSenha(senha1, senha2, campo) {
    var resultado = document.getElementById(campo);
    var verficar = false;
    senhaPrimaria = document.getElementById(senha1).value;
    senhaSecundaria = document.getElementById(senha2).value;

    if (senhaPrimaria.length >= 8) {
        if (senhaPrimaria == senhaSecundaria) {
            resultado.style.color = 'green';
            resultado.innerHTML = 'Senhas iguais :D';
            document.getElementById(senha1).style.borderColor = 'green';
            document.getElementById(senha2).style.borderColor = 'green';
            verficar = true;
        } else {
            resultado.style.color = 'red';
            resultado.innerHTML = 'Senhas diferentes :(';
            document.getElementById(senha1).style.borderColor = 'red';
            document.getElementById(senha2).style.borderColor = 'red';
        }
    } else if (senhaPrimaria.length == 0) {
        resultado.style.color = 'red';
        resultado.innerHTML = 'Por favor, digite uma senha';
        document.getElementById(senha1).style.borderColor = 'red';
    } else {
        resultado.style.color = 'red';
        resultado.innerHTML = 'A senha precisa ser entre 8 e 16 caracteres';
        document.getElementById(senha1).style.borderColor = 'red';
    }
}