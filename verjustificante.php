<?php
    use setasign\Fpdi\Fpdi;
    use setasign\Fpdi\PdfReader;

    $id = $_POST['id'];

    require_once('fpdf/fpdf.php');
    require_once('fpdi/src/autoload.php');

    include_once('cont/conexion.php');

    $query = "SELECT bitacora.id_bitacora ,bitacora.fecha, 
                formato_justificante.dias_justificar, formato_justificante.motivo, 
                CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombrec, alumno.fk_grado_grupo, 
                grado_grupo.nombre 
                FROM bitacora JOIN formato_justificante 
                ON bitacora.id_bitacora=formato_justificante.fk_justificante 
                JOIN alumno 
                ON alumno.id_alumno=bitacora.fk_alumno 
                JOIN grado_grupo 
                ON alumno.fk_grado_grupo=grado_grupo.id_grupo
                WHERE bitacora.id_bitacora='$id'";
    
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
    
        $year = "";
        $year .= $data['fecha'][8];
        $year .= $data['fecha'][9];
    
        $pdf = new Fpdi();
    
        $pageCount = $pdf->setSourceFile('formatos/justificante.pdf');
        $pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);
    
        $pdf->addPage();
        $pdf->SetFont('Arial','',9);

        //Dia
        $pdf->Cell(28);
        $pdf->Cell(0,37, $dia);
        //Mes
        $pdf->Cell(-145);
        $pdf->Cell(0,37, $mes);
        //Año
        $pdf->Cell(-119);
        $pdf->Cell(0,37, $year);

        //Nombre del alumno
        $pdf->Ln(2);
        $pdf->Cell(95);
        $pdf->Cell(0,48, utf8_decode($data['nombrec']));

        //Grado
        $pdf->Ln(3);
        $pdf->Cell(15);
        $pdf->Cell(0,50, $data['nombre'][0]);

        //Grupo
        $pdf->Cell(-145);
        $pdf->Cell(0,50, $data['nombre'][1]);

        //Dias a justificar
        $pdf->Ln(4);
        $pdf->Cell(40);
        $pdf->Cell(0,50, $data['dias_justificar']);

        //Dias a justificar
        $pdf->Ln(4);
        $pdf->Cell(15);
        $pdf->Cell(0,50, utf8_decode($data['motivo']));
        
        $pdf->useImportedPage($pageId, 0, 0, 210);

        $fn = str_replace(" ","_",$data['nombrec']);
        $fn .="_justificante_".$dia.$mes.$year.".pdf";
        $pdf->Output('I', $fn);
    /*while ($data = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "  <td>".$data['fecha']."</td>
                <td>".utf8_encode($data['nombrec'])."</td>
                <td>".$data['nombre'][0]."</td>
                <td>".$data['nombre'][1]."</td>
                <td>".$data['dias_justificar']."</td>
                <td>".$data['motivo']."</td>
                <td><button type='button' class='btn btn-primary ver' id=".$data['id_bitacora']." ><i class='fas fa-print'></i></button>
                <button type='button' class='btn btn-danger borrar' id=".$data['id_bitacora']."><i class='far fa-trash-alt'></i></button></td>";
        echo "</tr>";
    }*/
?>