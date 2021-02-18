@extends('layouts.index')
@section('content')
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Dashboard</h2>
	</header>

	<div class="row">
		<div class="col-xs-12">
			<div id="Expenses" style="height: 80vh; width: 100%;"></div>
		</div>
	</div>

</section>
@endsection
@section('css')

@endsection
@section('js')

<script src="{{asset('assets/javascripts/canvasjs.min.js')}}"></script>
<script>
$(document).ready(function(){
	$.ajax({
		type: 'post',
		url: "{{route('main.graph')}}",
		success: function(data){
			console.log(data.main_array);


			var data_array = [];
			var data_object = {};
			if (data.main_array.length == 0) {
				data_object = {
					label: "No expense records available",
					y: 0,
					decimal:  0
				}

				data_array.push(data_object);
			}else{

				$.each(data.main_array, function( k, v ) {
					var total = v.total.toFixed(2);
					var decimal = total.split(".");

					data_object = {
						label: v.category,
						y: v.total,
						decimal:  decimal[1]
					}

					data_array.push(data_object);
				});

			}
			console.log(data_array);

			// Expenses
			    var chart1 = new CanvasJS.Chart("Expenses",{
			    	title: {
			    		text: "My Expenses"
			    	},
			    	animationEnabled: true,
			    	data: [{
			    		type: "doughnut",
			    		innerRadius: "40%",
			    		showInLegend: true,
			    		legendText: "{label} ${y}.{decimal} ",
			    		indexLabel: "{label}: #percent%",
			    		dataPoints: data_array
			    	}]
			    });
			    chart1.render();

		},
	});
});
</script>
@endsection
@section('modals')

@endsection

