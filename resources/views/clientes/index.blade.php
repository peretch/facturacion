@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Vista general de clientes</h4>
				</div>
				<div class="panel-body">
					<span class="pull-right">
						<a class="btn btn-sm btn-success" href="/clientes/nuevo" class="btn btn-link">
							<i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo cliente
						</a>
					</span>
					<ul class="list-inline">
						<li>
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/clientes" class="link_ruta">
								Clientes
							</a>
						</li>						
					</ul>
					@include('partials.menu_productos')
				
					<div class="table-responsive">
						<table id="tabla_facturas" cellspacing="0" width="100%" class="table-condensed table-striped table-bordered">
							<tr>
								<th width="50px">ID</th>
								<th width="200px">Nombre</th>
								<th>Mail</th>
								<th>Dirección</th>
								<th width="120px">Teléfono</th>
								<th width="120px">RUT</th>
							</tr>

							@foreach($clientes as $cliente)
							<tr>
								<td>{{$cliente->id}}</td>
								<td>
									@if($cliente->empresa)
										<i style="width: 20px;" class="fa fa-briefcase text-center" aria-hidden="true"></i>
										<a href="/clientes/detalle/{{$cliente->id}}">
											{{$cliente->nombre}}
										</a>
									@else
										<i style="width: 20px;" class="fa fa-user text-center" aria-hidden="true"></i>
										<a href="/clientes/detalle/{{$cliente->id}}">												
											{{$cliente->nombre}} {{$cliente->apellido}}
										</a>
									@endif									
								</td>
								<td>{{$cliente->mail}}</td>
								<td>{{$cliente->direccion}}</td>
								<td></td>
								<td>{{$cliente->rut}}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="text-center">
						{{ $clientes->links() }}
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
			$("#form_busqueda").show();
			$("#txtBusqueda").focus();		
		});
	</script>
@endsection