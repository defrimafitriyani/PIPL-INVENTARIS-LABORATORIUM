<?php
require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf {
    public function createPDF($html, $filename, $stream = TRUE) {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if ($stream) {
            $dompdf->stream($filename, array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }
}
