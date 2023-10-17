<div id="comandaModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="comanda_modal" id="comanda_modal">
				<div class="modal-header">
					<h4 class="modal-title">Generar comanda</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="comanda_random" id="comanda_random">
					
					<div class="form-group">
						<label>Mesa</label>
						<div name="comanda_select_mesa" id="comanda_select_mesa" class="form-group"></div>
					</div>
					<div class="form-group">
						<label>Cliente</label>
						<div name="comanda_select_cliente" id="comanda_select_cliente" class="form-group"></div>
					</div>
					<div class="form-group">
						<label>Rubro</label>
						<input type="hidden" name="comanda_add_rubro" id="comanda_add_rubro">
						<div name="comanda_select_rubro" id="comanda_select_rubro" class="form-group"></div>
					</div>
					</br>
					<div class="form-group">
						<label id="id_label_comanda_subrubro">Subrubro</label></br>
						<input type="hidden" name="comanda_add_subrubro" id="comanda_add_subrubro">
						<div name="comanda_select_subrubro" id="comanda_select_subrubro" class="form-group"></div>
					</div>
					<div class="form-group">
						<label id="id_label_comanda_articulos">Articulos</label>
						<div name="comanda_select_articulo" id="comanda_select_articulo" class="form-group"></div>
					</div>
					<div class="form-group">
						<label>Cantidad</label>
						<input type="number" name="comanda_add_cantidad" id="comanda_add_cantidad" placeholder="Ingrese la cantidad..." class="form-control" />
					</div>
					<div class="form-group">
						<label>Notas</label>
						<textarea name="comanda_add_nota" id="comanda_add_nota" rows="4" cols="50" class="form-control"></textarea>
					</div>
					<input type="button" onclick="agregarComandaTemp()" class="btn btn-info" value="Agregar" /></br></br></br>
					<label name="comanda_temp" id="comanda_temp" class="form-group"></label>
				</div>
				<div class="modal-footer justify-content-between">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<label><input type="checkbox" id="comanda_check_print" value="TRUE"> Imprimir comanda</label>
					<input type="submit" class="btn btn-success" value="Listo">
				</div>
			</form>
		</div>
	</div>
</div>