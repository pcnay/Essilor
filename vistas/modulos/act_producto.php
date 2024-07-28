  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Actualizar Producto - CSV
      </h1>
      <ol class="breadcrumb">
        <li><a href="Inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reportes</li>
      </ol>
    </section>

		<div class="panel panel-default">
			<div class="panel-body">
			<br>
				<div class="row">
					<form action="" method="post" enctype="multipart/form-data" id="import_form">
						<div class="col-md-3">
							<input type="file" name="file" />
						</div>
						<div class="col-md-5">
							<input type="submit" class="btn btn-primary" name="import_inv" value="IMPORTAR">
						</div>
					</form>
				</div>
  		</div>
		</div>	
  <!-- /.content-wrapper -->

<?php

// Obtener los Modelos, Marcas, Perifericos.
	$tabla = "t_Modelo";
	$item = null;
	$valor = null;
	$Arreglo_modelos = ModeloModelos::mdlMostrarModelos($tabla,$item,$valor);
	
	
	$tabla = "t_Marca";
	$item = null;
	$valor = null;
	$Arreglo_marcas = ModeloMarcas::mdlMostrarMarcas($tabla,$item,$valor);
	
	
	$tabla = "t_Periferico";
	$item = null;
	$valor = null;
	$Arreglo_perifericos = ModeloPerifericos::mdlMostrarPerifericos($tabla,$item,$valor);
	
	//print_r('<br>');
	//var_dump($Arreglo_perifericos);
	//print_r('<br/>');
	//exit;
	//return;

	
	$tabla = "t_Ubicacion";
	$item = null;
	$valor = null;
	$Arreglo_ubicaciones = ModeloUbicaciones::mdlMostrarUbicaciones($tabla,$item,$valor);
		
	$tabla = "t_Linea";
	$item = null;
	$valor = null;
	$Arreglo_linea = ModeloLineas::mdlMostrarLineas($tabla,$item,$valor);
	
	

	// Pasandolo a un arreglo bidimencional los Modelos obtenidos
	$Modelos_Obtenidos = array();
	for ($q=0;$q<count($Arreglo_modelos);$q++)
	{
		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Modelos_Obtenidos[$q][$a] = $Arreglo_modelos[$q]["id_modelo"];
			if ($a == 1)
				$Modelos_Obtenidos[$q][$a] = strtolower($Arreglo_modelos[$q]["descripcion"]);
		}
		
	}

	// Pasandolo a un arreglo bidimencional las Marcas obtenidas
	$Marcas_Obtenidas = array();
	for ($q=0;$q<count($Arreglo_marcas);$q++)
	{
		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Marcas_Obtenidas[$q][$a] = $Arreglo_marcas[$q]["id_marca"];
			if ($a == 1)
				$Marcas_Obtenidas[$q][$a] = strtolower($Arreglo_marcas[$q]["descripcion"]);
		}
		
	}


	// Pasandolo a un arreglo bidimencional los Perifericos obtenidos
	$Perifericos_Obtenidos = array();
	for ($q=0;$q<count($Arreglo_perifericos);$q++)
	{
		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Perifericos_Obtenidos[$q][$a] = $Arreglo_perifericos[$q]["id_periferico"];
			if ($a == 1)
				$Perifericos_Obtenidos[$q][$a] = strtolower($Arreglo_perifericos[$q]["nombre"]);
		}
		
	}

	// Pasandolo a un arreglo bidimencional las Ubicaciones obtenidas
	$Ubicaciones_Obtenidas = array();
	for ($q=0;$q<count($Arreglo_ubicaciones);$q++)
	{
		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Ubicaciones_Obtenidas[$q][$a] = $Arreglo_ubicaciones[$q]["id_ubicacion"];
			if ($a == 1)
				$Ubicaciones_Obtenidas[$q][$a] = strtolower($Arreglo_ubicaciones[$q]["descripcion"]);
		}
		
	}

	// Pasandolo a un arreglo bidimencional las Lineas obtenidas
	$Lineas_Obtenidas = array();
	for ($q=0;$q<count($Arreglo_linea);$q++)
	{
		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Lineas_Obtenidas[$q][$a] = $Arreglo_linea[$q]["id_linea"];
			if ($a == 1)
				$Lineas_Obtenidas[$q][$a] = strtolower($Arreglo_linea[$q]["descripcion"]);
		}
		
	}
	
