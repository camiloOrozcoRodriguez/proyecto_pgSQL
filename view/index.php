<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD with postgreSQL</title>

	<!-- CDN sweetalerts -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- CDN font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CDN jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- CDN bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/style.css">
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid" id="center-nav">
        <form class="d-flex" role="search" id="form-search">
            <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>

</header>
<body>
	
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Tabla <b>clientes</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#añadirCliente" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir un cliente</span></a>				
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Correo</th>
						<th>Telefono</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody id="list-tableBD">
					<!-- acá se muestra toda la plantilla por medio de su id -->
				</tbody>
			</table>
		</div>
	</div>        
</div>

<!-- añadir Modal HTML -->
<div id="añadirCliente" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="dataForm">
				<div class="modal-header">						
					<h4 class="modal-title">añadir cliente</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" class="form-control name" id="name" required>
					</div>
					<div class="form-group">
						<label>Apellidos</label>
						<input type="text" class="form-control" id="lastName" required>
					</div>
					<div class="form-group">
						<label>correo</label>
						<input type="email" class="form-control" id="correo" required>
					</div>
					<div class="form-group">
						<label>Número de telefono</label>
						<input type="text" class="form-control" id="telefono" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="button" class="btn btn-success" value="añadir" id="addClient">
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Edit Modal HTML -->
<div id="editClienteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit client</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" class="form-control" id="nameEdit" required>
					</div>
					<div class="form-group">
						<label>apellidos</label>
						<input type="text" class="form-control" id="lastNameEdit" required>
					</div>
					<div class="form-group">
						<label>correo</label>
						<input type="email" class="form-control" id="correoEdit">
					</div>
					<div class="form-group">
						<label>telefono</label>
						<input type="text" class="form-control" id="num_telefonoEdit" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-info" value="Edit" id="editClient">
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Delete Modal HTML -->
<div id="deleteClienteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Eliminar cliente</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Seguro que quieres eliminar este registro ?</p>
					<p class="text-warning"><small>Una vez eliminado no podrás recuperarlo</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-danger" value="Delete" id="deleteModal">
				</div>
			</form>
		</div>
	</div>
</div>
</body>

<script src="../js/app.js"></script>

</html>
