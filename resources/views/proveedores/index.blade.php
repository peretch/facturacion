@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>AMV Store - Proveedores</h4>
                </div>

                <div class="panel-body">
                	<a href="/" class="btn btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel</a>
                	<span class="pull-right">
                		<a class="btn btn-sm btn-success" href="/productos/nuevo" class="btn btn-link">
                        	<i class="fa fa-plus" aria-hidden="true"></i> Nuevo producto
                        </a>
                    </span>
                	@include('partials.menu_productos')
                    <div class="row">
                    	<div class="container">
	                        <div class="table-responsive">
								<table width="97%" class=" table-condensed table-striped">
									<tr>
										<th width="120px">Nombre</th>
										<th width="15%">RUT</th>
										<th width="15%">Dirección</th>
										<th width="15%">Mail</th>
									</tr>

									@foreach($productos as $producto)										
										<tr>
											<td><a href="/productos/{{ $producto->codigo}}">{{ $producto->codigo}}</a></td>
											<td>{{ $producto->nombre}}</td>
											<td>{{ $producto->familia->nombre}}</td>
											<!--<td>{{ $producto->descripcion}}</td>-->
											<td>
												{{ str_limit(str_replace('<br />','', $producto->descripcion), 80) }}

												@if(strlen($producto->descripcion) > 80)
												<span class="pull-right">
							                		<a class="btn-sm btn-link" data-toggle="modal" data-target="#myModal{{ $producto->codigo }}">
							                        	más...
							                        </a>
							                    </span>
													<div id="myModal{{ $producto->codigo }}" class="modal fade" role="dialog">
  														<div class="modal-dialog">
  															<div class="modal-content">
  																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">{{ $producto->nombre }}</h4>
																</div>
																<div class="modal-body">
																	{!! $producto->descripcion !!}
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																</div>
															</div>
														</div>
													</div>
							                    @endif
											</td>
											<td>U$S {{ $producto->precio}}</td>
											<td>{{ $producto->stock}}</td>
											<td>
												<a href="#formStock" class="btn" id="{{$producto->codigo}}" data-toggle="modal" data-target="#formStock" onclick='$("#form_stock").attr("action", "/productos/{{$producto->codigo}}/ModificarStock");'>
													<i class="fa fa-exchange" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
									@endforeach							
								</table>
							</div>
							<div class="text-center">
								{{ $productos->links() }}
							</div>
						</div>
                    </div>
                    @include('partials.movimiento_stock')
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">	
	//Auto focus al buscador
	$("#txtBusqueda").focus();
</script>
@endsection