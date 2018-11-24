
<div class="row">
	<div class="col-md-12">
       <div class="card">
     	   <div class="card-header">
     		   <h3 class="title">Depositos</h3>
     	   </div>
     	   <div class="container">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
							Depositos mayores a Q55,000
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
							Depostios mayores a Q20,000
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
							Depositos mayores Q15,000
						</a>
					</li>
				</ul>
				<div class="tab-content container" id="myTabContent">
					<div class="text-center tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<br>
						<h3>Depositos mayores a Q55,000</h3><br><br>
				  		<div id="Area1"></div>
					</div>
					<div class="text-center tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<br>
						<h3>Depostios mayores a Q20,000</h3>
						<div id="Area2"></div>
					</div>
					<div class="text-center tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						<br>
						<h3>Depositos mayores Q15,000</h3>
						<div id="Area3"></div>
						<br>
					</div>
				</div>
			<br>
     	   </div>
         </div>
       </div>
     </div>
  </div>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="../assets/js/core/jquery.min.js"></script>
<script type="text/javascript">
	window.onload = function() {
		var element = document.querySelector('#Area1')
		var gaugeOptions = {
		  hasNeedle: true,
		  needleColor: 'gray',
		  needleUpdateSpeed: 1000,
		  arcColors: ['rgb(44, 151, 222)', 'lightgray'],
		  arcDelimiters: [30],
		  rangeLabel: ['0', '100'],
		  centralLabel: '50',
		}
		GaugeChart
		  .gaugeChart(element, 300, gaugeOptions)
		  .updateNeedle(50)

		var element = document.querySelector('#Area2')
  		var gaugeOptions = {
  		  hasNeedle: true,
  		  needleColor: 'gray',
  		  needleUpdateSpeed: 1000,
  		  arcColors: ['rgb(44, 151, 222)', 'lightgray'],
  		  arcDelimiters: [30],
  		  rangeLabel: ['0', '100'],
  		  centralLabel: '50',
  		}
  		GaugeChart
  		  .gaugeChart(element, 300, gaugeOptions)
  		  .updateNeedle(50)


		var element = document.querySelector('#Area3')
    		var gaugeOptions = {
    		  hasNeedle: true,
    		  needleColor: 'gray',
    		  needleUpdateSpeed: 1000,
    		  arcColors: ['rgb(44, 151, 222)', 'lightgray'],
    		  arcDelimiters: [30],
    		  rangeLabel: ['0', '100'],
    		  centralLabel: '50',
    		}
    		GaugeChart
    		  .gaugeChart(element, 300, gaugeOptions)
    		  .updateNeedle(50)
	};

</script>
