<!-- PRUEBA INICIAL
<table border="0">
@for ($i = 0; $i < 6; $i++)
 <tr>
	<td style="width: 10mm; height: 6mm">A{{$i}}</td>
	<td style="width: 10mm; height: 6mm">B{{$i}}</td>
	<td style="width: 10mm; height: 6mm">C{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">D{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">E{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">F{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">G{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">H{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">I{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">J{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">K{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">L{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">M{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">N{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">Ñ{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">O{{$i}}</td>	
	<td style="width: 10mm; height: 6mm">P{{$i}}</td>	
 </tr>
 @endfor
<tr>
 	<td colspan="11" style="width: 110mm; height: 10mm"></td>
 	<td colspan="4" style="width: 40mm; height: 10mm">409765827918</td>
 	<td style="width: 10mm; height: 10mm"></td>
 	<td style="width: 10mm; height: 10mm">X</td>
</tr>

<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>

-->


<table border="0">
@for ($i = 0; $i < 6; $i++)
	<tr>
		<td style="width: 10mm; height: 5mm"></td>
		<td style="width: 10mm; height: 5mm"></td>
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 14mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
		<td style="width: 10mm; height: 5mm"></td>	
	</tr>
 @endfor
 <tr>	
	<td colspan="11" ></td>	
	@if($comprobante->rut != null)
		<td colspan="4">{{ $comprobante->rut }}</td>
		<td style="width: 10mm; height: 5mm"></td>	
	@else
		<td colspan="4"></td>
		<td style="width: 10mm; height: 5mm">X</td>	
	@endif	
	<td></td>	
 </tr>
</table>
<?php $i++; ?>
<table>
	<tr>
		<td style="width: 10mm; height: 9mm"></td>
		<td style="width: 10mm; height: 9mm"></td>
		<td style="width: 10mm; height: 9mm"></td>	
		<td style="width: 10mm; height: 9mm"></td>	
		<td style="width: 86mm; height: 9mm">{{ $comprobante->nombre_cliente }}</td>
		
		
		<td style="width: 10mm; height: 9mm"></td>	
		<td style="width: 10mm; height: 9mm"></td>	
		<td style="width: 10mm; height: 9mm"></td>	
		<td style="width: 10mm; height: 9mm"></td>	
		<td style="width: 10mm; height: 9mm"></td>	
	</tr>
<?php $i++; ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>	
		<td></td>	
		<td>{{ $comprobante->direccion }}</td>			
		
		
		<td style="width: 20mm;"></td>
		<td>{{ date('d', strtotime($comprobante->fecha_emision)) }}</td>	
		<td>{{ date('m', strtotime($comprobante->fecha_emision)) }}</td>	
		<td>{{ date('y', strtotime($comprobante->fecha_emision)) }}</td>	
		<td></td>	
	</tr>
</table>
<?php $i++; ?>
<table>
	<tr>
		<td style="height: 6mm" colspan="6"></td>
	</tr>
	<?php $i = 0 ?>
	@foreach($comprobante->lineasProducto as $l)
		<tr>
			<td style="font-size: 12px; width: 24mm; height: 6mm"></td>
			<td style="font-size: 12px; width: 10mm; height: 6mm">{{ $l->cantidad }}</td>
			<td style="font-size: 12px; width: 8mm; height: 6mm"></td>	
			<td style="font-size: 12px; width: 100mm; height: 6mm">{{ $l->producto->nombre }}</td>
			<td style="font-size: 12px; width: 16mm; height: 6mm"></td>	
			<td style="font-size: 12px; width: 20mm; height: 6mm">{{ str_replace(".", ",", $l->subTotal) }}</td>
		</tr>
		<?php $i++; ?>
	@endforeach

	@for (; $i < 4; $i++)
	<tr>
		<td style="font-size: 12px; width: 24mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 10mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 8mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 100mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 16mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 20mm; height: 6mm"></td>
	</tr>
	@endfor
	<!--
	@for (; $i < 7; $i++)
	<tr>
		<td style="font-size: 12px; width: 24mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 10mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 8mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 100mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 16mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 20mm; height: 6mm"></td>
	</tr>
	@endfor
	-->
	<tr>
		<td style="font-size: 12px; width: 24mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 10mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 8mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 100mm; height: 6mm">{{$comprobante->descripcion_1}}</td>
		<td style="font-size: 12px; width: 16mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 20mm; height: 6mm"></td>
	</tr>
	<tr>
		<td style="font-size: 12px; width: 24mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 10mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 8mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 100mm; height: 6mm">{{$comprobante->descripcion_2}}</td>
		<td style="font-size: 12px; width: 16mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 20mm; height: 6mm"></td>
	</tr>
	<tr>
		<td style="font-size: 12px; width: 24mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 10mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 8mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 100mm; height: 6mm">{{$comprobante->descripcion_3}}</td>
		<td style="font-size: 12px; width: 16mm; height: 6mm"></td>
		<td style="font-size: 12px; width: 20mm; height: 6mm"></td>
	</tr>

	<tr>
		<td colspan="6" style="height: 4mm"> </td>
	</tr>
	<tr>
		<td colspan="5"></td>
		<td style="font-size: 12px; width: 24mm; height: 6mm">{{ round($comprobante->subTotal) }}</td>
	</tr>
	<tr>
		<td colspan="5"></td>
		<td style="font-size: 12px; width: 24mm; height: 6mm">{{ round($comprobante->iva) }}</td>
	</tr>
	<tr>
		<td colspan="5"></td>
		<td style="font-size: 12px; width: 24mm; height: 7mm">{{ round($comprobante->total) }}</td>
	</tr>
</table>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
