<?php

require('./libraries/fpdf.php');

class PDF extends FPDF {
    var $data;
    var $mode;
    var $titulo;
    function defaultActions($title){
        $this->titulo=$title;
        $this->SetTopMargin(10);
        $this->SetCreator(utf8_decode('Generado con FPDF | ERP RRHH'));
        $this->SetAuthor('JRP');
        $this->SetFont('Times','',5);
        $this->SetLeftMargin(5);
    }

    /*
     * Escribe texto normal y tablas a partir de un array donde puede
     * haber texto o una matriz assosiativa
     */
    function doPdf($title,$data) {
        $this->defaultActions($title);
        $this->AddPage();


       $this->SetFont('Arial','',11);
        //Título
        $this->Cell(150,10,$this->titulo,0,0,'L');
        //Salto de línea
        $this->Ln(20);
        $this->SetY(25);
        $this->SetFont('Times','',5);
        $this->doTable($data);

    }

    function doTable($data) {
        if(is_array($data)) {
            $this->Table(array_keys($data[0]),$data);
        }else {
            if($data=='[break]') { $this->saltaPagina(); }
            else { $this->MultiCell(0,5, $data); }
        }
    }


    //Tabla simple
    function Table($header,$data) {
        $columnas=count($header);
        if($columnas>0){
            $cellWidth=300/$columnas;
            //Cabecera#1C94C4
            $this->SetFillColor(28,148,196);
            $this->SetTextColor(255);
            $this->SetDrawColor(28,148,196);

            $this->SetFont('','B');
            $i=0;
            foreach($header as $col){
                $col=utf8_decode($col);
                
                if($i==0)
                    $this->Cell($cellWidth-10,7,$col,1,0,'C',true);
                else
                    $this->Cell($cellWidth,7,$col,1,0,'C',true);
                $i++;
            }
            $this->Ln();

            //Datos
            $this->SetFillColor(255);
            $this->SetTextColor(0);
            $this->SetFont('');
            foreach($data as $row) {
                $i=0;
                foreach($row as $col){
                    $col=utf8_decode($col);
                    if($i==0){//primera columna
                        $this->Cell($cellWidth-10,5,$col,1);
                    }else{
                        $this->Cell($cellWidth,5,$col,1,0,'C',true);
                    }
                    $i++;
                }
                $this->Ln();
            }
        }
        $this->Ln();
    }

    function saltaPagina(){
        $numerpPagina=$this->PageNo();
        do{
            $this->ln(50);
        }while($numerpPagina!=$this->PageNo());
    }

    function ps($txt){
        return utf8_decode($txt);
    }


    //Pie de página
    function Footer() {
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',8);
        //Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/'.count($this->pages),0,0,'C');
        $this->SetY(-15);
        $this->Cell(0,10,$this->creator,0,0,'L');
        $this->SetY(-15);
        $this->Cell(0,10,date('d/m/Y'),0,0,'R');
    }
}

include 'includes/MDB.php';
include 'includes/Util.php';
include 'includes/session.php';
include 'includes/controlAcceso.php';
include 'includes/listados.php';

$title=utf8_decode("ERP RRHH");
$db=new MDB();
$data=listadoEmpleadosBaja($db);
$db->close();

if(isset ($data)){
    $pdf=new PDF('landscape');
    $pdf->doPdf($title, $data);
    $pdf->Output(/*$title,I*/);
}else{
     header('Location: index.php?error=no se han podido reunir los datos requeridos');
}

?>