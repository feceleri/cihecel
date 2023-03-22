<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    #dtPessoas {
        font: 14px Verdana;
    }

    #tbPessoas {
        font: 14px Verdana;

    }

    table tr td {
        width: 100em;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:history.go(-1)">Perfil</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cadastro Listagem</li>
</ol>

<?= $this->include('formularios/formListagem.php'); ?>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<script>
    pacientes = [];

    function mascaraCPF(cpf) {
        cpf = cpf.replace(/\D/g, "").slice(0, 11);
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/^(\d{3}\.\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(.{11})(\d)/, "$1-$2");
        return cpf;
    } // 12345678910 -> 123.456.789-10

    let cpfInput = document.querySelector('#cpfResp');
    let cpfAdicional = document.querySelector('#cpfAdicional');

    cpfInput.addEventListener('keyup', function() {
        cpfInput.value = mascaraCPF(cpfInput.value);
    });

    cpfAdicional.addEventListener('keyup', function() {
        cpfAdicional.value = mascaraCPF(cpfAdicional.value);
    });


    var pessoas = [];

    async function searchPeople(valor) {
        if (valor.length >= 4) {
            console.log(valor);
            $.ajax({
                method: "POST",
                url: "<?= base_url('atendimento/autoComplete') ?>",
                data: {
                    valor: valor,
                },
                success: function(response) {
                    response.forEach(function(pessoa) {
                        pessoas.indexOf(pessoa.cpf) === -1 ? pessoas.push(pessoa.cpf) : "";
                    });
                },
            })

        }
    }

    document.getElementById("cpfResp").addEventListener("focusout", function() {
        if (document.getElementById("cpfResp").value.length == 14) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('atendimento/getCpf') ?>",
                data: {
                    cpf: document.getElementById("cpfResp").value
                },
                success: function($row) {
                    if ($row == false) {
                        document.getElementById("responsavel").value = 'CPF inválido ou não existe no sistema.';
                    } else {
                        document.getElementById("responsavel").value = $row[0]['nome'];
                    }
                },
            })
        }
    });

    document.getElementById("cpfAdicional").addEventListener("focusout", function() {
        if (document.getElementById("cpfAdicional").value.length == 14) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('atendimento/getCpf') ?>",
                data: {
                    cpf: document.getElementById("cpfAdicional").value
                },
                success: function($row) {
                    if ($row == false) {
                        document.getElementById("nomeAdicional").value = 'CPF inválido ou não existe no sistema.';
                    } else {
                        document.getElementById("nomeAdicional").value = $row[0]['nome'];
                        document.getElementById("idAdicional").value = $row[0]['id'];
                        document.getElementById("ncAdicional").value = $row[0]['id'];

                    }
                },
                error: function() {
                    console.log('Error');
                }
            })
        }
    });

    document.getElementById("ncAdicional").addEventListener("focusout", function() {
        if (document.getElementById("ncAdicional").value) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('atendimento/getCpf') ?>",
                data: {
                    cpf: document.getElementById("ncAdicional").value
                },
                success: function($row) {
                    if ($row == false) {
                        document.getElementById("nomeAdicional").value = 'NC inválido ou não existe no sistema.';
                    } else {
                        document.getElementById("nomeAdicional").value = $row[0]['nome'];
                        document.getElementById("cpfAdicional").value = $row[0]['cpf'];
                        document.getElementById("idAdicional").value = $row[0]['id'];
                        document.getElementById("ncAdicional").value = $row[0]['id'];

                    }
                },
                error: function() {
                    console.log('Error');
                }
            })
        }
    });

    function adicional(nomeAdicional, cpfAdicional, qtdAdicional) {
        if (cpfAdicional.length == 14 & nomeAdicional !== 'CPF inválido ou não existe no sistema.') {
            var idPaciente = document.getElementById("idAdicional").value;
           
            const paciente = pacientes.find(element => {
                if (element.id === parseInt(idPaciente)) {
                    return true;
                }
                return false;
            });

            if (!paciente) {
                var tb = document.querySelector("#tbPessoas");
                var qtdLinhas = tb.rows.length;
                var linha = tb.insertRow(qtdLinhas);
                var cellNome = linha.insertCell(0);
                var cellCpf = linha.insertCell(1);
                var cellQtd = linha.insertCell(2);

                var item = {
                    id: parseInt(idPaciente),
                    qtd: qtdAdicional
                };

                pacientes.push(item);

                cellNome.innerHTML = nomeAdicional;
                cellCpf.innerHTML = cpfAdicional;
                cellQtd.innerHTML = qtdAdicional;
                document.getElementById("idsAdicional").value = JSON.stringify(pacientes);
                document.getElementById("cpfAdicional").value = null;
                document.getElementById("qtdAdicional").value = null;
                document.getElementById("nomeAdicional").value = null;

            } else {
                alert("Esse paciente já foi listado");
            }

        } else {
            alert('CPF inválido ou campos preenchidos incorretamente!')
        }
    }

    $("#form").submit(function(){
            $(this).find(":submit").attr('disable');
        });
</script>
<?= $this->endSection() ?>