<?php $this->layout('templates/dashboard',['title'=>'Dashboard','subtitle'=>'Gráficos']) ?>

<div class="row justify-content-center">
    <div class="col-lg-6 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Pago</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
                <li>
                    <div id="sparklinedash"><canvas width="67" height="30"
                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                    </div>
                </li>
                <li class="ms-auto"><span class="counter text-success">R$ <?=!empty($total_pago['total'])?number_format($total_pago['total'],2,',','.'):'0,00';?></span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Apagar</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
                <li>
                    <div id="sparklinedash2"><canvas width="67" height="30"
                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                    </div>
                </li>
                <li class="ms-auto"><span class="counter text-danger">R$ <?=!empty($total_apagar['total'])?number_format($total_apagar['total'],2,',','.'):'0,00';?></span></li>
            </ul>
        </div>
    </div>
</div>


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Gráfico do Mês <?= $mes[date('n',strtotime('now'))];?></h3>
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Right sidebar -->
<!-- ============================================================== -->
<!-- .right-sidebar -->
<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->               
<?php $this->push('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    const labels = [
    <?= $dias; ?>
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Apagar',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [<?=$mesApagar;?>],
    },{
      label: 'Pago',
      backgroundColor: 'rgb(75, 192, 192)',
      borderColor: 'rgb(75, 192, 192)',
      data: [<?=$mesPago;?>],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
<?php $this->end() ?>