@extends('layouts.app')

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
							<h3>Productos y Servicios</h3>
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
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Reportes
									<span class="pull-right">
										<i class="fa fa-database" aria-hidden="true"></i>
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
								<a href="/comprobantes/reportes" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Reportes
									<span class="pull-right">
										<i class="fa fa-database" aria-hidden="true"></i>
									</span>
								</a>
								<a href="/comprobantes/vencimientos" class="list-group-item">
									Vencimientos
									<span class="pull-right">
										<i class="fa fa-calendar" aria-hidden="true"></i>
									</span>
								</a>
							</ul>
						</div>
						<div class="col-md-4">
							<h3>Gastos y Compras</h3>
							<ul class="list-group">                                
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Vista General
									<span class="pull-right">
										<i class="fa fa-table" aria-hidden="true"></i>
									</span>
								</a>
								<a href="/gastos/nuevo" class="list-group-item">
									Nuevo gasto o compra
									<span class="pull-right">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</span>
								</a>
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Reportes
									<span class="pull-right">
										<i class="fa fa-database" aria-hidden="true"></i>
									</span>
								</a>
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Conceptos
									<span class="pull-right">
										<i class="fa fa-book" aria-hidden="true"></i>
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
									Vista general
									<span class="pull-right">
										<i class="fa fa-table" aria-hidden="true"></i>
									</span>
								</a>
								<a href="/clientes/nuevo" class="list-group-item">
									Nuevo cliente
									<span class="pull-right">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</span>
								</a>
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Reportes
									<span class="pull-right">
										<i class="fa fa-database" aria-hidden="true"></i>
									</span>
								</a>
							</ul>
						</div>
						<div class="col-md-4">
							<h3>Proveedores</h3>
							<ul class="list-group">
								<a href="/proveedores" class="list-group-item" >
									Vista general
									<span class="pull-right">
										<i class="fa fa-table" aria-hidden="true"></i>
									</span>
								</a>
								<a href="/proveedores/nuevo" class="list-group-item">
									Nuevo proveedor
									<span class="pull-right">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</span>
								</a>
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Reportes
									<span class="pull-right">
										<i class="fa fa-database" aria-hidden="true"></i>
									</span>
								</a>
							</ul>
						</div>
						<div class="col-md-4">
							<h3>Compras</h3>
							<ul class="list-group">
								<a href="/compras" class="list-group-item" >
									Vista general
									<span class="pull-right">
										<i class="fa fa-table" aria-hidden="true"></i>
									</span>
								</a>
								<a href="/compras/nuevo" class="list-group-item">
									Nueva compra
									<span class="pull-right">
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</span>
								</a>
								<a href="#" class="list-group-item" data-toggle="popover" data-content="Próximamente" data-trigger="hover" >
									Reportes
									<span class="pull-right">
										<i class="fa fa-database" aria-hidden="true"></i>
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