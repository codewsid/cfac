<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Response;
use Barryvdh\Snappy\Facades\SnappyPdf;

class GeneratePDF extends Component
{
    public function render()
    {
        // return view('livewire.admin.generate-p-d-f');

    }

    public function generatePDF()
    {
        $pdf = SnappyPdf::loadView('livewire.admin.generate-p-d-f', [])
            ->setOption('footer-center', '[page]')
            ->setOption('disable-external-links', false)
            ->setOption('enable-local-file-access', true)
            ->setOption('enable-internal-links', true)
            ->inline();

        return Response::make($pdf, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
        ]);
    }
}
