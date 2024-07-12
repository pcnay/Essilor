<?php
	// Solo el administrador puede entrar a Reportes
	// Se realiza para que no entren desde la URL de la barra de direcciones
	if ($_SESSION["perfil"] == "Operador" || $_SESSION["perfil"] == "Supervisor")
	{
		echo '
			<script>
				window.location = "inicio";
			</script>';
			return;			
	}
  require_once('../fpdf.php');
	require_once('../../../controladores/empleados.controlador.php');
	require_once('../../../modelos/empleados.modelo.php');
	
  while (ob_get_level())
  ob_end_clean();
	
	header("Content-Encoding: None", true);
  
  class PDF extends FPDF
  {
    // Definiendo la cabecera
    function Header()
    {
			//Cell(Ancho,Alto,Texto,Border=1,SigLinea=1 0=SinSaltoLinea,'Centrado,Left,Right',Relleno 0=Sin 1=Con)
			
			$this->Image('../../../vistas/img/Logos/Essilor_Logo2.png',5,5,20);
			//$this->Image('Essilor_Logo2.png',5,5,20);
			$this->SetFont('Arial','B',8);			
			$this->Ln(-8);
			$this->Cell(35,10,'Blvd. 2000',0,0,'R');
			$this->Ln(3);
			$this->Cell(65,10,'Parque Industrial Nogales No. 23456',0,0,'R');			
			$this->Ln(3);
			
			$this->SetFont('Arial','B',12);
			$this->Cell(60);

			// Este valor "135" es para centrar, independiente del texto escrito
      $this->Cell(135,10,'REPORTE EMPLEADOS',0,0,'C');

			$this->Ln(4);
			$this->Cell(0,5,date('F j, Y, g:i a'),0,1,'R',0);
			$this->Ln(4);
			
			$this->SetX(2); // Alinear el texto al top del lado izquierdo.
      $this->Cell(20,5,'NTID',1,0,'C',0);
      $this->Cell(35,5,'APELLIDOS',1,0,'C',0);
      $this->Cell(35,5,'NOMBRE',1,0,'C',0);
			$this->Cell(60,5,'CORREO ELECT',1,0,'C',0);  
			$this->Cell(55,5,'PUESTO',1,0,'C',0);
			$this->Cell(25,5,'C.C.',1,0,'C',0); // 1,1 = Salto de Linea
			$this->Cell(38,5,'Depto',1,1,'C',0); // 1,1 = Salto de Linea
    }
    function Footer()
    {
      $this->SetY(-15);
      $this->SetFont('Arial','I',8);
      $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
    }
  }
  // 'L' = Horizontal(Acostada), 'P' = Vertical (Normal)
  // $pdf = new PDF('L','cm','Letter');
  $pdf = new PDF('L','mm','Letter');
  $pdf->AliasNbPages(); // Para determinar el número total de hojas.
  $pdf->AddPage();
	$pdf->SetFont('Arial','',9);
	
	// Imprimir los datos.
	$item = null;
	$valor = null;
	
	$empleados = ControladorEmpleados::ctrMostrarEmpleadosRep($item,$valor);
	
  //$inventarios = $inventario_controller->get();
  //Cell(Ancho,Alto,Texto,Border=1,SigLinea=1 0=SinSaltoLinea,'Centrado,Left,Right',Relleno 0=Sin 1=Con)
  // MultiCell(Ancho,AltoFuente(puntos),'Texto Largo',1=Border 0=SinBorder,'Alineacion',Fondo(0=SinFondo))
/*
  :"SELECT epo.id_epo,epo.num_serie,epo.num_inv,epo.num_parte,epo.id_tipo_componente,tc.descripcion AS componente,epo.id_marca,marca.descripcion AS marca,epo.id_modelo,modelo.descripcion AS modelo,epo.existencia,epo.comentarios FROM t_Equipo AS epo 
  INNER JOIN t_Tipo_Componente AS tc ON epo.id_tipo_componente = tc.id_tipo_componente
  INNER JOIN t_Marca AS marca ON epo.id_marca = marca.id_marca
  mar.descripcion AS mar.marca, mod.id_modelo AS mod.modelo FROM t_Refaccion AS r INNER JOIN t_Marca AS mar ON r.id_marca = mar.id_marca INNER JOIN t_Modelo AS mod ON r.id_modelo = mod.id_modelo
  INNER JOIN t_Modelo AS modelo ON epo.id_modelo = modelo.id_modelo";
  INNER JOIN t_Modelo AS mod ON r.id_modelo = mod.id_modelo
*/
/*
  $consulta = new Conexion();
  $consulta->query = "SELECT r.id_refaccion,r.descripcion,r.num_parte,r.existencia,r.fecha,mar.descripcion AS marca,modl.descripcion AS modelo,r.observaciones FROM t_Refaccion AS r 
  INNER JOIN t_Marca AS mar ON r.id_marca = mar.id_marca 
  INNER JOIN t_Modelo AS modl ON r.id_modelo = modl.id_modelo 
  ORDER BY r.descripcion ASC";
  //print_r ($consulta->query);
  //exit;
  $datos2 = $consulta->get_query();
	*/

	//Cell(Ancho,Alto,Texto,Border=1,SigLinea=1 0=SinSaltoLinea,'Centrado,Left,Right',Relleno 0=Sin 1=Con)
	
  for ($n=0;$n<count($empleados);$n++)
  {
		$pdf->SetX(2); // Alinear a la parte izq. casi al inicio del margen izquierdo
    //$pdf->Cell(10,5,$datos2[$n]['id_refaccion'],0,0,'L',0);
		$pdf->Cell(20,5,$empleados[$n]['ntid'],0,0,'L',0);
		$pdf->Cell(35,5,$empleados[$n]['apellidos'],0,0,'L',0);
		$pdf->Cell(35,5,$empleados[$n]['nombre'],0,0,'L',0);
		$pdf->Cell(60,5,$empleados[$n]['correo_electronico'],0,0,'L',0);
		$pdf->Cell(55,5,$empleados[$n]['Puesto'],0,0,'L',0);
		$pdf->Cell(25,5,$empleados[$n]['num_centro_costos'],0,0,'L',0);
		$pdf->Cell(30,5,$empleados[$n]['Depto'],0,1,'L',0);
	}

  $pdf->Output();
  ob_end_flush();
  
?>