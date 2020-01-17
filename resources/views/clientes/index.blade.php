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
						<table id="tabla_comprobantes" cellspacing="0" width="100%" class="table-condensed table-striped table-bordered">
							<tr>
								<th width="100px" class="text-center" colspan="2">ID</th>	
								<th width="200px" class="text-center">Nombre</th>
								<th class="text-center">Dirección</th>
								<th width="120px" class="text-center">Teléfono</th>
								<th class="text-center">E-Mail</th>
								<th width="120px" class="text-center">Saldo</th>
							</tr>

							@foreach($clientes as $cliente)
							<tr class="text-center">
								<td>{{$cliente->id}}</td>								
								@if($cliente->empresa)
								<td>
									<i style="width: 20px;" class="fa fa-briefcase text-center" aria-hidden="true"></i>
								</td>
								<td>
									<a href="/clientes/detalle/{{$cliente->id}}">
										{{$cliente->nombre}}
									</a>
								</td>
								@else
								<td width="40px">
									<i style="width: 20px;" class="fa fa-user text-center" aria-hidden="true"></i>
								</td>
								<td>
									<a href="/clientes/detalle/{{$cliente->id}}">		
										{{$cliente->nombre}} {{$cliente->apellido}}
									</a>
								</td>
								@endif								
								<td>{{$cliente->direccion}}</td>
								<td>{{$cliente->telefono}}</td>								
								<td>{{$cliente->mail}}</td>
								<td class="text-center">
									{{ App\Moneda::find(config('app.monedaPreferida'))->first()->simbolo }}
									{{ $cliente->getSaldo() }}
								</td>
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