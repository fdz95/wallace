<?php
	require_once ("conexion.php");
	$query_value_search = "";
	$query_search = "";
	// DEFINO EL FORMATO DE MONEDA
	setlocale(LC_MONETARY, 'es_ES');
	
	//main query to fetch the data
	$query_select_articulos = "SELECT * FROM t_articulos WHERE estado = 'A';";
	$result_select_articulos = mysqli_query($conexion,$query_select_articulos);
	if($result_select_articulos){
	?>
		
              <div class="card-body">
				<table  class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class='text-center'>ID</th>
							<th class='text-center'>Rubro</th>
							<th class='text-center'>Subrubro</th>
							<th class='text-center'>Tipo/Marca</th>
							<th class='text-center'>Articulo</th>
							<th class='text-center'>Descripcion</th>
							<th class='text-center'>Precio</th>
							<th class='text-center'>Stock</th>
							<th class='text-center'>Opciones</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if ($numrows = mysqli_num_rows($result_select_articulos) > 0){
						while($row = mysqli_fetch_array($result_select_articulos)){
							$getID = $row['Id'];
							$getRubro = $row['rubro'];
							$getSubRubro = $row['subrubro'];
							$getTipo = $row['tipo'];
							$getArticulo = $row['articulo'];
							$getDescrip = $row['descripcion'];
							$getPrecio = $row['precio'];
							$getProv = $row['proveedor'];
							$getStock = $row['stock'];
							$getImg = $row['img'];
							
								?>
								<tr>
									<td class='text-center'><?php echo $getID;?></td>
									<td class='text-center'><?php echo $getRubro;?></td>
									<td class='text-center'><?php echo $getSubRubro;?></td>
									<td class='text-center'><?php echo $getTipo;?></td>
									<td class='text-center'><?php echo $getArticulo;?></td>
									<td class='text-left'><?php echo $getDescrip;?></td>
									<td class='text-center'>$ <?php echo $getPrecio;?></td>
									<td class='text-center'><?php echo $getStock;?></td>
									<td align="center" width="15%"><?php
										echo "<a href='#' data-target='#editArtModal' class='edit' data-toggle='modal' data-id='$getID' data-rubro='$getRubro' data-subr='$getSubRubro' data-tipo='$getTipo' data-articulo='$getArticulo' data-descrip='$getDescrip' data-precio='$getPrecio' data-prov='$getProv' data-stock='$getStock' data-img='$getImg'><font color='blue'><i class='fas fa-edit'></i></a>&nbsp;&nbsp;&nbsp;
											<a href='#' data-target='#deleteArtModal' class='delete' data-toggle='modal' data-id='$getID' data-articulo='$getArticulo'><font color='red'><i class='fas fa-trash'></i></a>";
									?></td>
								</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
					<?php
					}else{
						echo "No hay registros agregados";
					}
	}else{
		echo "No se pudieron cargar los articulos . Error result_select_articulos";
	}
?>