<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" id="token" content="{{ csrf_token() }}">
	<title>Test Ocean Group</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>Ocean Group</h1>
			</div>

		</div>
		@if(Session::has('message'))
			 <div class="alert alert-success">
		        <ul>
		           <li>Trabajador Creado Correctamente</li>
		        </ul>
		    </div>
		@endif

		@if (count($errors) > 0)
		    <div class="alert alert-warning">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		 <div class="alert alert-success" id="msgS" style="display:none">
		        <ul>
		           <li>Trabajador Editado Correctamente</li>
		        </ul>
		    </div>
		<div class="alert alert-danger" id="msgD" style="display:none">
		        <ul>
		           <li>Trabajador Eliminado Correctamente</li>
		       </ul>
		</div>

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form action="{{ route('trabajador.store') }}" method="POST">
				{{ csrf_field() }}
				  <div class="form-group">
				    <label>Nombre</label>
				    <input type="text" name="nombre" class="form-control" placeholder="Ingrese su Nombre" required>
				  </div>
				  <div class="form-group">
				    <label>Apellido</label>
				    <input type="text" name="apellido" class="form-control" placeholder="Ingrese su Apellido" required>
				  </div>
				  <div class="form-group">
				    <label>Cedula</label>
				    <input type="number" name="cedula" class="form-control" placeholder="Ingrese su Cedula" required>
				  </div>
				  <div class="form-group">
				    <label>Correo</label>
				    <input type="email" name="correo" class="form-control" placeholder="Ingrese su Correo" required>
				  </div>
				  <div class="form-group">
				    <label>Cargo</label>
				    <input type="text" name="cargo" class="form-control" placeholder="Ingrese su Cargo" required>
				  </div>
				  <input type="submit" class="btn btn-primary" value="Guardar">
				</form>
			</div>
		</div>
		<div class="row">
			<hr>
			<div class="col-md-12">
				<table class="table table-condensed table-hover" id="tabla">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Cedula</th>
							<th>Correo</th>
							<th>Cargo</th>
							<th>Activo</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody id="trabajador_list">
					@if (count($trabajador) > 0)
						
						@foreach ($trabajador as $trabajadors)
						<tr data-id="{{ $trabajadors->id }}" id="trabajador{{ $trabajadors->id }}">
							<td>{{ $trabajadors->nombre }}</td>
							<td>{{ $trabajadors->apellido }}</td>
							<td>{{ $trabajadors->cedula }}</td>
							<td>{{ $trabajadors->correo }}</td>
							<td>{{ $trabajadors->cargo }}</td>
							@if(($trabajadors->isActive)==1)
							<td>Si</td>
								@else <td>No</td>
							@endif

							<td>
								<button class="btn btn-warning open-modal" data-toggle="modal" data-target="#modal" value="{{$trabajadors->id}}">Edit</button>
								<!-- <a type="button" href="{{ route('deleteTrabajador', $trabajadors->id)}}" class="btn btn-danger delete-trabajadors" value="{{$trabajadors->id}}">Delete</a>-->
								<button class="btn btn-danger delete-trabajador" value="{{$trabajadors->id}}">Delete</button> 
								<form action="{{ url('trabajador/delete/:USER_ID') }}" method="DELETE" id="form-delete"></form>
									<input name="_method" type="hidden" value="DELETE" id="_method">
									<input name="_token" type="hidden" value="{{ csrf_token() }}" id="_token">
								</form>
							</td>
						</tr>
						@endforeach

					@else
					<tr>
						<td>No hay Trabajadores</td>
					</tr>
					@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div id="modal" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Editar Trabajador</h4>
	      </div>
		      <div class="modal-body">
		      	  <div class="form-group">
		            <label>Nombre</label>
		            <input type="text" id="modal-nombre" name="nombre" class="form-control" placeholder="Ingrese su Nombre">
		          </div>
		          <div class="form-group">
		            <label>Apellido</label>
		            <input type="text" id="modal-apellido" name="apellido" class="form-control" placeholder="Ingrese su Apellido">
		          </div>
		          <div class="form-group">
		            <label>Cedula</label>
		            <input type="number" readonly id="modal-cedula" name="cedula" class="form-control" placeholder="Ingrese su Cedula">
		          </div>
		           <div class="form-group">
				    <label>Correo</label>
				    <input type="email" id="modal-correo" readonly name="correo" class="form-control" placeholder="Ingrese su Correo">
				  </div>
		          <div class="form-group">
		            <label>Cargo</label>
		            <input type="text" id="modal-cargo" name="cargo" class="form-control" placeholder="Ingrese su Cargo">
		          </div>
		          <div class="form-group">
		            <label>Activo</label>
		            <select id="modal-activo">
		            	<option value="1">Si</option>
		            	<option value="0">No</option>
		            </select>
		          </div>
		          <input type="hidden" id="trabajador_id" name="id">
		      </div>
		      <div class="modal-footer">
		      	{{ csrf_field() }}
		        <button type="button" id="btn-cancel" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button class="btn btn-primary btn-save" data-toggle="modal">Guardar Cambios</button>
		      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</body>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/ajax.js"></script>
</html>