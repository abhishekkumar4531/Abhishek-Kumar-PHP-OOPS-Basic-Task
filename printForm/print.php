<?php
  session_start();
  require "../vendor/autoload.php";

  use Fpdf\Fpdf;

  class PDF extends Fpdf
  {
  function Header()
  {
      $this->SetFont('Arial','B',15);
      $this->Cell(0,10,'You Registered sucessfully!',1,0,'C');
      $this->Ln(10);
  }

  function Footer()
  {
      $this->SetY(-15);
      $this->SetFont('Arial','I',8);
      $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
  }
  }

  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',15);
  $pdf->Cell(0,12,'',0,1);
  $pdf->Cell(40,16,'Full-Name : ',1,0);
  $pdf->Cell(90,16,$_SESSION['user_name'],1,1,'C');
  $pdf->Cell(40,16,'Email-Adress : ',1,0);
  $pdf->Cell(90,16,$_SESSION['user_email'],1,1,'C');
  $pdf->Cell(40,16,'Phone-Nmber : ',1,0);
  $pdf->Cell(90,16,$_SESSION['user_phone'],1,1,'C');
  $pdf->Image($_SESSION['user_image'],150,30,50,50);

  $i=0;
  $pdf->Cell(0,15,'',0,1);
  $pdf->Cell(5,8,'',0,0);
  $pdf->Cell(40,8,'Sl. No.',1,0,'C');
  $pdf->Cell(70,8,'Subject-Name',1,0,'C');
  $pdf->Cell(70,8,'Subject-Marks',1,0,'C');
  $pdf->Cell(15,8,'',0,1);
  foreach($_SESSION['sub_data'] as $subname => $submarks){
    $i++;
    $pdf->Cell(5,8,'',0,0);
    $pdf->Cell(40,8,$i. '.',1,0,'C');
    $pdf->Cell(70,8,$subname,1,0,'C');
    $pdf->Cell(70,8,$submarks,1,0,'C');
    $pdf->Cell(15,8,'',0,1);
  }

  $pdf->Output();

?>