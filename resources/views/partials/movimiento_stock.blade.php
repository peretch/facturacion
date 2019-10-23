<!-- Modal Stock -->
<div class="modal fade" id="formStock" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Movimiento de stock</h4>
			</div>

			<div class="modal-body">
				<form id="form_stock" method="post" action=getAction()>
					{{ csrf_field() }}
					<div class="form-group">
						<label>Tipo de movimiento</label>
						<select class="form-control" name="accion">
							<option value="sumar">Ingresar stock</option>
							<option value="restar">Retirar stock</option>
							<option value="sustituir">Sustituir stock</option>
						</select>

						<label>Cantidad</label>
						<input class="form-control" type="number" name="cantidad" placeholder="Ingrese cantidad de productos" required="" oninvalid="this.setCustomValidity('Debe ingresar una cantidad válida')" oninput="setCustomValidity('')">

						<label>Descripción</label>
						<input class="form-control" type="text" name="descripcion" placeholder="Agregue una descripción..." required="" oninvalid="this.setCustomValidity('El ingreso de una descripción es obligatorio.')" oninput="setCustomValidity('')">
					</div>
					<input class="form-control btn btn-primary" type="submit" name="enviar" value="Confirmar">
				</form>
			</div>

			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>