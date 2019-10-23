@extends('layouts.app')

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
									<legend>Datos del comprobante</legend>
									<div class="form-group col-md-12">
										<label class="sr-only" for="txtFecha">Fecha de emisión</label>
										<input id="txtFecha" type="date" name="fechaEmision" class="form-control input-sm">
									</div>
									<div class="form-group col-md-12">
										<label class="sr-only" for="selectTipoComprobante">Tipo de comprobante</label>
										<select id="selectTipoComprobante" name="tipo_comprobante" class="form-control input-sm" tabindex="2">
											@foreach($tipos_comprobante as $t)
												<option value="{{$t->id}}">{{$t->nombre}}</option>
											@endforeach											
										</select>
									</div>

									<div class="form-group col-md-4">
										<label class="sr-only" for="txtSerieComprobante">Serie</label>
										<input name="serie" type="text" class="form-control input-sm" id="txtSerieComprobante" placeholder="Serie" tabindex="2">
									</div>
									<div class="form-group col-md-8">
										<label class="sr-only" for="txtNumeroCómprobante">Número</label>
										<input name="numero" type="text" class="form-control input-sm" id="txtNumeroCómprobante" placeholder="N° de Comrprobante" tabindex="3">
									</div>
									
									<div class="form-group col-md-6">
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

									<div class="form-group col-md-6">
										<label class="sr-only" for="txtCotizacion">Cotización</label>
										<input name="cotizacion" type="text" class="form-control input-sm" id="txtCotizacion" placeholder="Cotización" tabindex="5">
									</div>

									<div class="form-group col-md-12">
										<legend for="txtCliente">Datos del cliente</legend>
										<label class="sr-only" for="txtCliente">Nombre o razón social</label>
										<div class="input-group">
											<input id="hiddenCliente" type="hidden" name="cliente_id">
											<input name="cliente" type="text" class="form-control input-sm required" id="txtCliente" placeholder="Nombre o razón social" oninvalid="this.setCustomValidity('Debe ingresar el nombre o la razón social del cliente')" required oninput="setCustomValidity('')" tabindex="6">
											<div class="input-group-btn">
											<button id="btnAgregarCliente" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalAgregarCliente">
													<i class="fa fa-address-book-o" aria-hidden="true"></i>
												</button>
											</div>
										</div>
									</div>


									<div class="form-group col-md-12">
										<label class="sr-only" for="txtDireccion">Dirección</label>
										<input name="direccion" type="text" class="form-control input-sm" id="txtDireccion" placeholder="Dirección" tabindex="7">
									</div>
									<div class="form-group col-md-12">
										<label class="sr-only" for="txtRut">RUT</label>
										<input name="rut" type="text" class="form-control input-sm" id="txtRut" placeholder="RUT" tabindex="8">
									</div>
									<div class="form-group col-md-12">
									<a href="#modalDescripcion" class="btn btn-block" data-toggle="modal" data-target="#modalDescripcion">
										Agregar datos extra
									</a>
									</div>
								</fieldset>
							</div>
							<div class="col-md-8">
								<fieldset>
									<legend>
									<div class="row">
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
									<div class="col-md-12 pre-scrollable div-detalle-comprobante">
										<table width="100%" class="table-condensed table-striped table-bordered">
											<thead>
												<tr>
													<th width="100px">Código</th>
													<th>Artículo</th>
													<th width="80px">precio</th>
													<th width="75px">Cant.</th>
													<th width="80px">Sub total</th>
													<th width="80px">Impuestos</th>
													<th width="80px">Total</th>
												</tr>
											</thead> 
											<tbody id="tablaProductos">
												
											</tbody>
										</table>
									</div>
									<div class="col-md-6">
										<button id="btnGuardarComprobante" class="btn btn-block btn-primary" tabindex="9">
											Confirmar
										</button>
									</div>
									<div class="col-md-6">
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

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		var fechaEmision = new Date();
		var day = ("0" + fechaEmision.getDate()).slice(-2);
		var month = ("0" + (fechaEmision.getMonth() + 1)).slice(-2);
		fecha = fechaEmision.getFullYear()+"-"+(month)+"-"+(day);
		$("#txtFecha").val(fecha);

		var listadoArticulos = [
		/*
		   {'Id':'1','Username':'Ray','FatherName':'Thompson'},
		   {'Id':'2','Username':'Steve','FatherName':'Johnson'}           
		*/
		]
		actualizarTablaArticulos();

		$("#txtAgregarArticulo").focus();

		$("#txtAgregarArticulo").on('keyup', function(e){
			e.preventDefault();
			if(e.keyCode == 13){
				$("#btnAgregarArticulo").click();
			}
			var str = $("#txtAgregarArticulo").val();
			if(str != ""){
				url = "{{ url('productos/buscar?texto=') }}" + str;
				$.get(url , function( data ){
					$("#divData").html( data );                    
					var productos = data["productos"];                    
					if(productos.length == 0){
						$("#listaBusquedaProducto").html("");
					}else{
						$("#listaBusquedaProducto").html("");                        
						for (i = 0; i < productos.length; i++) { 
							$("#listaBusquedaProducto").append(
								$('<option></option>').val(productos[i].codigo).html(productos[i].nombre + ", " + productos[i].stock + " unidades.")
							);
						}
					}
				});
			}else{
				$("#listaBusquedaProducto").html("");
			}
		});
		
		$('#btnAgregarArticulo').on('click', function(e) {
			e.preventDefault();
			var producto_codigo = $("#txtAgregarArticulo").val();
			if(producto_codigo.length > 2){
				url = "{{ url('productos/buscar?texto=') }}" + producto_codigo;
				$.get(url , function( data ){
					agregarArticulo(data);
				});
			}
		});
		
		$("#formNuevoComprobante").on('submit', function(e){
			if(! confirm("¿Guardar comprobante?, una vez ingresado al sistema no podrá ser modificado.")){
				e.preventDefault();
			}
			var articulos = JSON.stringify(listadoArticulos);
			$("#hiddenListado").val(articulos);
			alert(requestData);
			var url = "{{ url('comprobantes/vistaPrevia') }}";
			var request;

			request = $.ajax({
				url: url,
				method: "POST",
				dataType: "json",
				data: { data: requestData }
			});            
		});
		
		$(document).on('keyup mouseup', '.td_cantidad', function() {
			var cantidad = $(this).val();
			var codigo = $(this).parents("tr").find(".td_codigo").html();
			modificarStock(codigo, cantidad);
		});

		$(document).on('blur', '.td_precio', function() {            
			var precio = $(this).val();
			var codigo = $(this).parents("tr").find(".td_codigo").html();
			precio = precio.replace(",", ".");
			modificarPrecio(codigo, precio);
			console.log($(this));
			$(this).focus();
		});


		function actualizarTablaArticulos(){            
			$("#tablaProductos").html("");
			var resumen_sub_total = 0;
			var resumen_impuestos = 0;
			var resumen_total = 0;
			for(i=0; i < listadoArticulos.length; i++){
				$("#tablaProductos").append(
					$('<tr></tr>').html(
						"<td class='td_codigo'>" 
							+ listadoArticulos[i]["codigo"] 
						+ "</td><td>"
							+ listadoArticulos[i]["nombre"] 
						+ "</td><td>" 
							//+ listadoArticulos[i]["precio"] 
							+ "<input class='form-control input-sm td_precio' value="+ listadoArticulos[i]["precio"] + ">"
						+ "</td><td>"
							+ "<input type='number' class='form-control input-sm td_cantidad' value="+ listadoArticulos[i]["cantidad"] + " max=" + listadoArticulos[i]["stock"] + " min=1>"
						+ "</td><td class='td_subTotal'>" 
							+ listadoArticulos[i]["subTotal"] 
						+ "</td><td class='td_impuestos'>" 
							+ listadoArticulos[i]["impuestos"]
						+ "</td><td class='td_total'>" 
							+ listadoArticulos[i]["total"]
						+ "</td>"
					)                
				);
				resumen_sub_total += parseFloat(listadoArticulos[i]["subTotal"]);
				resumen_impuestos += parseFloat(listadoArticulos[i]["impuestos"]);
				resumen_total += parseFloat(listadoArticulos[i]["total"]);
			}
			$("#tablaResumen").html("");
			$("#tablaResumen").append(
				$('<tr></tr>').html(
					"<th width='120px'>Sub Total</th><td>U$S "
					+ resumen_sub_total.toFixed(2)
					+ "</td>"
				)
			);
			$("#tablaResumen").append(
				$('<tr></tr>').html(
					"<th>Impuestos</th><td>U$S "
					+ resumen_impuestos.toFixed(2)
					+ "</td>"
				)
			);
			$("#tablaResumen").append(
				$('<tr></tr>').html(
					"<th>Total</th><td>U$S "
					+ resumen_total.toFixed(2)
					+ "</td>"
				)
			);            
		}

		function agregarArticulo(data){        	
			if(data["productos"].length > 0){
				var producto = data["productos"][0];
				var producto_codigo = producto["codigo"];
				var productoBuscado = buscarArticuloEnListado(producto_codigo);
				if( productoBuscado == null){
					var producto_stock = producto["stock"];
					if(producto_stock > 0){
						var producto_nombre = producto["nombre"];
						var producto_precio = producto["precio"];
						var producto_impuestos = 0.22;
						var producto_cantidad = 1;

						listadoArticulos[listadoArticulos.length] = {
							'codigo':producto_codigo,
							'nombre': producto_nombre,
							'precio': producto_precio,
							'stock': producto_stock,
							'cantidad': producto_cantidad,
							'subTotal': (producto_precio * producto_cantidad).toFixed(2),
							'impuestos': (producto_precio * producto_impuestos).toFixed(2),
							'total': (producto_precio * producto_cantidad + producto_precio * producto_impuestos * producto_cantidad).toFixed(2),
						};
					}
				}else{
					if(productoBuscado["cantidad"] < productoBuscado["stock"]){
						productoBuscado["cantidad"]++;                		
					}               	
				}
				actualizarTablaArticulos();
				$("#txtAgregarArticulo").val("");
			}
		}

		function modificarStock(codigo, cantidad){           
			var articulo = buscarArticuloEnListado(codigo);
			if(articulo != null){
				articulo["cantidad"] = cantidad;
				articulo["subTotal"] = parseFloat(cantidad * articulo["precio"]);
				articulo["impuestos"] = parseFloat(cantidad * articulo["precio"] * 0.22);
				articulo["total"] = parseFloat(articulo["subTotal"] + articulo["impuestos"]).toFixed(2);

				actualizarTablaArticulos();
			}
		}

		function modificarPrecio(codigo, precio){           
			var articulo = buscarArticuloEnListado(codigo);
			if(articulo != null){
				articulo["precio"] = precio;
				articulo["subTotal"] = parseFloat(articulo["cantidad"] * precio);
				articulo["impuestos"] = parseFloat(articulo["cantidad"] * precio * 0.22);
				articulo["total"] = parseFloat(articulo["subTotal"] + articulo["impuestos"]).toFixed(2);

				actualizarTablaArticulos();
			}
		}

		function buscarArticuloEnListado(codigo){
			var i = 0;            
			var articuloBuscado = null;
			while(i < listadoArticulos.length && articuloBuscado == null){
				if(listadoArticulos[i]["codigo"] == codigo){
					articuloBuscado = listadoArticulos[i];
				}
				i++;
			}
			return articuloBuscado;
		}

		$('#btnAgregarCliente').on('click', function(e) {
			e.preventDefault();
			$("#hiddenCliente").val("");

			$("#txtCliente").val("");
			$("#txtDireccion").val("");
			$("#txtRut").val("");
			$("#txtCliente").prop( "disabled", false );
			//$("#txtDireccion").prop( "disabled", false );
			$("#txtRut").prop( "disabled", false );

			$("#txtBuscadorCliente").focus();
		});

		$('#btnBuscarCliente').on('click', function(e) {
			e.preventDefault();
			var str = $("#txtBuscadorCliente").val();
			var url = "{{ url('clientes/buscar?texto=') }}" + str;
			$.get(url , function( data ){			    
				var clientes = data["clientes"];
				console.log(clientes);
				$("#tablaClientes").html("");
				for(i=0; i < clientes.length; i++){
					var cliente_id = clientes[i]["id"];
					var cliente_nombre = clientes[i]["nombre"];

					var cliente_apellido = "";
					if(clientes[i]["apellido"] != null){
						var cliente_apellido = clientes[i]["apellido"];	
					}

					var cliente_rut = "-";
					if(clientes[i]["rut"] != null){
						var cliente_rut = clientes[i]["rut"];	
					}

					var cliente_mail = "-";
					if(clientes[i]["mail"] != null){
						var cliente_mail = clientes[i]["mail"];	
					}

					var cliente_direccion = "-";
					if(clientes[i]["direccion"] != null){
						var cliente_direccion = clientes[i]["direccion"];	
					}

					$("#tablaClientes").append(
						$('<tr></tr>').html(
							"<td class='td_cliente_id'>" 
								+ cliente_id
							+ "</td><td class='td_cliente_nombre'>"
								+ cliente_nombre + " " + cliente_apellido
							+ "</td><td class='td_cliente_rut'>"
								+ cliente_rut
							+ "</td><td class='td_cliente_direccion'>"
								+ cliente_direccion							
							+ "</td><td class='td_cliente_mail'>"
								+ cliente_mail
							+ "</td><td>"
								+ "<a class='btn-agregar-cliente btn btn-sm btn-block btn-link'>"
									+ '<i class="fa fa-share" aria-hidden="true"></i>'
								+ "</a>"
							+ "</td>"

						)
					);
				}
			});
		});

		$(document).on('click', '.btn-agregar-cliente', function() {
			var cliente_id = $(this).parents("tr").find(".td_cliente_id").html();
			var cliente_nombre = $(this).parents("tr").find(".td_cliente_nombre").html();			
			var cliente_direccion = $(this).parents("tr").find(".td_cliente_direccion").html();			
			var cliente_rut = $(this).parents("tr").find(".td_cliente_rut").html();			
			
			$("#hiddenCliente").val(cliente_id);

			$("#txtCliente").val(cliente_nombre);
			$("#txtCliente").prop( "disabled", true );
			$("#txtDireccion").val(cliente_direccion);
			//$("#txtDireccion").prop( "disabled", true );
			$("#txtRut").val(cliente_rut);
			$("#txtRut").prop( "disabled", true );
			
			$("#btnOkModalAgregarCliente").click();
		});
	});

</script>
@endsection