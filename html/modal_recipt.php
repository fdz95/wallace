<div id="reciptModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="recipt_modal" id="recipt_modal">
				<div class="modal-header">
					<h4 class="modal-title"><label id="id_recipt_title_mesa"></label></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id_recipt_mesa" id="id_recipt_mesa">
					<input type="hidden" name="id_comanda_recipt" id="id_comanda_recipt">
					<input type="hidden" name="id_num_cliente_recipt" id="id_num_cliente_recipt">
					<input type="hidden" name="id_importe_original" id="id_importe_original">
					<input type="hidden" name="id_importe_final" id="id_importe_final">
					
					<div class="form-group">
						<div id="id_recipt_cliente" class="form-group"></div>
					</div>
					
					<div id="id_recipt_articulos" class="form-group"></div>
					<input type="hidden" name="recipt_importe_desc" id="recipt_importe_desc"></br>
					
					<div class="col-12">
						<div class="form-group">
							<span class="input-group-append">
								<label>Descuento</label>&nbsp;&nbsp;
								<input type="number" style="width:20%" name="recipt_desc" id="recipt_desc" placeholder="%" class="form-control" />&nbsp;&nbsp;
								<input type="button" class="btn btn-info" onclick="getDiscount()" value="Aplicar">&nbsp;&nbsp;
								<label id="id_label_recipt_desc"></label>
								<input type="hidden" name="id_importe_desc" id="id_importe_desc">
							</span>
						</div>
					</div>
					
					<div class="form-group">
						<label id="label_articulo">Metodo de pago</label>
						<select class='form-control' name='recipt_met_pago' id='recipt_met_pago'>
							<option selected>Seleccione un metodo de pago</option>
							<option value='EFECT' selected>EFECTIVO</option>
							<option value='TDEBI'>TARJ. DEBITO</option>
							<option value='TCRED'>TARJ. CREDITO</option>
						</select>
					</div>
					<div class="form-group">
						<label>Notas</label>
						<textarea id="recipt_nota" name="recipt_nota" rows="4" cols="50" class="form-control"></textarea>
					</div>
				</div>
				<label id="id_recipt_alert"></label>
				<div class="modal-footer justify-content-between">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="button" class="btn btn-success" onclick="printRecipt()"  value="Imprimir recibo">
				</div>
			</form>
		</div>
	</div>
</div>