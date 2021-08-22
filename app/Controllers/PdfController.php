<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PdfController extends Controller
{

    public function download_order()
    {
        $dompdf = new \Dompdf\Dompdf();

        $dompdf->loadHtml(view(''));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
        return redirect()->to(base_url('order_confirmation'));
    }
}
