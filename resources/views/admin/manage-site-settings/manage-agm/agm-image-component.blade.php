<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.image') }}</h1>
        </div>
    </section>

    <div class="section-body">
        <div class="col-lg-12">
            <div class="input-block">
                <form wire:submit.prevent="save">
                    <label class="form-control-label">
                        {{ __('tablevars.upload_multiple') }}
                        {{ __('tablevars.image') }}<span class="text-danger">*</span>
                    </label>
                    <input type="file" class="form-control" name="image[]" wire:model="image" multiple />
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    @if ($image)
                        @foreach ($image as $img)
                            <img src="{{ $img->temporaryUrl() }}" style="height: 100px;">
                        @endforeach
                    @endif

                    <div class="card-footer text-left">
                        <button type="submit" class="btn btn-primary" title="{{ __('tablevars.submit') }}">
                            {{ __('tablevars.submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
