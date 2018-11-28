<?php
		$cont=0;
		$totalSinComentarios=0;
		$totalConComentarios=0;
		$totalXBanco=array();
		$NombreXBanco=array();
		$arr = array();
		$nums = array();
		include'connection.php';
		$sql = "SELECT count(id) as total from transacciones where codigo_transaccion=7006 and monto_transaccion>20000 ;";
		$result = $conector->query($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$totalSinComentarios=$row['total'];

		$sql = "SELECT count(id) as total from transacciones where codigo_transaccion=7006 and monto_transaccion>20000
          AND comentarios_transaccion is NOT NULL ;";
		$result = $conector->query($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$totalConComentarios=$row['total'];

		$querySelect = "SELECT  sucursal_transaccion,(count(id)) as NumRemesas from transacciones
	      WHERE codigo_transaccion=7006
	      GROUP BY sucursal_transaccion
	      ORDER BY (count(id))DESC;";
		$resultado = mysqli_query($conector, $querySelect);
		if($resultado) {
			$fila = " ";
			while($fila){
				$fila = mysqli_fetch_array($resultado);
				if($fila['sucursal_transaccion']!=''){
					 $totalXBanco[$cont]=$fila['NumRemesas'];
					 $NombreXBanco[$cont]=$fila['sucursal_transaccion'];
					 $cont++;
				}
			}
		}
		$cont=0;
		$querySelect = "SELECT primer_nombre,count(transacciones.id) as NumTransacciones from clientes
	      inner join transacciones  ON clientes.codigo_usuario = transacciones.codigo_usuario
	      WHERE codigo_transaccion=7006
	      GROUP BY primer_nombre
	      ORDER BY (count(transacciones.id))DESC
	      LIMIT 5;";
		$resultado = mysqli_query($conector, $querySelect);
		if($resultado) {
			$fila = " ";
			while($fila){
				$fila = mysqli_fetch_array($resultado);
				if($fila['primer_nombre']!=''){
					$arr[$cont]=$fila['primer_nombre'];
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
			<h3 class="title">Remesas</h3>
		</div>
	 	<div class="container">
			 <br><br>
			<form method="post">
				<div class="row">
					<div class="col-lg-6 col-md-6">
					   <div class="card card-chart">
						 <div class="card-header">
						    <h5 class="card-category">Transfer Statistics</h5>
						    <h4 class="card-title text-center">Remesas pagadas por agencia</h4>
						 </div>
						 <div class="card-body">
						    <div class="chart-area">
							  <div class="text-center align-middle" >
								   <canvas id="RemesasAgencia"></canvas>
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
						    <h5 class="card-category">Transfer Statistics</h5>
						    <h4 class="card-title text-center" style="font-size:16px;">Remesas pagadas a clientes del banco mayores a $2,000 que cumplan con comentarios obligatorios</h4>
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
						    <h4 class="card-title text-center">Top 5 clientes que reciben remesas en el ultimo mes.</h4>
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
						    <h4 class="card-title text-center" style="font-size:16px;">Remesas pagadas a clientes del banco mayores a $3,500
							    autorizadas por el jefe de agencia con documento correspondiente.</h4>
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

		var ctx = document.getElementById('RemesasAgencia').getContext('2d');
		var chart = new Chart(ctx, {
		 type: 'bar',
		 responsive: true,
		 data: {
				datasets: [{
					label: "Agencias",
					borderColor: "#330000",
					pointBorderColor: "#000",
					pointBorderWidth: 3,
					pointBackgroundColor: "#ff6666",
					borderWidth: 3,
					data: [<?php for($i=0; $i<count($totalXBanco); $i++){echo $totalXBanco[$i].', ';}?>],
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

		var ctx = document.getElementById('RemesasClientes').getContext('2d');
		var chart = new Chart(ctx, {
		 type: 'bar',
		 responsive: true,
		 data: {
				datasets: [{
					label: "Clientes",
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
