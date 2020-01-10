@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Proveedores</h4>
                </div>

                <div class="panel-body">
                	<a href="/" class="btn btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel</a>
                	<span class="pull-right">
                		<a class="btn btn-sm btn-success" href="/proveedores/nuevo" class="btn btn-link">
                        	<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Proveedor
                        </a>
                    </span>
                	@include('partials.menu_productos')
                    <div class="row">
                    	<div class="container">
	                        <div class="table-responsive">
								<table width="97%" class=" table-condensed table-striped">
									<tr>
										<th width="40px">ID</th>
										<th width="120px">Nombre</th>
										<th width="15%">RUT</th>
										<th>Dirección</th>
										<th width="15%">Telefono</th>
										<th width="15%">Mail</th>
										<th width="25px"></th>
									</tr>

									@foreach($proveedores as $proveedor)
										<tr>
											<td>
												<a href="/proveedores/detalle/{{ $proveedor->id}}">
													{{ $proveedor->id}}
												</a>
											</td>
											<td>
												<a href="/proveedores/detalle/{{ $proveedor->id}}">
													{{ $proveedor->nombre }}
												</a>
											</td>
											<td>{{ $proveedor->rut}}</td>
											<td>{{ $proveedor->direccion}}</td>
											<td>{{ $proveedor->telefono}}</td>
											<td>{{ $proveedor->mail}}</td>
											<td>
												<a href="#">
													<i class="fa fa-edit"></i>
												</a>
											</td>
										</tr>
									@endforeach							
								</table>
							</div>
							<div class="text-center">
								{{ $proveedores->links() }}
							</div>
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
	$("#form_busqueda").show();
	$("#txtBusqueda").focus();  
</script>
@endsection