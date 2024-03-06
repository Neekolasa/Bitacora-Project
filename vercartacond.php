<?php
    use setasign\Fpdi\Fpdi;
    use setasign\Fpdi\PdfReader;

    $id = $_POST['id'];

    require_once('fpdf/fpdf.php');
    require_once('fpdi/src/autoload.php');

    include_once('cont/conexion.php');

    $query = "SELECT bitacora.id_bitacora ,bitacora.fecha, bitacora.fk_alumno,
            formato_carta_cond.retribucion, formato_carta_cond.nombre_padre,
            CONCAT(alumno.nombre,' ', alumno.ape_paterno,' ', alumno.ape_materno) as nombrec, alumno.fk_grado_grupo,
            grado_grupo.nombre 
            FROM bitacora 
            JOIN formato_carta_cond 
            ON bitacora.id_bitacora=formato_carta_cond.fk_carta_cond 
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

    $pageCount = $pdf->setSourceFile('formatos/carta_condicionamiento.pdf');
    $pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

    $pdf->addPage();
    $pdf->SetFont('Arial','',11);

    //Dia
    $pdf->Cell(108);
    $pdf->Cell(0,48, $dia);
    //Mes
    $pdf->Cell(-52);
    $pdf->Cell(0,48, $mes);
    //Año
    $pdf->Cell(-14);
    $pdf->Cell(0,48, $year);

    //Nombre del alumno
    $pdf->Ln(37);
    $pdf->Cell(18);
    $pdf->Cell(0,49, utf8_decode($data['nombrec']));

    //Grado 
    $pdf->Cell(-61);
    $pdf->Cell(0,49, $data['nombre'][0]);

    //Grupo
    $pdf->Cell(-30);
    $pdf->Cell(0,49, $data['nombre'][1]);

    //Retribución
    $pdf->Ln(37);
    $pdf->Cell(5);
    $pdf->Cell(0,50, utf8_decode($data['retribucion']));

    //Padre/Tutor
    $pdf->Ln(19);
    $pdf->Cell(10);
    $pdf->Cell(0,50, utf8_decode($data['nombre_padre']));

    $pdf->useImportedPage($pageId, 0, 0, 210);

    $fn = str_replace(" ","_",$data['nombrec']);
    $fn .="_carta_condicionamiento_".$dia.$mes.$year.".pdf";
    $pdf->Output('I', $fn);
    /*
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('formatos/carta_condicionamiento.jpg','0','0','200','300','JPG');					
			//IMAGE (RUTA,X,Y,ANCHO,ALTO,EXTEN)
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,100,'¡Hola, Mundo!');
    $pdf->Output();
    */
?>