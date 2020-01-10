@extends('layouts.app')

@section('scriptsHeader')		
	<script type="text/javascript">
		var buscar_cliente_url = "{{ url('clientes/buscar?texto=') }}";
		var buscar_prodcto_url = "{{ url('productos/buscar?texto=') }}";
		var comprobante_vistaprevia_url = "{{ url('comprobantes/vistaPrevia') }}";
	</script>
	<script src="{{ asset('js/forms/comprobantes.js') }}"></script>
@endsection

@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Ingreso de comprobante</h4>
				</div>                
				<div class="panel-body">
					<ul class="list-inline">
						<li>
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/comprobantes" class="link_ruta">
								Comprobantes &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="/comprobantes/nuevo" class="link_ruta">
								Nuevo
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')
					
					<form id="formNuevoComprobante" action="/comprobantes/guardar" method="post">
					{{ csrf_field() }}
						<div class="modal fade" id="modalDescripcion" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<legend>Agregar información</legend>
									</div>

									<div class="modal-body">
										<div class="form-group">
											<input maxlength="60" class="form-control" type="text" name="descripcion_1" placeholder="Línea 1">
											<input maxlength="60" class="form-control" type="text" name="descripcion_2" placeholder="Línea 2">
											<input maxlength="60" class="form-control" type="text" name="descripcion_3" placeholder="Línea 3">
										</div>
									</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-block btn-primary" data-dismiss="modal">Confirmar</button>
									</div>        
								</div>
							</div>
						</div>
						<input id="hiddenListado" type="hidden" name="listadoArticulos">
						<div class="row">
							<div class="col-md-4">
								<fieldset>
									<div class="form-group col-md-12">
									<legend>Datos del comprobante</legend>
										<label class="sr-only" for="txtFecha">Fecha de emisión</label>
										<input id="txtFecha" type="date" name="fecha_emision" class="form-control input-sm">
									</div>
									<div class="form-group col-md-12">
										<label class="sr-only" for="selectTipoComprobante">Tipo de comprobante</label>
										<select id="selectTipoComprobante" name="tipo_comprobante" class="form-control input-sm" tabindex="2">
											@foreach($tipos_comprobante as $t)
												<option value="{{$t->id}}">{{$t->nombre}}</option>
											@endforeach											
										</select>
									</div>

									<div class="form-group col-md-4 form_venta_contado form_factura_credito form_devolucion_contado">
										<label class="sr-only" for="txtSerieComprobante">Serie</label>
										<input name="serie" type="text" class="form-control input-sm" id="txtSerieComprobante" placeholder="Serie" tabindex="2">
									</div>
									<div class="form-group col-md-8 form_venta_contado form_factura_credito form_devolucion_contado">
										<label class="sr-only" for="txtNumeroCómprobante">Número</label>
										<input name="numero" type="text" class="form-control input-sm" id="txtNumeroCómprobante" placeholder="N° de Comrprobante" tabindex="3">
									</div>
									
									<div class="form-group col-md-6 form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<label class="sr-only" for="txtMoneda">Moneda</label>
										<select name="moneda" class="form-control input-sm" tabindex="4">
											@foreach($monedas as $moneda)
												@if($moneda->id == config('app.monedaPreferida') )
													<option value="{{$moneda->id}}" selected="true">{{$moneda->nombre}} ({{$moneda->simbolo}})</option>
												@else
													<option value="{{$moneda->id}}">{{$moneda->nombre}} ({{$moneda->simbolo}})</option>
												@endif
											@endforeach
										</select>
									</div>

									<div class="form-group col-md-6 form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<label class="sr-only" for="txtCotizacion">Cotización</label>
										<input name="cotizacion" type="text" class="form-control input-sm" id="txtCotizacion" placeholder="Cotización" tabindex="5">
									</div>

									<!-- CLIENTE -->
									<div class="form-group col-md-12 form_venta_contado form_factura_credito form_devolucion_contado">
										<legend for="txtCliente">Datos del cliente</legend>
										<label class="sr-only" for="txtCliente">Nombre o razón social</label>
										<div class="input-group">
											<input id="hiddenCliente" type="hidden" name="cliente_id">
											<input name="cliente" type="text" class="form-control input-sm required cliente-required" id="txtCliente" placeholder="Nombre o razón social" oninvalid="this.setCustomValidity('Debe ingresar el nombre o la razón social del cliente')" required oninput="setCustomValidity('')" tabindex="6">
											<div class="input-group-btn">
											<button id="btnAgregarCliente" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalAgregarCliente">
													<i class="fa fa-address-book-o" aria-hidden="true"></i>
												</button>
											</div>
										</div>
									</div>

									<!-- PROVEEDOR -->
									<div class="form-group col-md-12 form_compra_contado">
										<legend for="txtCliente">Datos del Proveedor</legend>
										<label class="sr-only" for="txtCliente">Nombre o razón social</label>
										<div class="input-group">
											<input id="hiddenCliente" type="hidden" name="proveedor_id">
											<input name="proveedor" type="text" class="form-control input-sm required proveedor-required" id="txtCliente" placeholder="Nombre o razón social" oninvalid="this.setCustomValidity('Debe ingresar el nombre o la razón social del proveedor')" required oninput="setCustomValidity('')" tabindex="6">
											<div class="input-group-btn">
											<button id="btnAgregarCliente" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalAgregarCliente">
													<i class="fa fa-address-book-o" aria-hidden="true"></i>
												</button>
											</div>
										</div>
									</div>									

									<div class="form-group col-md-12 form_venta_contado form_factura_credito form_devolucion_contado">
										<label class="sr-only" for="txtDireccion">Dirección</label>
										<input name="direccion" type="text" class="form-control input-sm" id="txtDireccion" placeholder="Dirección" tabindex="7">
									</div>
									<div class="form-group col-md-12 form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<label class="sr-only" for="txtRut">RUT</label>
										<input name="rut" type="text" class="form-control input-sm" id="txtRut" placeholder="RUT" tabindex="8">
									</div>


									<!-- DATOS DE FACTURA -->
									<div class="form-group col-md-12 form_factura_credito">
										<legend>Datos de la factura</legend>
										<label for="txtFechaVencimiento">Vencimiento</label>
										<input class="form-control input-sm factura-required" type="date" name="fecha_vencimiento" placeholder="Vencimiento de la factura">
									</div>
									<div class="form-group col-md-12 form_factura_credito">
										<label class="sr-only">Plazo</label>
										<input class="form-control input-sm" type="number" name="plazo" placeholder="Plazo (en días)">
									</div>
									<div class="form-group col-md-12 form_factura_credito">
										<label class="sr-only">Pago inicial</label>
										<input class="form-control input-sm" type="number" name="pago_inicial" placeholder="Pago inicial">
									</div>


									<div class="form-group col-md-12 form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<a href="#modalDescripcion" class="btn btn-block" data-toggle="modal" data-target="#modalDescripcion">
											Agregar datos extra
										</a>
									</div>
								</fieldset>
							</div>
							<div class="col-md-8">
								<fieldset>
									<legend>
									<div class="row form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<div class="col-md-4">
											Artículos
										</div>
										<div class="col-md-8">
											<div class="input-group pull-right">
												<form>
													<input type="text" class="form-control input-sm" id="txtAgregarArticulo" list="listaBusquedaProducto" placeholder="Agregar un artículo..." onkeydown="if (event.keyCode == 13) return false;" tabindex="1">
													<div class="input-group-btn">
														<button id="btnAgregarArticulo" class="btn btn-default btn-sm">
															<i class="fa fa-cart-plus" aria-hidden="true"></i>
														</button>
													</div>
												</form>
											</div>
										</div> 
										<datalist id="listaBusquedaProducto">
											<!--
											<option value="a"/>
											<option value="b"/>
											<option value="c"/>
											-->
										</datalist>
									</div>
									</legend>
									<div class="col-md-12 pre-scrollable div-detalle-comprobante form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<table width="100%" class="table-condensed table-striped table-bordered">
											<thead>
												<tr>
													<th class="text-center" width="100px">Código</th>
													<th class="text-center">Artículo</th>
													<th class="text-center" width="80px">Precio</th>
													<th class="text-center" width="75px">Cantidad</th>
													<th class="text-center" width="80px">Subtotal</th>
													<th class="text-center" width="80px">IVA</th>
													<th class="text-center" width="80px">Total</th>
													<th class="text-center" width="30px"></th>
												</tr>
											</thead> 
											<tbody id="tablaProductos">
												
											</tbody>
										</table>
									</div>
									<div class="col-md-6 form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<button id="btnGuardarComprobante" class="btn btn-block btn-primary" tabindex="9">
											Confirmar
										</button>
									</div>
									<div class="col-md-6 form_venta_contado form_factura_credito form_devolucion_contado form_compra_contado">
										<table class="table-condensed pull-right table-striped">
											<thead id="tablaResumen">
												
											</thead>
										</table>
									</div>
								</fieldset>                                
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAgregarPorducto" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<legend>Agregar artículo</legend>
			</div>

			<div class="modal-body">
				
			</div>

			<div class="modal-footer">
				
			</div>        
		</div>
	</div>
