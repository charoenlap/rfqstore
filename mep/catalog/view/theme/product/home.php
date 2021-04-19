<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable(<?php echo $chart; ?>);

    var options = {
      title: 'Product',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    chart.draw(data, options);
  }
</script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart2);

  function drawChart2() {
    var data = google.visualization.arrayToDataTable(<?php echo $chart2; ?>);

    var options = {
      title: 'Category',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));
    chart.draw(data, options);
  }
</script>
<div class="container-fluid">
	<div class="row mt-4">
		<div class="col-md">
			<div class="form-group">
			    <label for="">รวมสินค้าทั้งหมด</label>
			    <p></p>
			</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-6">
			<div id="curve_chart" style="width: 100%; height: 400px"></div>
		</div>
		<div class="col-md-6">
			<div id="curve_chart2" style="width: 100%; height: 400px"></div>
		</div>
	</div>
</div>