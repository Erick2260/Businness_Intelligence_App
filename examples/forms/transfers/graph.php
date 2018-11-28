<?php
		$cont=0;
		$total=0;
		$totalXBanco=array();
		$NombreXBanco=array();
		$arr = array();
		$nums = array();
		include'connection.php';
		$querySelect = "SELECT count(id) as total from transacciones where codigo_transaccion=7107;";
		$resultado = mysqli_query($conector, $querySelect);
		if($resultado) {
			$fila = " ";
			while($fila){
				$fila = mysqli_fetch_array($resultado);
				if($fila['total']!=''){
					echo $total=$fila['total'];
				}
			}
		}
		$querySelect = "SELECT  sucursal_transaccion,(count(id)) as NumTransferencias from transacciones
	      WHERE codigo_transaccion=7107
	      GROUP BY sucursal_transaccion
	      ORDER BY (count(id))DESC;";
		$resultado = mysqli_query($conector, $querySelect);
		if($resultado) {
			$fila = " ";
			while($fila){
				$fila = mysqli_fetch_array($resultado);
				if($fila['sucursal_transaccion']!=''){
					 $totalXBanco[$cont]=$fila['NumTransferencias'];
					 $NombreXBanco[$cont]=$fila['sucursal_transaccion'];
					 $cont++;
				}
			}
		}
		$cont=0;
		$querySelect = "SELECT * FROM `vtransfers_gettop5clients`";
		$resultado = mysqli_query($conector, $querySelect);
		if($resultado) {
			$fila = " ";
			while($fila){
				$fila = mysqli_fetch_array($resultado);
				if($fila['primer_nombre']!=''){
					$arr[$cont]=$fila['primer_nombre'];
					$nums[$cont]=$fila['NumTransferencias'];
					$cont++;
				}
			}
		}else
			mysqli_close($conector);

?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
		<div class="card-header">
			<a style="float:right; text-align:center; font-size:20px;" href="bodega.list.php">
				<i class="now-ui-icons arrows-1_minimal-left"></i>
				<p><strong>Cancelar</strong></p>

			</a>
			<h3 class="title">Transferencias</h3>
		</div>
	 	<div class="container">
			 <br><br>
			<form method="post">
				<div class="row">
					<div class="col-lg-6 col-md-6">
					   <div class="card card-chart">
						 <div class="card-header">
						    <h5 class="card-category">Tranfer Statistics</h5>
						    <h4 class="card-title text-center">Cantidad de transferencias en el ultimo mes</h4>
						 </div>
						 <div class="card-body">
						    <div class="chart-area">
							  <div class="text-center align-middle" >
								  <h1 id="total" class="align-middle num"></h1>
							  </div>
						    </div>
						 </div>
						 <div class="card-footer">
							 <br><br>
						    <div class="stats">
							  <i class="now-ui-icons ui-2_time-alarm"></i> Actualizado
						    </div>
						 </div>
					   </div>
					</div>
					<div class="col-lg-6 col-md-6">
					   <div class="card card-chart">
						 <div class="card-header">
						    <h5 class="card-category">Tranfer Statistics</h5>
						    <h4 class="card-title text-center">Transferencias completadas por Sucursal</h4>
						 </div>
						 <div class="card-body">
						    <div class="chart-area">
							  <canvas id="OperativeStatistics"></canvas>
						    </div>
						 </div>
						 <div class="card-footer">
							 <br><br>
						    <div class="stats">
							  <i class="now-ui-icons ui-2_time-alarm"></i> Actualizado
						    </div>
						 </div>
					   </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6">
					   <div class="card card-chart">
						 <div class="card-header">
						    <h5 class="card-category">Tranfer Statistics</h5>
						    <h4 class="card-title text-center">Top 5 de <strong>clientes</strong> que realizan transferencias en el ultimo mes. </h4>
						 </div>
						 <div class="card-body">
						    <div class="chart-area">
							  <div class="text-center align-middle" >
								  <canvas id="CustomerStatistics"></canvas>
							  </div>
						    </div>
						 </div>
						 <div class="card-footer">
							 <br><br>
						    <div class="stats">
							  <i class="now-ui-icons ui-2_time-alarm"></i> Actualizado
						    </div>
						 </div>
					   </div>
					</div>
					<div class="col-lg-6 col-md-6">
					   <div class="card card-chart">
						 <div class="card-header">
						    <h5 class="card-category">Tranfer Statistics</h5>
						    <h4 class="card-title text-center">Transferencias mayores a Q50,000 autorizadas con jefes de agencia autorizadas con documento correspondiente</h4>
						 </div>
						 <div class="card-body">
						    <div class="chart-area">
							  <canvas id="OperativeStatistics"></canvas>
						    </div>
						 </div>
						 <div class="card-footer">
							 <br><br>
						    <div class="stats">
							  <i class="now-ui-icons ui-2_time-alarm"></i> Actualizado
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
<script src="../assets/js/countUp.js" type="text/javascript">

</script>
<script type="text/javascript">
	window.onload = function() {
		var ctx = document.getElementById('OperativeStatistics').getContext('2d');
		var chart = new Chart(ctx, {
		    type: 'bar',
		     responsive: true,
		    data: {
				datasets: [{
					label: "Transacciones",
					borderColor: "#330000",
					pointBorderColor: "#000",
					pointBorderWidth: 3,
					pointBackgroundColor: "#ff6666",
					borderWidth: 3,
					data: [<?php for($i=0; $i<count($totalXBanco)-1; $i++){echo $totalXBanco[$i].', ';}?>],
					backgroundColor: '#ff6666'
				}],
		   		labels: [<?php for($i=0; $i<count($NombreXBanco); $i++){echo '"'.$NombreXBanco[$i].'", ';} ?>]
		    },
		    options: {scales: {
		        yAxes: [{
		            ticks: {
		                beginAtZero: true
		            }
		        }]
		    }}
		});
		var ctx = document.getElementById('CustomerStatistics').getContext('2d');
		var chart = new Chart(ctx, {
		    type: 'bar',
		     responsive: true,
		    data: {
				datasets: [{
					label: "Clientes",
					borderColor: "#001f3f",
					pointBorderColor: "#000",
					pointBorderWidth: 3,
					pointBackgroundColor: "#0074D9",
					borderWidth: 3,
					data: [<?php for($i=0; $i<count($nums); $i++){echo $nums[$i].', ';}?>],
					backgroundColor: '#7FDBFF'
				}],
		   		labels: [<?php for($i=0; $i<count($arr); $i++){echo '"'.$arr[$i].'", ';} ?>]
		    },
		    options: {scales: {
		        yAxes: [{
		            ticks: {
		                beginAtZero: true
		            }
		        }]
		    }}
		});
		var numAnim = new CountUp("total", 0, <?php echo $total; ?>, 0, 2);
		if (!numAnim.error) {
		    numAnim.start();
		} else {
		    console.error(numAnim.error);
		}
	}
</script>
<!--Documentacion y ejemplos https://www.chartjs.org/docs/latest/charts/radar.html-->
