@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Ajustes</h4>
				</div>
				<a href="/" class="btn btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i> Salir de ajustes</a>
				<div class="panel-body">
					<div class="row">
					@include('partials.mensajes')
						<div class="col-md-12">
							<legend>Ajustes</legend>
							<div class="col-md-4">
								<form class="form-horizontal" role="form" method="POST" action="/ajustes/datosPersonales">
								{{ csrf_field() }}
									<fieldset>
										<div class="form-group">
											<h4>Datos personales</h4>
											<label class="form-label" for="nombre"> Nombre de usuario</label>
											<input class="sm form-control" type="text" name="nombre" value="{{ Auth::user()->name }}" id="txtNombre">
										</div>
										<div class="form-group">
											<label class="form-label" for="nombre"> Contraseña actual</label>
											<input class="sm form-control" type="password" name="passwordActual" placeholder="Contraseña actual" id="txtNombre">
										</div>
										<div class="form-group">
											<label class="form-label" for="nombre"> Nueva contraseña</label>
											<input class="sm form-control" type="password" name="passwordNueva1" placeholder="Nueva contraseña" id="txtNombre">
										</div>
										<div class="form-group">
											<input class="sm form-control" type="password" name="passwordNueva2" placeholder="Repita su nueva contraseña" id="txtNombre">
										</div>                                        
									</fieldset>
									<fieldset>
										<div class="form-group">
											<h4>Estilo</h4>											
											<select class="form-control" name="estilo">
												<option value="" disabled selected hidden>Cambiar el tema</option>
												<option value="css/style_blue.css">Ocean</option>
												<option value="css/style_green.css">Nature</option>
												<option value="css/style_dark.css">Night</option>
											</select>
										</div>
									</fieldset>
									<div class="form-group">
										<input class="btn btn-primary" type="submit" value="Guardar configuración">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection