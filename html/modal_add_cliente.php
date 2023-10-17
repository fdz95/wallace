<div id="addClienteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_cliente_modal" id="add_cliente_modal">
				<div class="modal-header">
					<h4 class="modal-title">Agregar cliente</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="add_cliente_nombre" id="add_cliente_nombre" placeholder="Ingrese el nombre..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Apellido</label>
						<input type="text" name="add_cliente_apellido" id="add_cliente_apellido" placeholder="Ingrese el apellido..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Descuento %</label>
						<input type="number" name="add_cliente_descuento" id="add_cliente_descuento" placeholder="Ingrese el descuento..." value="0" class="form-control" />
					</div>
					<div class="form-group">
						<label>Telefono/Celular</label>
						<input type="number" name="add_cliente_celular" id="add_cliente_celular" placeholder="Ingrese el telefono/celular..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Direccion</label>
						<input type="text" name="add_cliente_direccion" id="add_cliente_direccion" placeholder="Ingrese la direccion..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Localidad</label>
						<input type="text" name="add_cliente_localidad" id="add_cliente_localidad" placeholder="Ingrese la localidad..." class="form-control" />
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="Agregar">
				</div>
			</form>
		</div>
	</div>
</div>