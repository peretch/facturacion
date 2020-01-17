$(document).ready(function (){
	var fechaEmision = new Date();
	var day = ("0" + fechaEmision.getDate()).slice(-2);
	var month = ("0" + (fechaEmision.getMonth() + 1)).slice(-2);
	fecha = fechaEmision.getFullYear()+"-"+(month)+"-"+(day);
	$("#txtFecha").val(fecha);
	$(".form_devolucion_contado").hide();
	$(".form_compra_contado").hide();
	$(".form_factura_credito").hide();
	$(".form_venta_contado").show();
	$(".cliente-required").prop('required',true);
	$(".proveedor-required").prop('required',false);
	
	actualizarTablaArticulos();

	$("#txtAgregarArticulo").focus();

	$( "#selectTipoComprobante" ).change(function() {
		var tipo_comprobante_id = $( "#selectTipoComprobante" ).val();
		switch(tipo_comprobante_id) {
			case "1":
				// Venta al contado
				$(".form_devolucion_contado").hide();
				$(".form_compra_contado").hide();
				$(".form_factura_credito").hide();
				$(".form_venta_contado").show();

				$(".cliente-required").prop('required',true);
				$(".factura-required").prop('required',false);
				$(".proveedor-required").prop('required',false);
				break;
			case "2":
				// Devolución al contado
				$(".form_compra_contado").hide();
				$(".form_venta_contado").hide();
				$(".form_factura_credito").hide();
				$(".form_devolucion_contado").show();

				$(".cliente-required").prop('required',true);
				$(".factura-required").prop('required',false);
				$(".proveedor-required").prop('required',false);
				break;
			case "3":
				// Factura de venta a crédito
				$(".form_devolucion_contado").hide();
				$(".form_compra_contado").hide();
				$(".form_venta_contado").hide();
				$(".form_factura_credito").show();

				$(".cliente-required").prop('required',true);
				$(".factura-required").prop('required',true);
				$(".proveedor-required").prop('required',false);
				break;
			case "5":
				// Compra al contado
				$(".form_devolucion_contado").hide();
				$(".form_venta_contado").hide();
				$(".form_factura_credito").hide();
				$(".form_compra_contado").show();

				$(".cliente-required").prop('required',false);
				$(".factura-required").prop('required',false);
				$(".proveedor-required").prop('required',true);
				break;
			default:
				break;
		}
	});

	$("#txtAgregarArticulo").on('keyup', function(e){
		e.preventDefault();
		if(e.keyCode == 13){
			$("#btnAgregarArticulo").click();
		}
		var str = $("#txtAgregarArticulo").val();
		if(str != ""){
			//url = "{{ url('productos/buscar?texto=') }}" + str;
			url = buscar_prodcto_url + str;
			delay(function(){
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
			}, 600);
		}else{
			$("#listaBusquedaProducto").html("");
		}
	});
	
	$('#btnAgregarArticulo').on('click', function(e) {
		e.preventDefault();
		var producto_codigo = $("#txtAgregarArticulo").val();
		if(producto_codigo.length > 2){
			//url = "{{ url('productos/buscar?texto=') }}" + producto_codigo;
			url = buscar_prodcto_url + producto_codigo;
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
		//var url = "{{ url('comprobantes/vistaPrevia') }}";
		var url = comprobante_vistaprevia_url;
		var request;

		request = $.ajax({
			url: url,
			method: "POST",
			dataType: "json",
			data: { data: requestData }
		});
	});
	
	$(document).on('blur', '.td_cantidad', function() {
		var cantidad = $(this).val();
		var codigo = $(this).parents("tr").find(".td_codigo").html();		
		if(cantidad > $(this).prop('max')){			
			cantidad = $(this).prop('max');
			$(this).val(cantidad);
		}
		$(this).one('focus');
		modificarStock(codigo, cantidad);
	});

	$(document).on('blur', '.td_precio', function() {            
		var precio = $(this).val();
		var codigo = $(this).parents("tr").find(".td_codigo").html();
		precio = precio.replace(",", ".");
		modificarPrecio(codigo, precio);
		$(this).focus();
	});

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
		//var url = "{{ url('clientes/buscar?texto=') }}" + str;
		var url = buscar_cliente_url + str;
		$.get(url , function( data ){			    
			var clientes = data["clientes"];
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



var listadoArticulos = [
/*
   {'Id':'1','Username':'Ray','FatherName':'Thompson'},
   {'Id':'2','Username':'Steve','FatherName':'Johnson'}           
*/
]
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
				var producto_iva = producto["iva"]["tasa"]/100;
				var producto_cantidad = 1;

				listadoArticulos[listadoArticulos.length] = {
					'codigo':producto_codigo,
					'nombre': producto_nombre,
					'precio': producto_precio,
					'stock': producto_stock,
					'cantidad': producto_cantidad,
					'subTotal': (producto_precio * producto_cantidad).toFixed(2),
					'iva': (producto_precio * producto_iva).toFixed(2),
					'total': (producto_precio * producto_cantidad + producto_precio * producto_iva * producto_cantidad).toFixed(2),
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
		articulo["iva"] = parseFloat(cantidad * articulo["precio"] * 0.22);
		articulo["total"] = parseFloat(articulo["subTotal"] + articulo["iva"]).toFixed(2);

		actualizarTablaArticulos();
	}
}

function modificarPrecio(codigo, precio){           
	var articulo = buscarArticuloEnListado(codigo);
	if(articulo != null){
		articulo["precio"] = precio;
		articulo["subTotal"] = parseFloat(articulo["cantidad"] * precio);
		articulo["iva"] = parseFloat(articulo["cantidad"] * precio * 0.22);
		articulo["total"] = parseFloat(articulo["subTotal"] + articulo["iva"]).toFixed(2);

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

function descartarArticulo(posicion){
	listadoArticulos.splice(posicion, 1);
	actualizarTablaArticulos();
}

function actualizarTablaArticulos(){
	$("#tablaProductos").html("");
	var resumen_sub_total = 0;
	var resumen_iva = 0;
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
				+ "</td><td class='td_iva'>" 
					+ listadoArticulos[i]["iva"]
				+ "</td><td class='td_total'>" 
					+ listadoArticulos[i]["total"]
				+ "</td><td class='text-center'>"
					+ "<a style='color: #8a8686;' onclick='descartarArticulo(" + i + ");''><i class='fa fa-trash'></i></a>"
				+ "</td>"
			)                
		);
		resumen_sub_total += parseFloat(listadoArticulos[i]["subTotal"]);
		resumen_iva += parseFloat(listadoArticulos[i]["iva"]);
		resumen_total += parseFloat(listadoArticulos[i]["total"]);
	}
	$("#tablaResumen").html("");
	$("#tablaResumen").append(
		$('<tr></tr>').html(
			"<th width='120px'>Sub Total</th><td>"
			+ resumen_sub_total.toFixed(2)
			+ "</td>"
		)
	);
	$("#tablaResumen").append(
		$('<tr></tr>').html(
			"<th>IVA</th><td>"
			+ resumen_iva.toFixed(2)
			+ "</td>"
		)
	);
	$("#tablaResumen").append(
		$('<tr></tr>').html(
			"<th>Total</th><td>"
			+ resumen_total.toFixed(2)
			+ "</td>"
		)
	);
}

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();