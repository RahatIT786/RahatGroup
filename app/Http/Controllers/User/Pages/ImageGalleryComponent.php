<?php

namespace App\Http\Controllers\User\Pages;

use App\Models\Gallery;
use App\Models\PackageType;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ImageGalleryComponent extends Component
{
    public $service_id, $package_id;
    public $packageType;
    public $tourtype = [];
    public $packagetype = [];
    public $type = [];
    public $images = [];
    public $facebookLinks = [];

    public function mount()
    {
        $this->packageType = PackageType::pluck('package_type', 'id');
        $this->images = $this->getImages();
        $this->facebookLinks = $this->getFacebookLinks();
    }

    public function getImages()
    {
        return Gallery::with('galleryimage')
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

    public function getFacebookLinks()
    {
        return Gallery::whereNotNull('facebook_link')
            ->distinct('facebook_link')
            ->pluck('facebook_link');
    }

    public function getTourType($tourtype)
    {
        if (!is_array($this->tourtype)) {
            $this->tourtype = [];
        }
        $this->images = $this->getImages();
    }


    public function getPackageType($packagetype)
    {
        if (!is_array($this->packagetype)) {
            $this->packagetype = [];
        }

        $this->images = $this->getImages();
    }


    public function getType($type)
    {
        // Ensure $this->type is always an array
        if (!is_array($this->type)) {
            $this->type = [];
        }

        // Refetch images after updating the filter
        $this->images = $this->getImages();
    }


    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.image-gallery-component', [
            // 'images' => $this->getImages()
            'images' => $this->images,
            'facebookLinks' => $this->facebookLinks,
        ]);
    }
}
