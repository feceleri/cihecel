<?= $this->extend('layout/principal') ?>

<?= $this->section('conteudo') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page" id="breadcrumbTitle"></li>
    </ol>
</nav>

<h1>
    <?php if ($tipo == 'abertos') : ?>
        Atendimentos que não tiveram saída
    <?php elseif ($tipo == 'cadastros') : ?>
        Pessoas cadastradas nesse mês
    <?php else : ?>
        Atendimentos concluídos nesse mês
    <?php endif; ?>
</h1>
<table class="table table-hover" id="tabelaDetalhes">
    <thead>
        <tr>
            <th><?= $tipo == 'cadastros' ? 'Data do cadastro' : 'Data' ?></th>
            <th>Paciente</th>
            <?php if ($tipo == 'cadastros') : ?>
                <th>Data do último atendimento</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    let mes = <?= $mes ?>;
    let ano = <?= $ano ?>;
    let tipo = '<?= $tipo ?>';

    async function detalhesMes(mes, ano, tipo) {
        let nomeMes;
        let rota;

        switch (mes) {
            case 1:
                nomeMes = 'Janeiro';
                break;
            case 2:
                nomeMes = 'Fevereiro';
                break;
            case 3:
                nomeMes = 'Março';
                break;
            case 4:
                nomeMes = 'Abril';
                break;
            case 5:
                nomeMes = 'Maio';
                break;
            case 6:
                nomeMes = 'Junho';
                break;
            case 7:
                nomeMes = 'Julho';
                break;
            case 8:
                nomeMes = 'Agosto';
                break;
            case 9:
                nomeMes = 'Setembro';
                break;
            case 10:
                nomeMes = 'Outubro';
                break;
            case 11:
                nomeMes = 'Novembro';
                break;
            case 12:
                nomeMes = 'Dezembro';
                break;
            default:
                nomeMes = 'Mês Inválido';
        }

        switch (tipo) {
            case "total":
                rota = `<?= base_url('total') ?>/${mes}/${ano}`;
                break;
            case "concluidos":
                rota = `<?= base_url('concluidos') ?>/${mes}/${ano}`;
                break;
            case "abertos":
                rota = `<?= base_url('abertos') ?>/${mes}/${ano}`;
                break;
            case "cadastros":
                rota = `<?= base_url('cadastros') ?>/${mes}/${ano}`;
                break;
            default:
                rota = `<?= base_url('total') ?>/${mes}/${ano}`;
                break;

        }

        let breadcrumbTitle = document.getElementById('breadcrumbTitle');
        breadcrumbTitle.innerHTML = `Detalhes - ${nomeMes}, ${ano}`

        if ($.fn.DataTable.isDataTable('#tabelaDetalhes')) {
            $('#tabelaDetalhes').DataTable().destroy();
        }

        $('#tabelaDetalhes').DataTable({
            ajax: rota,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
            },
            dom: 'ifrtpB',
            buttons: [{
                extend: 'excelHtml5',
                text: 'Excel',
                title: `${tipo}_-_${mes}_-_${ano}`,

            }, ],
            ordering: false,
            deferRender: true,
        });
    }

    detalhesMes(mes, ano, tipo);

    // setInterval(() => {
    //     detalhesMes(mes, ano, tipo)
    // }, 5000);
</script>
<?= $this->endSection() ?>