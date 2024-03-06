<?php
    use setasign\Fpdi\Fpdi;
    use setasign\Fpdi\PdfReader;

    $id = $_POST['id'];

    require_once('fpdf/fpdf.php');
    require_once('fpdi/src/autoload.php');

    include_once('cont/conexion.php');

    $query = "SELECT bitacora.id_bitacora ,bitacora.fecha, bitacora.fk_alumno, 
            formato_citatorio.nombre_padre, formato_citatorio.fecha_citatorio, formato_citatorio.hora_citatorio, 
            CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombrec, alumno.fk_grado_grupo, 
            grado_grupo.nombre 
            FROM bitacora JOIN formato_citatorio 
            ON bitacora.id_bitacora=formato_citatorio.fk_citatorio 
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

    $year = "20";
    $year .= $data['fecha'][8];
    $year .= $data['fecha'][9];

    $pdf = new Fpdi();

    $pageCount = $pdf->setSourceFile('formatos/citatorio.pdf');
    $pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

    $pdf->addPage();
    $pdf->SetFont('Arial','',11);

    //Dia
    $pdf->Ln(36);
    $pdf->Cell(105);
    $pdf->Cell(0,49, $dia);
    //Mes
    $pdf->Cell(-55);
    $pdf->Cell(0,49, $mes);
    //Año
    $pdf->Cell(-10);
    $pdf->Cell(0,49, $data['fecha'][9]);

    //Nombre del padre/tutor
    $pdf->Ln(5);
    $pdf->Cell(18);
    $pdf->Cell(0,49, utf8_decode($data['nombre_padre']));

    //Dia cita
    $dia_cita = "";
    $dia_cita .= $data['fecha_citatorio'][0];
    $dia_cita .= $data['fecha_citatorio'][1];

    $mes_cita = "";
    $mes_cita .= $data['fecha_citatorio'][3];
    $mes_cita .= $data['fecha_citatorio'][4];

    switch ($mes_cita) {
        case "01":
            $mes_cita="Enero"; break;
        case "02":
            $mes_cita="Febrero"; break;
        case "03":
            $mes_cita="Marzo"; break;
        case "04": 
            $mes_cita="Abril"; break;
        case "05": 
            $mes_cita="Mayo"; break;
        case "06": 
            $mes_cita="Junio"; break;
        case "07":
            $mes_cita="Julio"; break;
        case "08":
            $mes_cita="Agosto"; break;
        case "09":
            $mes_cita="Septiembre"; break;
        case "10":
            $mes_cita="Octubre"; break;
        case "11":
            $mes_cita="Noviembre"; break;
        case "12":
            $mes_cita="Diciembre"; break;
    }
    $pdf->Ln(14);
    $pdf->Cell(70);
    $pdf->Cell(0,50, $dia_cita);

    //Mes cita
    $pdf->Cell(-85);
    $pdf->Cell(0,50, $mes_cita);

    //Hora Cita
    $pdf->Ln(7);
    $pdf->Cell(90);
    $pdf->Cell(0,50, $data['hora_citatorio']." hrs");

    //Nombre alumno
    $pdf->Ln(7);
    $pdf->Cell(60);
    $pdf->Cell(0,50, utf8_decode($data['nombrec']));
    
    //Grado
    $pdf->Ln(7);
    $pdf->Cell(13);
    $pdf->Cell(0,50, $data['nombre'][0]);

    //Grupo
    $pdf->Cell(-138);
    $pdf->Cell(0,50, $data['nombre'][1]);

    $pdf->useImportedPage($pageId, 0, 0, 210);

    $fn = str_replace(" ","_",$data['nombrec']);
    $fn .="_citatorio_".$dia.$mes.$year.".pdf";
    $pdf->Output('I', $fn);

    /*while () {
        echo "<tr>";
        echo "  <td>".$data['fecha']."</td>
                <td>".utf8_encode($data['nombrec'])."</td>
                <td>".utf8_encode($data['nombre_padre'])."</td>
                <td>".$data['nombre'][0]."</td>
                <td>".$data['nombre'][1]."</td>
                <td>".$data['fecha_citatorio']."</td>
                <td>".$data['hora_citatorio']."</td>
                <td><button type='button' class='btn btn-primary ver' id=".$data['id_bitacora']." ><i class='fas fa-print'></i></button>
                <button type='button' class='btn btn-danger borrar' id=".$data['id_bitacora']."><i class='far fa-trash-alt'></i></button></td>";
        echo "</tr>";
    }*/
?>