@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">    
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Comprobantes -  Reportes</h4>
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
							<a href="/comprobantes/reportes" class="link_ruta">
								Reportes
							</a>
						</li>
					</ul>
					@include('partials.menu_productos')
					<div class="row">
						<div class="col-md-12">
							<legend>Reportes - Comprobantes</legend>
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
$(document).ready(function(){        
	});
</script>
@endsection