// Obtener la Marca.
function Obtener_IdMarca($Arreglo_marca,$reg_csv_marca)
{
	$columna_1 = 0;					
	
	//var_dump($Arreglo_marca[0]["id_modelo"]);
	
	$separar_cadena = explode(" ",$reg_csv_marca);
	//print ("Tamaño -separar_cadena- : ".count($separar_cadena));

	$Marcas = 'Sin Marcas';
	// $reg_csv_marca = Es la descripcion de Marca se captura en el archivo de Excel.

	// $Arreglo_marca = Arreglo bidimensional.
	for ($l=0;$l<count($Arreglo_marca);$l++)
	{
		for ($n=0;$n<2;$n++)
		{
			$cadena = trim($Arreglo_marca[$l][$n]);

			// if ( $cadena == $reg_csv_marca) // 'dell' ) // )
			if ( strcmp($cadena,trim($reg_csv_marca)) == 0)
			{
				//print_r('CUMPLE CONDICION');
				$Marcas = $Arreglo_marca[$l][0];
			}
			else
			{
				//print_r('NO Cumple Condicion');
			}

		} // for ($n=0;$n<2;$n++)


	} // for ($l=0;$l<count($Arreglo_marca);$l++)

	return $Marcas;

} // function Obtener_IdMarca() 

// Obtener el Modelo	
function Obtener_IdModelo($Arreglo_modelos,$reg_csv_modelo)
{
	$columna_1 = 0;					

	$separar_cadena = explode(" ",$reg_csv_modelo);

	$Modelos = "Sin Modelos";
	for ($l=0;$l<count($Arreglo_modelos);$l++)
	{
		for ($n=0;$n<2;$n++)
		{
			$cadena = trim($Arreglo_modelos[$l][$n]);

			// if ( $cadena == $reg_csv_marca) // 'dell' ) // )
			if ( strcmp($cadena,trim($reg_csv_modelo)) == 0)
			{
				//print_r('CUMPLE CONDICION');
				$Modelos = $Arreglo_modelos[$l][0];
			}
			else
			{
				//print_r('NO Cumple Condicion');
			}


		} // for ($n=0;$n<2;$n++)

	} // for ($l=0;$l<count($Arreglo_modelo);$l++)

	return $Modelos;

} // function Obtener_IdModelo() 


// Obtener el periferico.
function Obtener_IdPeriferico($Arreglo_perifericos,$reg_csv_perif)
{
	$columna_1 = 0;					
	$Perifericos = "Sin Perifericos";
	$separar_cadena = explode(" ",$reg_csv_perif);
	for ($l=0;$l<count($Arreglo_perifericos);$l++)
	{
		for ($n=0;$n<2;$n++)
		{
			$contador_pal = 0;

			$cadena = trim($Arreglo_perifericos[$l][$n]);

			// if ( $cadena == $reg_csv_marca) // 'dell' ) // )
			if ( strcmp($cadena,trim($reg_csv_perif)) == 0)
			{					
				$Perifericos = $Arreglo_perifericos[$l][0];

			}
			else
			{
				//print_r('NO Cumple Condicion');
			}

		} // for ($n=0;$n<2;$n++)			

	} // for ($l=0;$l<count($Arreglo_periferico);$l++)

	//print_r('Periferico'.$Perifericos);
	//exit;
	//return;

	return $Perifericos;

} // function Obtener_IdPerifericos() 

// Obtener la Ubicacion.
function Obtener_IdUbicacion($Arreglo_ubicaciones,$reg_csv_ubic)
{
	$columna_1 = 0;					
	$Ubicacion = "Sin Ubicacion";
	$separar_cadena = explode(" ",$reg_csv_ubic);
	for ($l=0;$l<count($Arreglo_ubicaciones);$l++)
	{
		for ($n=0;$n<2;$n++)
		{
			$contador_pal = 0;
			$cadena = trim($Arreglo_ubicaciones[$l][$n]);

			// if ( $cadena == $reg_csv_marca) // 'dell' ) // )
			if ( strcmp($cadena,trim($reg_csv_ubic)) == 0)
			{					
				$Ubicacion = $Arreglo_ubicaciones[$l][0];				
			}
			else
			{
				//print_r('NO Cumple Condicion');
			}
		} // for ($n=0;$n<2;$n++)			

	} // for ($l=0;$l<count($Arreglo_ubicaciones);$l++)
	
	return $Ubicacion;

} // function Obtener_IdUbicaciones() 

