<?php

namespace App\Http\Controllers\Admin\Packages;

use App\Models\Booking;
use App\Models\PackageMaster;
use App\Models\Packages;
use App\Models\PackageDetails;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PackageListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $booking_id, $booking_modal_data = null, $package_modal_data = null;
    public $showConfirmation = false;
    public $package_name, $package_type;
    public $modalData, $Id, $selected_pkg;

    public function getPackages()
    {

        $Packages = Packages::desc()->with('pkgDetails', 'pkgImages')
            ->searchLike('name', $this->package_name)
            ->paginate($this->perPage);
        return $Packages;

        // $Packages = Packages::desc()->with('pkgDetails','pkgImages')
        // ->searchLike('name', $this->package_name)
        // ->get();
        // dd($Packages[0]);
    }

    public function filterPackage()
    {
        $this->resetPage();
    }

    public function getPackageContent($pkg_id)
    {
        $this->selected_pkg = Packages::where('id', $pkg_id)->first();
        $this->package_modal_data = PackageDetails::with('packageType', 'makkahotel', 'madinahotel', 'mealType', 'laundrytype')->where('pkg_id', $pkg_id)->get();

        //  dd($this->package_modal_data);
    }


    public function isDelete(Packages $package)
    {
        $this->Id = $package->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    // public function confirmDelete()
    // {
    //     $packageMasterData = Packages::whereId($this->Id)->where('');
    //     $packageMasterData->delete();
    //     $this->alert('success', 'Record has been deleted successfully');
    // }




    public function confirmDelete()
    {
        $bookings = Booking::where('package_name', $this->Id)->exists();

        if ($bookings) {
            $this->alert('error', 'This package is already booked by some users, deletion is not allowed.');
        } else {
            $packageMasterData = Packages::whereId($this->Id)->first();

            if ($packageMasterData) {
                $packageMasterData->delete();
                $this->alert('success', 'Record has been deleted successfully');
            }
        }
    }

    public function toggleStatus(Packages $package)
    {
        $this->Id = $package->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }


    public function confirmed()
    {
        $packageMasterData = Packages::whereId($this->Id);
        $packageMasterData->update(['is_active' => !$packageMasterData->first()->is_active]);
        $this->alert('success', 'Record Status has been updated successfully');
    }


    // public function isDupicate(Packages $package)
    // {
    //     // dd($packagemaster);
    //     $this->Id = $package->id;
    //     $this->confirm('Are you sure to Duplicate this?', [
    //         'icon' => 'question',
    //         'confirmButtonText' => 'Yes',
    //         'onConfirmed' => 'confirmDuplicate',
    //     ]);
    // }

    // public function confirmDuplicate()
    // {
    //     try {
    //         $packageMasterData = Packages::find($this->Id);
    //         // dd($packageMasterData);
    //         $copypackageMasterData = [
    //             'package_name' => $packageMasterData->package_name,
    //             'package_type' => $packageMasterData->package_type,
    //             'makka_rating' => $packageMasterData->makka_rating,
    //             'makka_city_id' => $packageMasterData->makka_city_id,
    //             'makka_hotel' => $packageMasterData->makka_hotel,
    //             'madina_rating' => $packageMasterData->madina_rating,
    //             'madina_city_id' => $packageMasterData->madina_city_id,
    //             'madina_hotel' => $packageMasterData->madina_hotel,
    //             'package_includes' => $packageMasterData->package_includes,
    //             'laundray_type' => $packageMasterData->laundray_type,
    //             'transport_type' => $packageMasterData->transport_type,
    //             'food_type' => $packageMasterData->food_type,
    //             'is_active' => $packageMasterData->is_active,
    //         ];
    //         PackageMaster::create($copypackageMasterData);
    //         $this->alert('success', 'Package has been duplicated successfully.');
    //     } catch (\Exception $e) {
    //         // Log the error or handle it accordingly
    //         Log::error('Error creating new package master: ' . $e->getMessage());
    //         $this->alert('error', 'Sorry! Couldn\'t duplicate the package.');
    //         // dd(1212, $e->getMessage());
    //     }
    // }



    public function render()
    {
        return view('admin.packages.package-list-component', [
            'packages' => $this->getPackages()
        ]);
    }
}
