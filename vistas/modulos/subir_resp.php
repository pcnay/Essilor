<?php
	//print_r ("variable ".$_GET["Ntid_Emp"]);
	
	$formatos = array('.jpg','.png','.doc','.xlsx','.pdf');	
	$directorio = '../img/empleados/'.$_GET['Ntid_Emp'];
	mkdir ($directorio,0777);

	$contador = 0;

	if (isset($_POST['boton']))
	{
		$nombreArchivo = $_FILES['archivo']['name'];
		$nombreTmpArchivo = $_FILES['archivo']['tmp_name'];
		$ext = substr($nombreArchivo,strrpos($nombreArchivo,'.'));

		//echo'<pre>';print_r($nombreTmpArchivo);echo'</pre>';
		//echo'<pre>';print_r($directorio.'/'.$nombreArchivo);echo'</pre>';
		//exit;

		
		if (in_array($ext,$formatos))
		{
			if (move_uploaded_file($nombreTmpArchivo,$directorio.'/'.$nombreArchivo))
			{
				//echo "Subido correctamente $nombreArchivo";				
			}
			else
			{
				echo "Error al subir el archivo";
			}
		}
		else
		{
			echo "Archivo no permitido";
		}
	}

?>


<!doctype html>
<html>
<head>
<title>Cargar Documentos</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<!-- <link rel="stylesheet" href="../bower_components/subir_archivos/bootstrap.min.css" > -->


<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
<style>
.navbar {
	position: relative;
	min-height: 50px;
	margin-bottom: 5px;
}
</style>
</head>
<body>
<div role="navigation" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a href="#" class="navbar-brand"></a> </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
</div>

<div class="container">
  <div class="row">
    <h4>Agregar Nueva Descarga</h4>
    <hr style="margin-top:5px;margin-bottom: 5px;">
    <div class="content"> </div>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Cargar Ficheros</h3>
      </div>
      <div class="panel-body">
        <div class="col-lg-6">
          <form method="POST" action="" enctype="multipart/form-data">
<div class="form-group">
              <label class="btn btn-primary" for="my-file-selector">
                <input required="" type="file" name="archivo" id="exampleInputFile">
              </label>
              
</div>
          <button class="btn btn-primary" name="boton" type="submit">Cargar Fichero</button>
          </form>
        </div>
        <div class="col-lg-6"> </div>
      </div>
    </div>
  
<!--tabla-->
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Descargas Disponibles</h3>
      </div>
      <div class="panel-body">
   
<table class="table">
  <thead>
    <tr>
      <th width="7%">#</th>
      <th width="70%">Nombre del Archivo</th>
      <th width="13%">Descargar</th>
      <th width="10%">Eliminar</th>
    </tr>
  </thead>
  <tbody>
<?php

// $directorio = '../img/empleados/'.$_GET['Ntid_Emp'];
$directorio = '../img/empleados/'.$_GET['Ntid_Emp'];
//$archivos = scandir("subidas");
$archivos = scandir($directorio);
//$archivos = 5;

$num=0;
for ($i=2; $i<count($archivos); $i++)
//for ($i=2; $i<=5; $i++)
{$num++;
?>
<p>  
 </p>
         
    <tr>
      <th scope="row"><?php echo $num;?></th>
      <td><?php echo $archivos[$i]; ?></td>
      <td><a title="Descargar Archivo" href="<?php echo $directorio.'/'; ?><?php echo $archivos[$i]; ?>" download="<?php echo $archivos[$i]; ?>" style="color: blue; font-size:18px;"> <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> </a></td>
      <td><a title="Eliminar Archivo" href="Eliminar.php?name=<?php echo $directorio;?>/<?php echo $archivos[$i]; ?>" style="color: red; font-size:18px;" onclick="return confirm('Esta seguro de eliminar el archivo?');"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </a></td>
    </tr>
 <?php }?> 

  </tbody>
</table>
</div>
</div>
<!-- Fin tabla--> 
  </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>