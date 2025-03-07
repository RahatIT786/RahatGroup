<?php

namespace App\Http\Controllers\Agent\Downloads\Visa;

use App\Models\GuestDetail;
use Livewire\Component;
use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class VisaListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $booking_id, $mehram_name;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public function getVisa()
    {
        // dd(auth()->user('agents')->id);
        return Booking::query()
            ->desc()
            ->where('agency_id', auth()->user('agents')->id)
            ->where('booking_status', 1)
            ->where('release_visa',1)
            ->searchLike('booking_id', $this->booking_id)
            ->searchLike('mehram_name', $this->mehram_name)
            ->paginate($this->perPage);
    }
    public function filterBookings()
    {
        $this->resetPage();
    }

    public function download_visas($id)
    {   
        $file_added = false;
        $booking = Booking::findOrFail($id);
        $guests = GuestDetail::where('booking_id', $booking->booking_id)->get();
    
        if ($guests->count() > 0) {
            $zipFileName = $booking->booking_id . '_visas.zip';
            $zipFilePath = storage_path("app/public/$zipFileName");  // Correct full path for saving ZIP
    
            // Check if storage path exists and is writable
            if (!is_dir(storage_path('app/public'))) {
                \Log::error("Directory does not exist: " . storage_path('app/public'));
                return back()->with('error', 'Storage directory not found.');
            }
    
            // Create a new ZIP file
            $zip = new ZipArchive;
            $result = $zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
            if ($result === TRUE) {
                foreach ($guests as $guest) {
                    $fileName = $guest->visa_file;
                   
                    if (!empty($fileName)) {  // Check if $fileName is not empty
                       
                        $relativePath = "visa-documents/$fileName";

                        if (Storage::disk('public')->exists($relativePath)) {
                            $filePath = Storage::disk('public')->path($relativePath);
                            \Log::info("Adding file to ZIP: $filePath");
                          
                            $zip->addFile($filePath, $fileName);

                            $file_added = true;
                        } else {
                            \Log::warning("File not found: $relativePath");
                        }
                    } else {
                        $this->alert('error', 'No visa files found for this booking.');
                        \Log::warning("File name is empty for guest ID: " . $guest->id);
                    }
                   
                }
                if($file_added){
                    $zip->close();
                    $this->alert('success', 'Downloaded Visas Successfully');
                    // Return the ZIP file as a download
                    return response()->download($zipFilePath)->deleteFileAfterSend(true);
                }
              
            } else {
                \Log::error("Failed to create ZIP file. Error code: $result");
                return back()->with('error', 'Failed to create ZIP file.');
            }
            
            
        }
        $this->alert('error', 'No visa files found for this booking.');
        return back()->with('error', 'No visa files found for this booking.');
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.visa.visa-list-component', [
            'visas' => $this->getVisa()
        ]);
    }
}
