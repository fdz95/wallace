<div id="addUserModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_user_modal" id="add_user_modal">
				<div class="modal-header">
					<h4 class="modal-title">Agregar usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Usuario</label>
						<input type="user" name="user" id="user" placeholder="Ingrese el usuario..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Contrase&ntilde;a</label>
						<input type="password" name="password" id="password" placeholder="Ingrese la contrase&ntilde;a..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Tipo</label>
						<select class="form-control" name="user_tipo" id="user_tipo">
							<option selected>Seleccione el tipo de usuario</option>
							<option value='ADMIN'>ADMINISTRADOR</option>
							<option value='USER'>USUARIO</option>
							<option value='COCINA'>COCINA</option>
						</select>
					</div>
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="user_name" id="user_name" placeholder="Ingrese el nombre..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Apellido</label>
						<input type="text" name="user_lastname" id="user_lastname" placeholder="Ingrese el apellido..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Telefono/Celular</label>
						<input type="number" name="user_telephone" id="user_telephone" placeholder="Ingrese el numero..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Direccion</label>
						<input type="text" name="user_address" id="user_address" placeholder="Ingrese la direccion..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Localidad</label>
						<input type="text" name="user_city" id="user_city" placeholder="Ingrese la localidad..." class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label id="response_add_user"></label>
				</div>
				<div class="modal-footer justify-content-between">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="Agregar">
				</div>
			</form>
		</div>
	</div>
</div>