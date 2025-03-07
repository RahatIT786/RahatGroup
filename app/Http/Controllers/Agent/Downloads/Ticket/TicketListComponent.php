<?php

namespace App\Http\Controllers\Agent\Downloads\Ticket;

use App\Models\Booking;

use App\Models\GuestDetail;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class TicketListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$booking_id,$search_name;
    public function getmanageTicket()
    {
        // dd(auth()->user('agents')->id);
        return Booking::query()
        ->where('agency_id', auth()->user('agents')->id)
            ->desc()
            ->searchLike('booking_id', $this->booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->where('booking_status', 1)
            ->where('release_tkt', 1)
            ->paginate($this->perPage);
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }  

    public function download_tickets($id)
    {   
        $file_added = false;
        $booking = Booking::findOrFail($id);
        $guests = GuestDetail::where('booking_id', $booking->booking_id)->get();
    
        if ($guests->count() > 0) {
            $zipFileName = $booking->booking_id . '_tickets.zip';
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
                    $fileName = $guest->tkt_file;
                   
                    if (!empty($fileName)) {  // Check if $fileName is not empty
                       
                        $relativePath = "ticket-documents/$fileName";

                        if (Storage::disk('public')->exists($relativePath)) {
                            $filePath = Storage::disk('public')->path($relativePath);
                            \Log::info("Adding file to ZIP: $filePath");
                          
                            $zip->addFile($filePath, $fileName);

                            $file_added = true;
                        } else {
                            \Log::warning("File not found: $relativePath");
                        }
                    } else {
                        $this->alert('error', 'No ticket files found for this booking.');
                        \Log::warning("File name is empty for guest ID: " . $guest->id);
                    }
                   
                }
                if($file_added){
                    $zip->close();
                    $this->alert('success', 'Downloaded Ticket Successfully');
                    // Return the ZIP file as a download
                    return response()->download($zipFilePath)->deleteFileAfterSend(true);
                }
              
            } else {
                \Log::error("Failed to create ZIP file. Error code: $result");
                return back()->with('error', 'Failed to create ZIP file.');
            }
            
            
        }
        $this->alert('error', 'No ticket files found for this booking.');
        return back()->with('error', 'No ticket files found for this booking.');
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.ticket.ticket-list-component', [
            'Tickets' => $this->getmanageTicket()
        ]);
    }
}
