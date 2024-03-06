<?php
    use setasign\Fpdi\Fpdi;
    use setasign\Fpdi\PdfReader;

    $id = $_POST['id'];

    require_once('fpdf/fpdf.php');
    require_once('fpdi/src/autoload.php');

    include_once('cont/conexion.php');

    $query = "SELECT bitacora.id_bitacora ,bitacora.fecha, bitacora.fk_alumno ,formato_carta_comp.razon, CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombrec, alumno.fk_grado_grupo, grado_grupo.nombre, grado_grupo.turno FROM bitacora JOIN formato_carta_comp ON bitacora.id_bitacora=formato_carta_comp.fk_carta_comp JOIN alumno ON alumno.id_alumno=bitacora.fk_alumno JOIN grado_grupo ON alumno.fk_grado_grupo=grado_grupo.id_grupo WHERE bitacora.id_bitacora='$id'";
    $result = mysqli_query($conexion, $query);
    $data = mysqli_fetch_array($result);
    
       //Formato de fecha DD.MM.AAAA
       $dia = "";
       $dia .= $data['fecha'][0];
       $dia .= $data['fecha'][1];
   
       $mes = "";
       $mes .= $data['fecha'][3];
       $mes .= $data['fecha'][4];
   
       switch ($mes) {
           case "01":
               $mes="Enero"; break;
           case "02":
               $mes="Febrero"; break;
           case "03":
               $mes="Marzo"; break;
           case "04": 
               $mes="Abril"; break;
           case "05": 
               $mes="Mayo"; break;
           case "06": 
               $mes="Junio"; break;
           case "07":
               $mes="Julio"; break;
           case "08":
               $mes="Agosto"; break;
           case "09":
               $mes="Septiembre"; break;
           case "10":
               $mes="Octubre"; break;
           case "11":
               $mes="Noviembre"; break;
           case "12":
               $mes="Diciembre"; break;
       }
   
        $year = "20";
        $year .= $data['fecha'][8];
        $year .= $data['fecha'][9];
    
        $pdf = new Fpdi();

        $pageCount = $pdf->setSourceFile('formatos/carta_compromiso.pdf');
        $pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);
 
        $pdf->addPage();
        $pdf->SetFont('Arial','',11);

        //Dia
        $pdf->Cell(129);
        $pdf->Cell(0,46, $dia);
        //Mes
        $pdf->Cell(-45);
        $pdf->Cell(0,46, $mes);
        //Año
        $pdf->Cell(-7);
        $pdf->Cell(0,46, $data['fecha'][9]);

        //Nombre del alumno
        $pdf->Ln(60);
        $pdf->Cell(40);
        $pdf->Cell(0,47, utf8_decode($data['nombrec']));

        //Grado
        $pdf->Ln(6);
        $pdf->Cell(29);
        $pdf->Cell(0,50, $data['nombre'][0]);

        //Grupo
        $pdf->Cell(-124);
        $pdf->Cell(0,50, $data['nombre'][1]);

        //Turno
        $pdf->Cell(-90);
        $pdf->Cell(0,50, $data['turno']);

        //Razón
        $pdf->Ln(78);
        $pdf->Cell(10);
        $pdf->Cell(0,50, utf8_decode($data['razon']));


        $pdf->useImportedPage($pageId, 0, 0, 210);
        $fn = str_replace(" ","_",$data['nombrec']);
        $fn .="_carta_compromiso_".$dia.$mes.$year.".pdf";
        $pdf->Output('I', $fn);
    
    /*while() {

        echo "<tr>";
        echo "<td>".$data['fecha']."</td>
            <td>".utf8_encode($data['nombrec'])."</td>
            <td>".$data['nombre'][0]."</td>
            <td>".$data['nombre'][1]."</td>
            <td>".utf8_encode($data['razon'])."</td>
            <td><button type='button' class='btn btn-primary ver' id=".$data['id_bitacora']." ><i class='fas fa-print'></i></button>
            <button type='button' class='btn btn-danger borrar' id=".$data['id_bitacora']."><i class='far fa-trash-alt'></i></button></td>";
        echo "</tr>";
    }*/
?>