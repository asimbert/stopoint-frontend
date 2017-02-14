<?php
require_once('fpdf/fpdf.php');
require_once('fpdi/fpdi.php');

class ConcatPdf extends FPDI
{
    public $files = array();

    public function setFiles($files)
    {
        $this->files = $files;
    }

    public function concat()
    {
		$fcount = 0;
        foreach($this->files AS $file) {
            $pageCount = $this->setSourceFile($file);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                 $tplIdx = $this->ImportPage($pageNo);
                 $s = $this->getTemplatesize($tplIdx);
				 if($fcount==0){
                 $this->AddPage($s['w'] > $s['h'] ? 'L' : 'P', 'A4');
				 }else
				 $this->AddPage($s['w'] > $s['h'] ? 'L' : 'P', 'A4',270);
			 
                 $this->useTemplate($tplIdx);
            }
			
			$fcount++;
        }
    }
}


function rotatePdf($sourceFile, $outputFile, $degrees)
{
	$pdf = new FPDI;
	$pageCount = $pdf->setSourceFile($sourceFile); //the original file

	for ($i = 1; $i <= $pageCount; $i++) {
		$pageformat = array('Rotate' => $degrees);

		$tpage = $pdf->importPage($i);
		$size = $pdf->getTemplateSize($tpage);

		// get original page orientation
		//$orientation = $size['w'] > $size['h'] ? 'L' : 'P';
		$orientation = $size['w'] > $size['h'] ? 'L' : 'P';

		$pdf->AddPage($orientation, '', $degrees);
		$pdf->useTemplate($tpage);
	}

	$pdf->Output($outputFile, "I");
	
	
}


$ProductId = "STP1467634965";

//rotatePdf(dirname(__FILE__)."/shippinglabels/$ProductId.pdf", dirname(__FILE__)."/temp/$ProductId-temp.pdf", 270);

$cpdf = new ConcatPdf();
$cpdf->setFiles(array(dirname(__FILE__)."/temp/$ProductId.pdf", dirname(__FILE__)."/shippinglabels/$ProductId.pdf"));
$cpdf->concat();
$cpdf->Output(dirname(__FILE__)."/temp/PDF_FILE.pdf", "I");

//@unlink(dirname(__FILE__)."/temp/$ProductId.pdf");
//@unlink(dirname(__FILE__)."/temp/$ProductId-temp.pdf");

?>