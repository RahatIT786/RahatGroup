<?php

namespace App\Http\Controllers\Agent\Downloads\ICards;

use Livewire\Component;
use App\Models\Booking;
use App\Models\GuestDetail;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;

class IDCardsComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $booking_id, $receipt_id, $payment;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getICard()
    {
        return Booking::query()
            ->where('agency_id', auth()->user()->id)
            ->where('release_tkt', 1)
            ->searchLike('booking_id', $this->booking_id)
            ->desc()
            ->paginate($this->perPage);
    }

    public function downloadICard($Id)
    {
        // Retrieve data
        $booking_data = Booking::with('packagetype', 'package')->find($Id);
        $agent = auth()->user();

        $guest_data = GuestDetail::where('booking_id', $booking_data->booking_id)->get();

        if ($guest_data->isEmpty()) {
            $this->alert('error', 'Please add passengers to download ID Card');
            return response()->json(['error' => 'not found'], 404);
        }

        // Prepare data for each guest
        $datas = $guest_data->map(function ($guest) use ($booking_data, $agent) {

            $agencyLogoPath = storage_path('app/public/company_logo/' . $agent->company_logo);
            $agencyLogoUrl = $agent->company_logo ? 'storage/company_logo/' . $agent->company_logo : asset('assets/imgages/mainlogo.png'); // Fallback image
            // dd($agencyLogoUrl);
            return [
                'pax_name' => $guest->guest_first_name . ' ' . $guest->guest_last_name,
                'pax_passport' => $guest->passport_number ?? '',
                'pkg_name' => $booking_data->package->name ?? '',
                'pkg_type' => $booking_data->packagetype->package_type ?? '',
                'logo_1' => 'assets/img/icard/logo1.jpg',
                'logo_2' => 'assets/img/icard/logo2.jpg',
                'front_background' => 'assets/img/icard/card-bg-front.jpg',
                'rear_background' => 'assets/img/icard/card-bg-front.jpg',
                'pax_photo' => 'storage/photos/passenger_photo/' . $guest->photo,
                'agency_name' => $agent->agency_name ?? '',
                // 'agency_logo' => 'storage/company_logo/' . $agent->company_logo,
                'agency_logo' => $agencyLogoUrl,
                'booking_id' => $booking_data->booking_id
            ];
        })->toArray(); // Convert collection to an array

        //  dd($datas);
        // Generate the PDF with the Blade template
        $pdf = Pdf::loadView('agent.downloads.i-cards.i-d-cards-pdf-component', ['datas' => $datas])
            ->setPaper('a4', 'landscape');
        $docName = "ID_CARD_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
          echo $pdf->stream();
        }, $docName);
    }

    public function filterBookings()
    {
        $this->resetPage();
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.i-cards.i-d-cards-component', [
            'Icards' => $this->getICard()
        ]);
    }
}
