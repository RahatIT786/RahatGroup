<?php

namespace App\Http\Controllers\Admin\Setting\City;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CityListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_city, $status, $id, $is_edit, $country, $countryname, $city_name, $country_id,$CityId,$city;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public function getcity()
    {
        return City::query()
            ->searchLike('city_name', $this->search_city)
            ->desc()
            ->paginate($this->perPage);
    }

    public function isDelete(City $city)
    {
        $this->CityId = $city->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $cityData = City::whereId($this->CityId);
        $cityData->delete();
        $this->alert('success', Lang::get('messages.city_delete'));
    }


    public function mount()
    {
        $this->country = Country::pluck('countryname', 'id');
    }

    public function save()
    {
        $validated = $this->validate([
            'country_id' => 'required',
            'city_name' => [
                'required',
                Rule::unique('aihut_foreign_indian_city')->where(function ($query) {
                    return $query->where('country_id', $this->country_id);
                }),
            ],
        ], [], [
            'country_id' => 'Country Name',
            'city_name' => 'City Name',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        City::create($validated);
        $this->alert('success', Lang::get('messages.city_save'));
        $this->dispatch('close-modal', modal: 'crudModal');
    }

    public function edit(City $city)
    {
        // dd($city);
        $this->is_edit = true;
        $this->id = $city->id;
        $this->country_id = $city->country_id;
        $this->city_name = $city->city_name;
    }
    public function update()
    {
        $validated = $this->validate([
            'country_id' => 'required',
            'city_name' => [
                'required',
                Rule::unique('aihut_foreign_indian_city')->ignore($this->id)->where(function ($query) {
                    return $query->where('country_id', $this->country_id);
                }),
            ],
        ], [], [
            'country_id' => 'Country Name',
            'city_name' => 'City Name',
        ]);
        City::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.city_update'));
        $this->dispatch('close-modal', modal: 'crudModal');
        $this->is_edit = false;
        $this->resetPage();
    }
    public function filterCity()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function resetForm()
    {
        $this->reset(['countryname', 'city_name', 'status']);
        // $this->resetPage();
    }
    public function render()
    {
        return view('admin.setting.city.city-list-component', [
            'Cities' => $this->getcity()
        ]);
    }
}
