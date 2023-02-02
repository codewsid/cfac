<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
// use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
// use Knp\Snappy\Pdf;
use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
// use Barryvdh\Snappy\Facades\SnappyPdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;

class Report extends Component
{
    public function render()
    {
        return view('livewire.admin.report');
    }

    public function viewPDFReport()
    {
        dd('Sample');
        $pdf = Pdf::loadHTML('<h1>Hello World</h1>');
        return $pdf->inline();
        // return PDF::loadFile('http://www.github.com')->inline('github.pdf');
    }
    // public function viewPDFReport()
    // {
    //     $this->dispatchBrowserEvent('success', ['message' => 'Fetching data from database... Please wait until the download is finished.']);

    //     return response()->streamDownload(function () {
    //         $users = User::select('first_name', 'last_name')->get();
    //         $pdf = App::make('dompdf.wrapper');

    //         $pdf->loadView(
    //             'feedback-form-pdf',
    //             ['users' => $users]
    //         );
    //         echo $pdf->stream();
    //     }, 'New name.pdf');
    // }
}
