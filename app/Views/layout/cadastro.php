<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<style>
    #response {

        display: none;
        align-content: center;
        justify-content: center;
        align-items: center;
        height: 50px;
        width: auto;
    }

    .show {
        display: flex !important;
        text-align: center;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('conteudo') ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Paciente</a></li>
        <?php if (isset($editar)) {
            echo '<li class="breadcrumb-item active" aria-current="page">Edição</li>';
        } else {
            echo '<li class="breadcrumb-item active" aria-current="page">Cadastro</li>';
        }
        ?>

    </ol>
</nav>

<?= $this->include('formularios/cadastroForm.php') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script CEP -->
<script>
    const cep = document.querySelector("#cep")

    const mostraDados = (resultado) => {
        for (const campo in resultado) {
            if (document.querySelector("#" + campo)) {
                document.querySelector("#" + campo).value = resultado[campo]
            }
        }
    }

    cep.addEventListener("blur", (e) => {
        let search = cep.value.replace("-", "")
        const options = {
            method: 'GET',
            mode: 'cors',
            cache: 'default'
        }

        fetch(`https://viacep.com.br/ws/${search}/json/`, options)
            .then(response => {
                response.json()
                    .then(dados => mostraDados(dados))
            })
            .catch(e => console.log('Deu Erro: ' + e, message))
    })

    function mascaraCPF(cpf) {
        cpf = cpf.replace(/\D/g, "").slice(0, 11);
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/^(\d{3}\.\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(.{11})(\d)/, "$1-$2");
        return cpf;
    } // 12345678910 -> 123.456.789-10

    function mascaraPhone(cel, max = 11) { // max = 10 para telefone fixo
        cel = cel.replace(/\D/g, "").slice(0, max);
        cel = cel.replace(/^(\d{2})(\d+)/, "($1) $2");
        cel = cel.replace(/(\b\d+)(\d{4})$/, "$1-$2");
        return cel;
    } // 12345678910 -> (12) 34567-8910

    /* EXEMPLO  DE USO */
    let cpfInput = document.querySelector('#cpf');
    let tel1Input = document.querySelector('#tel1');
    let tel2Input = document.querySelector('#tel2');
    let cepInput = document.querySelector('#cep');

    cpfInput.addEventListener('keyup', function() {
        cpfInput.value = mascaraCPF(cpfInput.value);
    });

    tel1Input.addEventListener('keyup', function() {
        tel1Input.value = mascaraPhone(tel1Input.value)
    });
    tel2Input.addEventListener('keyup', function() {
        tel2Input.value = mascaraPhone(tel2Input.value)
    });

    cepInput.addEventListener('keyup', function() {
        cepInput.value = mascaraCEP(cepInput.value);
    });

    //Previne "Enter" de enviar o formulário

    document.addEventListener("keydown", function(e) {
        if (e.keyCode === 13) {

            e.preventDefault();

        }
    });
    // Confirmação de envio

    var buttonForm = document.getElementById('buttonForm');
    var cpf = document.querySelector('#cpf');

    function verificaCpf() {
        if (TestaCPF(cpf.value)) {
            if (confereCPF(cpf.value)) {
                cpf.style.backgroundColor = "white";
                buttonForm.disabled = false;
            }
        } else {
            msg = document.querySelector('#msgInfo');
            alerta = document.querySelector('#alerta');
            alerta.classList.add('alert-danger');
            alerta.style.width = "100%";
            msg.textContent = 'CPF INVÁLIDO';
            new bootstrap.Toast(document.querySelector('#basicToast')).show();
            cpf.style.backgroundColor = "#ff7373";
            buttonForm.disabled = true;
        }
    }

    //requisição para o controller para saber se o cpf está duplicado.
    function confereCPF(cpf) {
        $.ajax({
            method: "POST",
            url: "<?= base_url('atendimento/verficaCpf') ?>",
            data: {
                cpf: cpf
            },
            success: function(response) {
                var data = $.parseJSON(response);
                if (data.message == 'Success') {
                    var buttonForm = document.getElementById('buttonForm');
                    var cpf = document.querySelector('#cpf')
                    cpf.style.backgroundColor = "white";
                    buttonForm.disabled = false;
                } else if (data.message == 'Error') {
                    var buttonForm = document.getElementById('buttonForm');
                    var cpf = document.querySelector('#cpf');
                    cpf.style.backgroundColor = "#ff7373";
                    buttonForm.disabled = true;

                    msg = document.querySelector('#msgInfo');
                    alerta = document.querySelector('#alerta');
                    alerta.classList.add('alert-danger');
                    alerta.style.width = "100%";
                    msg.textContent = 'CPF JÁ CADASTRADO';
                    new bootstrap.Toast(document.querySelector('#basicToast')).show();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {

            }
        })
    }


    function TestaCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf == '') return false;
        // Elimina CPFs invalidos conhecidos	
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito	
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito	
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;
        return true;
    }

    // <?php
        //      if (isset($_SESSION['mensagem'])) {
        //          echo "msg = document.querySelector('#msgInfo');
        //          alerta = document.querySelector('#alerta');
        //          alerta.classList.add('".$_SESSION['mensagem']['tipo']."');
        //          msg.textContent = '".$_SESSION['mensagem']['mensagem']."';
        //          new bootstrap.Toast(document.querySelector('#basicToast')).show();";
        //      }
        // 
        ?>
</script>






<?= $this->endSection() ?>