// Obtener la Linea.
function Obtener_IdLinea($Arreglo_linea,$reg_csv_linea)
{
	$columna_1 = 0;					
	$Linea = "Sin Linea";
	$separar_cadena = explode(" ",$reg_csv_linea);
	for ($l=0;$l<count($Arreglo_linea);$l++)
	{
		for ($n=0;$n<2;$n++)
		{
			$contador_pal = 0;
			$cadena = trim($Arreglo_linea[$l][$n]);

			// if ( $cadena == $reg_csv_marca) // 'dell' ) // )
			if ( strcmp($cadena,trim($reg_csv_linea)) == 0)
			{					
				$Linea = $Arreglo_linea[$l][0];				
			}
			else
			{
				//print_r('NO Cumple Condicion');
			}

		} // for ($n=0;$n<2;$n++)			

	} // for ($l=0;$l<count($Arreglo_linea);$l++)
	return $Linea;

} // function Obtener_IdLinea() 

	function Eliminar_Espacios($cadena)
	{
		$sin_espacios = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $cadena);
		return $sin_espacios;
	}

	// Importando el archivo CSV
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
		{
			if(is_uploaded_file($_FILES['file']['tmp_name']))
			{
				$csv_file_it = fopen($_FILES['file']['tmp_name'], 'r');
				//fgetcsv($csv_file);
				// get data records from csv file
				
				$datos_grabar = array();
				$num_reg_no_existen = 0;
				$num_reg_act = 0;
				$serial_blanco = 0;
				$num_reg_no_act = 0;				

				while(($inv_it = fgetcsv($csv_file_it)) !== FALSE)
				{

					// **** Para Actualizar campos de la tabla "t_Productos"T
								
					// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
					// $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));


					// Revisando si el Serial esta vacio.
					if (!empty($inv_it[0])) 
					{
						$tabla = "t_Productos";
						$item = "num_serie";
						$valor = $inv_it[0];
						$orden = "nombre";
						$existe_prod = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
						if ($existe_prod)
						{						
							print_r('<br>');
							print_r('Existe Producto ');
							print_r('<br/>');
							

							//MdeloProductos::mdlActualizarProducto($tabla,$item1,$valor1,$valor2);

							// Actualiza el campo de la tabla del producto.
							// $campo_tabla($item1) = Actualizar de forma dinamica, Stok, precio, descripicon,
							// $valor1 = Es el valor del campo($item1) a modificar
							// $valor2 = Es el valor del "id" que se quiere modificar.

							// Determinando el campo que se desea modificar.
							$tabla = "t_Productos";
							$id_producto = $existe_prod['id_producto'];

							// Obteniendo el campo que se desea actualizar,

							if (!empty($inv_it[1])) // Periferico
							{
								print ('<br');
								print_r("Periferico NO esta Vacioa");
								print("<br/>");
								exit;
								return;

								$campo_tabla = 'periferico';
								$periferico_sinEspacios = Eliminar_Espacios($inv_it[1]);							
								$Periferico = Obtener_IdPeriferico($Perifericos_Obtenidos,strtolower($periferico_sinEspacios));			

								$valor_campo_tabla = $Periferico;								
								print ('<br');
								print_r("Valor Campo Tabla ".$valor_campo_tabla);
								print("<br/>");

							}
							else
							{
								$campo_tabla = 'periferico';
								$valor_campo_tabla = 1;
							}

							
							if (!empty($inv_it[22])) // Estacion
							{
								$campo_tabla = 'estacion';
								$valor_campo_tabla = $inv_it[22];
							}
							else
							{
								$campo_tabla = 'estacion';
								$valor_campo_tabla = Null;
							}

							$Actualizar_Epo = ModeloProductos::mdlActualizarProducto($tabla,$campo_tabla,$valor_campo_tabla,$id_producto);
							
							// id_producto = 115
							// Campo Modificar = Estacion (10)

							$num_reg_act++;	
							
						} // if ($existe_prod)
						else
						{
							$num_reg_no_act++;	
							print("<br>");
							print_r("Serial NO Actualizados ===> : ".$inv_it[0]);
							print "<br/>";
						}

					} // 	if (!empty($inv_it[4]))
					else
					{
						$serial_blanco++;
						print_r('<br>');
						print_r('Serial En Blanco = '.$inv_it[0].' ; ');
						print_r('<br/>');
					}

				} // while(($inv_it = fgetcsv($csv_file_it)) !== FALSE)

				print("<br>");
				print_r("Seriales Actualizados ===> : ".$num_reg_act);				
				print "<br/>";							
				print("<br>");
				print_r("Seriales NO Actualizados ===> : ".$num_reg_no_act);				
				print "<br/>";							

				
			}	//if(is_uploaded_file($_FILES['file']['tmp_name']))

		} // if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
		
				
?>
 