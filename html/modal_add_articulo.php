<div id="addArtModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="add_art_modal" id="add_art_modal">
				<div class="modal-header">
					<h4 class="modal-title">Agregar articulo</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div name='add_rubro_select' id='add_rubro_select' class="form-group"></div>
					</div>
					<div class="form-group">
						<div name='add_subrubro_select' id='add_subrubro_select' class="form-group"><b>Subrubros</b></div>
					</div>
					
					<div class="form-group">
						<label>Tipo/Marca</label>
						<input type="text" name="add_art_tipo" id="add_art_tipo" placeholder="Ingrese el tipo..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Articulo</label>
						<input type="text" name="add_art_articulo" id="add_art_articulo" placeholder="Ingrese el articulo..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Descripcion</label>
						<textarea name="add_art_descrip" id="add_art_descrip" rows="4" cols="50" placeholder="Ingrese una descripcion..." class="form-control"></textarea>
					</div>
					
					<div class="form-group">
						<label>Precio</label>
						<input type="number" name="add_art_precio" id="add_art_precio" placeholder="Ingrese el precio..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Proveedor</label>
						<input type="text" name="add_art_prov" id="add_art_prov" placeholder="Ingrese el proveedor..." class="form-control" />
					</div>
					
					<div class="form-group">
						<label>Stock</label>
						<input type="number" name="add_art_stock" id="add_art_stock" placeholder="Ingrese stock..." class="form-control" />
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