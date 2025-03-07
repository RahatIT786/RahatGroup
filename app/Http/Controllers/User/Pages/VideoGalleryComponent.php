<?php

namespace App\Http\Controllers\User\Pages;

use App\Models\PackageType;
use App\Models\VGallery;
use Livewire\Attributes\Layout;
use Livewire\Component;

class VideoGalleryComponent extends Component
{
    public $packageType, $id, $service_id, $package_id, $galleyimage, $eventimage;
    // public $image = [];
    public $current_pkg_type;

    public $tourtype = [];
    public $packagetype = [];
    public $type = [];
    public $video = [];

    public function mount()
    {
        $this->packageType = PackageType::pluck('package_type', 'id');
    }

    public function getVideo()
    {
        return VGallery::with('galleryvideo', 'packageType')
            ->when($this->tourtype, function ($query) {
                $query->whereIn('service_id', $this->tourtype);
            })
            ->when($this->packagetype, function ($query) {
                $query->whereIn('package_id', $this->packagetype);
            })
            ->when($this->type, function ($query) {
                $query->whereIn('type', $this->type);
            })
            ->get();
    }

    public function getTourType($tourtype)
    {
        if (!is_array($this->tourtype)) {
            $this->tourtype = [];
        }
        $this->video = $this->getVideo();
    }

    public function getPackageType($packagetype)
    {
        if (!is_array($this->packagetype)) {
            $this->packagetype = [];
        }

        $this->video = $this->getVideo();
    }

    public function getType($type)
    {
        // Ensure $this->type is always an array
        if (!is_array($this->type)) {
            $this->type = [];
        }
        // Refetch images after updating the filter
        $this->video = $this->getVideo();
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.video-gallery-component', [
            'videos' => $this->getVideo()
        ]);
    }
}
