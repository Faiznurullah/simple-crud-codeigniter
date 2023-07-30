<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Belanja;

class ExportPdf extends BaseController
{
    public function exportPDF()
    {

        $data = new Belanja();

        // Load the view to be converted to PDF
        $databelanja['belanjas'] = $data->findAll();

        $html = view('pdf_template', $databelanja); // pdf_template is the name of your view file

        // Configure Dompdf options
        $options = new Options();
        $options->set('defaultFont', 'Arial');

        // Instantiate Dompdf with the configured options
        $dompdf = new Dompdf($options);

        // Load the HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('data_belanja.pdf', ['Attachment' => false]);
    }
}
