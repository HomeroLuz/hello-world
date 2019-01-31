<!--
	@Autor: Homero Luz
-->
<?php
    include ('../controller/usersession.php');
    include('../config/config.php');

    $analysisRequestsList = "SELECT analysis.idAnalysis, analysis.title, analysis.type, analysis.registrationDate, analysis.sender, analysis.receiver, analysis.analysisCode, analysis.status, analysis.idCreator, analysis.idSample, specimen.name, specimen.alias, sample.sampleCode FROM analysis INNER JOIN sample ON analysis.idSample = sample.idSample INNER JOIN specimen ON sample.idSpecimen = specimen.idSpecimen WHERE analysis.status = 0";
    $result = $conexion->query($analysisRequestsList);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Solicitudes pendientes</title>   
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="../css/bootstrap.css"> 
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
	<?php
    	include('menu.php');
	?>
	<label class="formTitle">Solicitudes pendientes</label><br/>
	<table class="table">
		<tr>
            <th>No</th>
            <th>Titulo</th>
            <th>Tipo</th>
            <th>Emisor</th>
            <th>Receptor</th>
            <th>Código de analisis</th>
            <th>Fecha de registro</th>
            <th>Ejemplar Nombre-Alias</th>
            <th>Código de muestra</th>
            <th>Acciones</th>
        </tr>
        <?php
            $count = $result->num_rows;
            if($count > 0){
            	$i = 1;
                while ($row = $result->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['title']?></td>
                        <td>
                        	<?php 
                        		switch ($row['type']) {
                        			case 1:
                        				echo "Coprológico";
                        				break;
                        			case 2:
                        				echo "EGO";
                        				break;
                        			case 3:
                        				echo "Hematológico";
                        				break;
                        			case 4:
                        				echo "Citológico";
                        				break;
                        			case 5:
                        				echo "Gastroentérico";
                        				break;
                        			case 6:
                        				echo "Otros";
                        				break;
                        			default:
                        				break;
                        		}
                        	?>
                        </td>
                        <td><?php echo $row['sender']?></td>
                        <td><?php echo $row['receiver']?></td>
                        <td><?php echo $row['analysisCode']?></td>
                        <td><?php echo $row['registrationDate']?></td>
                        <td><?php echo $row['name']?> - <?php echo $row['alias']?></td>
                        <td><?php echo $row['sampleCode']?></td>
                        <td>
                            <a href="<?php echo "analysisDetail.php?opc=". $row['analysisCode'] ?> " class="link_detail">Ver detalle</a>
                        </td>
                    </tr>
                <?php
                $i++;    
                }
            }
            $result->free();
            $conexion->close();
        ?>
	</table>
	<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="../js/vendor/bootstrap.js"></script>
    <script src="../js/main.js"></script>
    <?php
        include('footer.php');
    ?>
</body>
</html>