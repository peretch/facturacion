$(document).ready(function (){
	var fechaEmision = new Date();
	var day = ("0" + fechaEmision.getDate()).slice(-2);
	var month = ("0" + (fechaEmision.getMonth() + 1)).slice(-2);
	fecha = fechaEmision.getFullYear()+"-"+(month)+"-"+(day);

	$("#txtFecha").val(fecha);
	
	// Inicializamos array que se traiga las facturas que cargaron en la vista.
	inicializarFacturas();

	// Actualizamos tabla, esto debe cambiar monto maximo para ingresar.
	actualizarTablaFacturas();	
	
	$(document).on('change keyup', '.checkboxFacturaTodas', function() {
		if($(this).is(":checked")) {
			$('.checkboxFactura').attr({
				'checked': true
			})
		}else{
			$('.checkboxFactura').attr({
				'checked': false
			})
		}
		// MONTO	
		$("#txtMonto").focus();

		// Reconocer checkbox marcados por defecto
		$('.checkboxFactura').change();
	});

	$(document).on('change keyup', '.checkboxFactura', function() {
		var factura_id = parseFloat($(this).parents("tr").find(".var_factura_id").val());
		var deuda_actual = parseFloat($(this).parents("tr").find(".var_deuda_actual").html());
		
		if($(this).is(":checked")) {
			agregarFactura(factura_id, deuda_actual);
		}else{			
			quitarFactura(factura_id, deuda_actual);
		}
		$("#txtMonto").attr({
			"max" : maximo_a_pagar
		});
	});

	$(document).on('change keyup', '#txtMonto', function() {
		var pago = $(this).val();
		for (var i = 0; i < facturas_seleccionadas.length; i++) {			
			if(pago > 0){
				var deuda_actual = facturas_seleccionadas[i]['deuda_actual'];				
				if(parseFloat(pago) >= parseFloat(deuda_actual)){
					pago = parseFloat(pago) - parseFloat(deuda_actual).toFixed(2);
					facturas_seleccionadas[i]['a_pagar'] = parseFloat(deuda_actual).toFixed(2);
					facturas_seleccionadas[i]['saldo_final'] = (parseFloat(facturas_seleccionadas[i]['deuda_actual']) - parseFloat(facturas_seleccionadas[i]['a_pagar'])).toFixed(2);

					$('#a_pagar_' + facturas_seleccionadas[i]['factura_id']).html('' + facturas_seleccionadas[i]['a_pagar']);					
					$('#saldo_final_' + facturas_seleccionadas[i]['factura_id']).html(facturas_seleccionadas[i]['saldo_final']);					
				}else{
					facturas_seleccionadas[i]['a_pagar'] = parseFloat(pago).toFixed(2);
					facturas_seleccionadas[i]['saldo_final'] = (parseFloat(facturas_seleccionadas[i]['deuda_actual']) - parseFloat(facturas_seleccionadas[i]['a_pagar'])).toFixed(2);

					$('#a_pagar_' + facturas_seleccionadas[i]['factura_id']).html('' + facturas_seleccionadas[i]['a_pagar']);
					$('#saldo_final_' + facturas_seleccionadas[i]['factura_id']).html(facturas_seleccionadas[i]['saldo_final']);
					pago = 0;
				}
			}else{
				$('#a_pagar_' + facturas_seleccionadas[i]['factura_id']).html('0');
			}			
		}		
	});

	$("#formNuevoRecibo").on('submit', function(e){
		if(! confirm("Confirma el pago?, una vez ingresado el recibo no podrá ser modificado.")){
			e.preventDefault();
		}
		// Guardo listado de facturas seleccionadas en un json pasado a string
		var facturas = JSON.stringify(facturas_seleccionadas);
		$("#hidden_facturas_seleccionadas").val(facturas);		
	});

	// MONTO	
	$("#txtMonto").focus();

	// Reconocer checkbox marcados por defecto
	$('.checkboxFactura').change();

});


// GLOBALES
var facturas_seleccionadas = [
/*
   {'Id':'1','deuda_actual':'230','dias_restantes':'5'},
   {'Id':'2','deuda_actual':'567','dias_restantes':'-17'}
*/
];
var maximo_a_pagar = 0;

function buscarFactura(factura_id){
	var index_factura = -1;
	var i = 0;

	while(i < facturas_seleccionadas.length && index_factura < 0){
		if(facturas_seleccionadas[i]['factura_id'] == factura_id){
			index_factura = i;
		}
		i++;
	}
	return index_factura;
}

function agregarFactura(factura_id, deuda_actual){
	if(buscarFactura(factura_id) < 0){
		facturas_seleccionadas[facturas_seleccionadas.length] = {
			'factura_id': factura_id,
			'deuda_actual': deuda_actual.toFixed(2),
			'a_pagar': 0,
			'saldo_final': deuda_actual.toFixed(2),
		};
		maximo_a_pagar = maximo_a_pagar + deuda_actual;
	}
	$('#txtMonto').val(maximo_a_pagar);
	$('#txtMonto').change();
}

function quitarFactura(factura_id, deuda_actual){
	index_factura = buscarFactura(factura_id);
	if(index_factura >= 0){
		$('#a_pagar_' + facturas_seleccionadas[index_factura]['factura_id']).html('0');
		$('#saldo_final_' + facturas_seleccionadas[index_factura]['factura_id']).html(facturas_seleccionadas[index_factura]['deuda_actual']);
		facturas_seleccionadas.splice(index_factura, 1);
		maximo_a_pagar = maximo_a_pagar - deuda_actual;
	}	
	$('#txtMonto').val(maximo_a_pagar);
	$('#txtMonto').change();
}

function inicializarFacturas(){

}

function actualizarTablaFacturas(){
	$("#txtMonto").attr({
       "max" : 0,
       "min" : 0
    });

	//$("#tablaFacturas").html("");

	var codigo = $(this).parents("tr").find(".td_codigo").html();

	var maximo_a_pagar = 0;
}