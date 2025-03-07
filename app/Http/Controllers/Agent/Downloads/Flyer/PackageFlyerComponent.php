<?php

namespace App\Http\Controllers\Agent\Downloads\Flyer;

use App\Helpers\Helper;
use App\Models\Flyer;
use App\Models\Packages;
use App\Models\SharingType;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class PackageFlyerComponent extends Component
{
    use WithPagination, LivewireAlert;

    public $perPage = 10;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getFlyers()
    {
        return Flyer::query()
            ->where('agency_id', auth()->user()->id)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filteFlyers()
    {
        $this->resetPage();
    }

    public function downloadPDF(Flyer $flyer)
    {
        // dd($flyer);
        $data = [
            'flyer' => $flyer,
            'headerImage' => $flyer->header_image && Helper::fileExists("flyers/$flyer->header_image") ? "storage/flyers/$flyer->header_image" : 'assets/img/flyer-header.jpg',
            'footerImage' => $flyer->footer_image && Helper::fileExists("flyers/$flyer->footer_image") ? "storage/flyers/$flyer->footer_image" : 'assets/img/flyer-footer.jpg',
            'packages' => Packages::whereIn('id', $flyer->package_ids)->get(),
            'sharings' => SharingType::active()->get(),
        ];
        // dd($data);
        // Generate and return the PDF
        $pdf = Pdf::loadView('agent.downloads.flyer.flyer-pdf', $data);
        $pdf->setPaper('a3', 'portrait');
        $docName = Str::uuid() . ".pdf";

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="' . $docName . '"']);
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.flyer.package-flyer-component', [
            'flyers' => $this->getFlyers()
        ]);
    }
}
