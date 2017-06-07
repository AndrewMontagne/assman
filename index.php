<?php

require_once "vendor/autoload.php";
require_once "PDF_Code128.php";

$pdf = new PDF_Code128();

$leftMargin = 5.95;
$rightMargin = 5.95;
$topMargin = 15.95;
$bottomMargin = 15.95;
$verticalPitch = 12.7;
$horizontalPitch = 50.7;
$width = 46;
$height = 11.1;
$numberAcross = 4;
$numberDown = 21;

$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Courier','B',8);

$numberToMake = is_null($_GET['qty']) ? 0 : (int)$_GET['qty'];
$numberToSkip = is_null($_GET['skip']) ? 0 : (int)$_GET['skip'];
$codePrefix = is_null($_GET['prefix']) ? "" : $_GET['prefix'];

if ($numberToMake == 0) {
    $numberToMake = ($numberAcross * $numberDown) - $numberToSkip;
}

$numberMade = 0;
$numberSkipped = 0;

for ($y = 0; $y < $numberDown; $y++) {
    for ($x = 0; $x < $numberAcross; $x++) {
        if ($numberSkipped < $numberToSkip) {
            $numberSkipped++;
        }
        else if ($numberMade < $numberToMake) {
            $xPos = $leftMargin + ($horizontalPitch * $x);
            $yPos = $topMargin + ($verticalPitch * $y);

            $code = $codePrefix . strtoupper(substr(sha1(uniqid()), 0, 6));

            $pdf->Code128($xPos + 5, $yPos + 2, $code, $width - 10, $height / 3);
            $pdf->SetXY($xPos, $yPos + ($height / 2) - 1);
            $pdf->Cell($width, $height / 2, $code, '0', 0, 'C');
            $numberMade++;
        } else {
            break;
        }
    }
}

$pdf->Output();