</div>

<div class="modal fade" id="modalAgregarCliente" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4>
					Buscar cliente
					<span class="pull-right">
						<a class="btn btn-success btn-sm text-center" href="/clientes/nuevo" target="_blank" >
							<i class="fa fa-user-plus" aria-hidden="true"></i>
						</a>
					</span>
				</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label class="sr-only">Buscar cliente</label>
						<div class="row">
							<div class="col-md-10">
								<input id="txtBuscadorCliente" class="form-control" type="text" name="BuscadorCliente" placeholder="Buscar cliente...">
							</div>
							<div class="col-md-2">
								<button id="btnBuscarCliente" type="submit" class="btn btn-primary btn-block">
									<i class="fa fa-search" aria-hidden="true"></i>									
								</button>
							</div>
						</div>						
						<hr/>
						<table width="100%" class="table-condensed table-striped table-bordered">
							<thead>
								<tr>
									<th width="5%">ID</th>
									<th width="20%">Nombre / Razón Social</th>
									<th width="20%">RUT</th>
									<th width="20%">Mail</th>
									<th width="20%">Dirección</th>
									<th width="5%"></th>
								</tr>
							</thead>
							<tbody id="tablaClientes">
								
							</tbody>
						</table>						
					</div>
				</form>
			</div>

			<div class="modal-footer">				
				<button id="btnOkModalAgregarCliente" class="btn btn-block btn-primary" data-dismiss="modal">
					Confirmar
				</button>
			</div>
		</div>
	</div>
</div>
@endsection