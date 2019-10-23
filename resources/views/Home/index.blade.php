@extends('layouts.app')

@section('scriptsHeader')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	google.charts.load('current', {packages: ['corechart']});
	google.charts.setOnLoadCallback(drawIndicadorMasVendidos);

	function cargarMasVendidos(mes){
		var url = "{{ url('/indicadores/masVendidos') }}" + "/" + mes;
		$.get(url , function( data ){
			var masVendidos = data;
			conosle.log(masVendidos);
			return masVendidos;
		});
	}

	function drawIndicadorMasVendidos(){
		// Define the chart to be drawn.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Producto');
		data.addColumn('number', 'Ventas');

		masVendidos = cargarMasVendidos(10);
		console.log(masVendidos);

		data.addRows(cargarMasVendidos(10));

		// Instantiate and draw the chart.
		var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
		chart.draw(data, null);
	}
</script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Panel de control</h4>
				</div>

				<div class="panel-body">					
					<div class="row">
						<div class="col-md-4">
							<h3>Inventario</h3>
							<ul class="list-group">                                
								<a href="/productos" class="list-group-item">
									Vista general 
									<span class="pull-right">
										<i class="fa fa-table" aria-hidden="true"></i>
									</span>
								</a>
								<a href="/productos/nuevo" class="list-group-item">
									Nuevo producto
									<span class="pull-right">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</span>
								</a>
								<a href="/productos/movimientos" class="list-group-item">
									Movimientos
									<span class="pull-right">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</span>
								</a>
							</ul>
						</div>
						<div class="col-md-4">
							<h3>Comprobantes</h3>
							<ul class="list-group">
								<a href="/comprobantes/" class="list-group-item">
									Vista general
									<span class="pull-right">
										<i class="fa fa-table" aria-hidden="true"></i>
									</span>
								</a>
								<a href="/comprobantes/nuevo" class="list-group-item">
									Nuevo comprobante
									<span class="pull-right">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</span>
								</a>
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Consultas
									<span class="pull-right">
										<i class="fa fa-database" aria-hidden="true"></i>
									</span>
								</a>
							</ul>
						</div>
						<div class="col-md-4">
							<h3>Gastos</h3>
							<ul class="list-group">                                
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Vista General
									<span class="pull-right">
										<i class="fa fa-table" aria-hidden="true"></i>
									</span>
								</a>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<h3>Clientes</h3>
							<ul class="list-group">                                
								<a href="/clientes" class="list-group-item" >
									Gestionar clientes
									<span class="pull-right">
										<i class="fa fa-users" aria-hidden="true"></i>
									</span>
								</a>
								<a href="/clientes/nuevo" class="list-group-item">
									Nuevo cliente
									<span class="pull-right">
										<i class="fa fa-user-plus" aria-hidden="true"></i>
									</span>
								</a>
							</ul>
						</div>
						<div class="col-md-4">
							<h3>Proveedores</h3>
							<ul class="list-group">
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Gestionar proveedores
									<span class="pull-right">
										<i class="fa fa-truck" aria-hidden="true"></i>
									</span>
								</a>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();

		drawIndicadorMasVendidos();


	});
</script>
@endsection