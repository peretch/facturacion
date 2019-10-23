<div class="row">
	@include('partials.mensajes')
	<nav class="navbar navbar-default" role="navigation">		
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
			        data-target=".navbar-ex1-collapse">				
				<a class="navbar-brand" href="#">Menú</a>
			</button>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Facturas
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">						
						<li><a href="/productos/nuevo"><i class="fa fa-search-plus" aria-hidden="true"></i> &nbsp  Buscar</a></li>
						<li><a href="/productos/nuevo"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp  Nueva factura</a></li>
						<li><a href="/productos/nuevo"><i class="fa fa-print" aria-hidden="true"></i> &nbsp  Imprimir facturas</a></li>
					</ul>
	      		</li>
	    	</ul>						 
	    	<form class="navbar-form navbar-right" role="search">
	      		
	    	</form>						 
	  	</div>
	</nav>
</div>