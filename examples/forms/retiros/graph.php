<?php
		$cont=0;
		$totalSinComentarios=0;
		$totalConComentarios=0;
		$totalXBanco=array();
		$NombreXBanco=array();
		$arr = array();
		$nums = array();
		include'connection.php';
		$sql = "SELECT count(id) as total from transacciones where codigo_transaccion=7505 and monto_transaccion>20000;";
		$result = $conector->query($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$totalSinComentarios=$row['total'];

		$sql = "SELECT count(id) as total from transacciones where codigo_transaccion=7505 and monto_transaccion>20000
      AND comentarios_transaccion is NOT NULL ;";
		$result = $conector->query($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$totalConComentarios=$row['total'];

		$querySelect = "SELECT  sucursal_transaccion,(count(id)) as NumTransacciones from transacciones
		WHERE codigo_transaccion=7505
		GROUP BY sucursal_transaccion
		ORDER BY (count(id))DESC
		LIMIT 5;";
		$resultado = mysqli_query($conector, $querySelect);
		if($resultado) {
			$fila = " ";
			while($fila){
				$fila = mysqli_fetch_array($resultado);
				if($fila['sucursal_transaccion']!=''){
					 $totalXBanco[$cont]=$fila['NumTransacciones'];
					 $NombreXBanco[$cont]=$fila['sucursal_transaccion'];
					 $cont++;
				}
			}
		}
		$cont=0;
		$querySelect = "SELECT  colaborador_transaccion,(count(id)) as NumTransacciones from transacciones
		WHERE codigo_transaccion=7505
		GROUP BY colaborador_transaccion
		ORDER BY (count(id))DESC
		LIMIT 5;";
		$resultado = mysqli_query($conector, $querySelect);
		if($resultado) {
			$fila = " ";
			while($fila){
				$fila = mysqli_fetch_array($resultado);
				if($fila['colaborador_transaccion']!=''){
					$arr[$cont]=$fila['colaborador_transaccion'];
					$nums[$cont]=$fila['NumTransacciones'];
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
			<h3 class="title">Retiros</h3>
		</div>
	 	<div class="container">
			 <br><br>
			<form method="post">
				<div class="row">
					<div class="col-lg-6 col-md-6">
					   <div class="card card-chart">
						 <div class="card-header">
						    <h5 class="card-category">Retreats Statistics</h5>
						    <h4 class="card-title text-center">Top 5 de agencias que procesan retiros</h4>
						 </div>
						 <div class="card-body">
						    <div class="chart-area">
							  <div class="text-center align-middle" >
								   <canvas id="RetirosAgencia"></canvas>
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
						    <h5 class="card-category">Retreats Statistics</h5>
						    <h4 class="card-title text-center" style="font-size:20px;">Retiros mayores a Q20,000
							     que cumplan con comentarios obligatorios</h4>
						 </div>
						 <div class="card-body">
						    <div class=" text-center chart-area">
							  <div id="Area1" style="padding-top:30px;">

							  </div>
						    </div>
						 </div>
						 <div class="card-footer">
							 <br>
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
						    <h4 class="card-title text-center">Top 5 de operarios que procesan retiros.</h4>
						 </div>
						 <div class="card-body">
						    <div class="chart-area">
							  <div class="text-center align-middle" >
								  <canvas id="RemesasClientes"></canvas>
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
						    <h4 class="card-title text-center" style="font-size:16px;">Retiros mayores a Q55,000 en
							    efectivo que cumplan con documento de autorizaci´on otorgado por el jefe de agencia.</h4>
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
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="../assets/js/core/jquery.min.js"></script>
<script type="text/javascript">
	window.onload = function() {
		var element = document.querySelector('#Area1')
		var gaugeOptions = {
		  hasNeedle: true,
		  needleColor: 'gray',
		  needleUpdateSpeed: 2000,
		  arcColors: ['#01FF70', '#FF4136'],
		  arcDelimiters: [<?php echo $totalConComentarios ?>],
		  rangeLabel: ['0', '<?php echo $totalSinComentarios ?>'],
		  centralLabel: '<?php echo $totalConComentarios ?>',
		}
		GaugeChart
		  .gaugeChart(element, 300, gaugeOptions)
		  .updateNeedle(<?php echo $totalConComentarios ?>)

		var ctx = document.getElementById('RetirosAgencia').getContext('2d');
		var chart = new Chart(ctx, {
		 type: 'bar',
		 responsive: true,
		 data: {
				datasets: [{
					label: "Agencias",
					borderColor: "#FF851B",
					pointBorderColor: "#000",
					pointBorderWidth: 3,
					pointBackgroundColor: "#ff6666",
					borderWidth: 3,
					data: [<?php for($i=0; $i<count($totalXBanco); $i++){echo $totalXBanco[$i].', ';}?>],
					backgroundColor: '#FFDC00'
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

		var ctx = document.getElementById('RemesasClientes').getContext('2d');
		var chart = new Chart(ctx, {
		 type: 'bar',
		 responsive: true,
		 data: {
				datasets: [{
					label: "Operarios",
					borderColor: "#330000",
					pointBorderColor: "#000",
					pointBorderWidth: 3,
					pointBackgroundColor: "#ff6666",
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
	}
</script>
<!--Documentacion y ejemplos https://www.chartjs.org/docs/latest/charts/radar.html-->
