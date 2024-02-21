<?= $this->extend('layout/principal') ?>

<?= $this->section('conteudo') ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Panoramas Anuais</li>
    </ol>
</nav>

<div class="card-box row">
    <div class="row mb-5">
        <select name="selectAno" id="selectAno" class="form-select">
            <option value="" selected="selected">Selecione um ano</option>
        </select>
    </div>

    <div class="d-none" id="panorama">
        <canvas id="grafico" width="300" height="300" style="margin: 0 auto;"></canvas>
        <p class="fs-5 text-center mb-3" id="totalAno"></p>
        <hr>

        <p id="totalPacientesAntigos"></p>
        <p id="totalPacientesMesmoAno"></p>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    let selectAno = document.getElementById('selectAno');
    window.onload = async () => {
        try {
            const response = await fetch('<?= base_url('anos') ?>', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('Erro na requisição');
            }

            const Anos = await response.json();

            Anos.forEach(ano => {
                selectAno.innerHTML += `<option value="${ano}">${ano}</option>`
            });
        } catch (error) {
            console.error("Erro na requisição: ", error);
        }
    }

    selectAno.addEventListener('change', async (event) => {
        let panoramaContainer = document.getElementById('panorama');
        let totalAno = document.getElementById('totalAno');
        let totalPacientesAntigos = document.getElementById('totalPacientesAntigos');
        let totalPacientesMesmoAno = document.getElementById('totalPacientesMesmoAno');
        let graficoCanvas = document.getElementById('grafico');

        let ano = event.target.value;
        try {
            panoramaContainer.classList.remove('d-none');

            const response = await fetch(`<?= base_url('panoramas') ?>/${ano}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('Erro na requisição');
            }

            const panorama = await response.json();

            const data = {
                labels: ['Pacientes Antigos', 'Pacientes Mesmo Ano'],
                datasets: [{
                    label: 'Quantidade',
                    data: [panorama.totalPacientesAntigos, panorama.totalPacientesMesmoAno],
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            };

            const options = {
                scales: {
                    y: {
                        display: false
                    },
                    x: {
                        display: false
                    }
                }
            };

            if (graficoCanvas.chart) {
                graficoCanvas.chart.destroy();
            }

            const ctx = graficoCanvas.getContext('2d');
            graficoCanvas.chart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: options
            });

            totalPacientesAntigos.innerHTML = `Total de pacientes atendidos que foram cadastrados em outros anos: <span class='fw-bolder'>${panorama.totalPacientesAntigos}<span>`;
            totalPacientesMesmoAno.innerHTML = `Total de pacientes atendidos que foram cadastrados no mesmo ano: <span class='fw-bolder'>${panorama.totalPacientesMesmoAno}<span>`;
            totalAno.innerHTML = `Total: <span class='fw-bolder'>${panorama.totalAno}<span>`;

        } catch (error) {
            console.error("Erro na requisição: ", error);
        }
    });
</script>
<?= $this->endSection() ?>