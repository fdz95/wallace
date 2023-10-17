<div id="editArtModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="edit_art_modal" id="edit_art_modal">
				<div class="modal-header">
					<h4 class="modal-title">Editar articulo</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id_edit_art" id="id_edit_art">
					<div class="form-group">
						<label>Rubro</label>
						<input type="text" name="edit_art_rubro" id="edit_art_rubro" placeholder="Ingrese el rubro..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Sub Rubro</label>
						<input type="text" name="edit_art_subrubro" id="edit_art_subrubro" placeholder="Ingrese el subrubro..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Tipo</label>
						<input type="text" name="edit_art_tipo" id="edit_art_tipo" placeholder="Ingrese el tipo..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Articulo</label>
						<input type="text" name="edit_art_articulo" id="edit_art_articulo" placeholder="Ingrese el articulo..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Descripcion</label>
						<input type="text" name="edit_art_descrip" id="edit_art_descrip" placeholder="Ingrese una descripcion..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Precio</label>
						<input type="number" name="edit_art_precio" id="edit_art_precio" placeholder="Ingrese el precio..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Proveedor</label>
						<input type="text" name="edit_art_prov" id="edit_art_prov" placeholder="Ingrese el proveedor..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Stock</label>
						<input type="number" name="edit_art_stock" id="edit_art_stock" placeholder="Ingrese stock..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Imagen</label>
						<input type="text" name="edit_art_img" id="edit_art_img" class="form-control" />
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="Guardar">
				</div>
			</form>
		</div>
	</div>
</div>