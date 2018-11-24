<div class="row">
  <div class="col-md-12">
    <div class="card">
		<div class="card-header">
			<a style="float:right; text-align:center; font-size:20px;" href="bodega.list.php">
				<i class="now-ui-icons arrows-1_minimal-left"></i>
				<p><strong>Cancelar</strong></p>

			</a>
			<h3 class="title">Cheques</h3>
		</div>
	 	<div class="container">
			 <br><br>
			<form method="post">
				<canvas id="myChart"> </canvas>
			</form>
			<br>
	 	</div>
	 </div>
    </div>
  </div>
</div>
<!--Documentacion y ejemplos https://www.chartjs.org/docs/latest/charts/radar.html-->

<script type="text/javascript">
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'radar',
    //Dataset
    data: {
		labels: ['Running', 'Swimming', 'Eating', 'Cycling'],
		datasets: [{
			label: "My First dataset",
			backgroundColor: 'rgb(255, 99, 132)',
			borderColor: 'rgb(255, 99, 132)',
			data: [20, 10, 4, 30]
		}]
    },
    options: {}
});
</script>
