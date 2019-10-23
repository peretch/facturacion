<!-- Modal alerts -->
<div class="modal fade" id="formFamiliaProducto" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<form class="form" method="post" action="/productos/familiaProductos/nueva">
			{{ csrf_field() }}
			<meta name="csrf-token" content="{{ csrf_token() }}">			
				<div class="modal-body list-group">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<fieldset>
								<div class="form-group text-center">
									<h4>Nueva familia de producto</h4>
									<input id="txtnombreFamiliaProducto" type="text" class="form-control" name="nombreFamiliaProducto" placeholder="Ingresa una nueva familia de producto" oninvalid="this.setCustomValidity('Debe ingresar un valor válido')" required oninput="setCustomValidity('')">
								</div>
							</fieldset>
							<div class="form-group">
								<input class="btn btn-success btn-block" type="submit" name="" value="Guardar">
							</div>
						</div>
					</div>
				</div>				
			</form>
		</div>
	</div>
</div>