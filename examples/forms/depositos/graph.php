<div class="row">
  <div class="col-md-12">
    <div class="card">
		<div class="card-header">
			<a style="float:right; text-align:center; font-size:20px;" href="bodega.list.php">
				<i class="now-ui-icons arrows-1_minimal-left"></i>
				<p><strong>Cancelar</strong></p>

			</a>
			<h3 class="title">Depositos</h3>
		</div>
	 	<div class="container">
			 <br><br>
			<form method="post">
				<div class="row">
					<div class="col-lg-6 col-md-6">
					   <div class="card card-chart">
						 <div class="card-header">
						    <h5 class="card-category">Deposits Statistics</h5>
						    <h4 class="card-title text-center">Top 5 de <strong>agencias</strong> que procesan depositos</h4>
						 </div>
						 <div class="card-body">
						    <div class="chart-area">
							  <canvas id="DepositStatistics"></canvas>
						    </div>
						 </div>
						 <div class="card-footer">
							 <br>
						    <div class="stats">
							  <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
						    </div>
						 </div>
					   </div>
					</div>
					<div class="col-lg-6 col-md-6">
					   <div class="card card-chart">
						 <div class="card-header">
						    <h5 class="card-category">Operative Statistics</h5>
						    <h4 class="card-title text-center">Top 5 de <strong>operarios</strong> que procesan depositos</h4>
						 </div>
						 <div class="card-body">
						    <div class="chart-area">
							  <canvas id="OperativeStatistics"></canvas>
						    </div>
						 </div>
						 <div class="card-footer">
							 <br>
						    <div class="stats">
							  <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
						    </div>
						 </div>
					   </div>
					</div>
				</div>
			</form>
			<br>
	 	</div>
	 </div>
    </div>
  </div>
</div>
<script type="text/javascript">
var ctx = document.getElementById('DepositStatistics').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
     responsive: true,
    data: {
      labels: ["12pm,", "3pm", "6pm", "9pm", "12am"],
      datasets: [{
        label: "Agencias",
        borderColor: "#18ce0f",
        pointBorderColor: "#FFF",
        pointBackgroundColor: "#18ce0f",
        borderWidth: 2,
        data: [400, 500, 650, 700, 800],

      }]
    },
    options: {}
});
var ctx = document.getElementById('OperativeStatistics').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
     responsive: true,
    data: {
		datasets: [{
			label: "Operarios",
			borderColor: "#330000",
			pointBorderColor: "#FFF",
			pointBackgroundColor: "#ff6666",
			borderWidth: 2,
			data: [800, 500, 650, 700, 800],
			backgroundColor: '#ff6666'
		}],
   		labels: ["12pm,", "3pm", "6pm", "9pm", "12am"]
    },
    options: {}
});
</script>
<!--Documentacion y ejemplos https://www.chartjs.org/docs/latest/charts/radar.html-->
