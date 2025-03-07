<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ __('tablevars.edit') }} {{ __('tablevars.kit_category') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">{{ __('tablevars.manage') }} {{ __('tablevars.kit_category') }}

                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.kitCategory.index') }}"
                        wire:navigate>{{ __('tablevars.kit_category') }}</a></div>
                <div class="breadcrumb-item">{{ __('tablevars.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form id="form" wire:submit.prevent="update">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{ __('tablevars.edit') }} {{ __('tablevars.kit_category') }}</h4>
                            <a href="{{ route('admin.kitCategory.index') }}" class="btn btn-danger" wire:navigate><i
                                    class="fas fa-long-arrow-alt-left" title="Back"></i>
                                {{ __('tablevars.back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-block" wire:ignore>
                                        <label>{{ __('tablevars.category') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" id="category_id" name="category_id"
                                            wire:model="category_id">
                                            <option value="">Select a Category</option>
                                            @foreach ($serviceType as $service_type => $ServiceTypeName)
                                                <option value="{{ $service_type }}">{{ $ServiceTypeName }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.kit_name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Kit Name" wire:model="name" maxlength="100" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-block" wire:ignore>
                                        <label>{{ __('tablevars.kit_item') }}</label><span class="text-danger">*</span>
                                        <select class="form-control" name="kit_item_id[]" id="kit_name"
                                            wire:model="kit_item_id" multiple data-height="100%" style="height: 100%;">
                                            @foreach ($kitItem as $key => $val)
                                                <option value="{{ $key }}">
                                                    {{ $val }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- @error('kit_item_id.*')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror --}}
                                    </div>
                                    @if ($itemsError != '')
                                        <span class="text-danger">{{ $itemsError }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">{{ __('tablevars.price') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="price" class="form-control"
                                            wire:model="totalPrice">
                                        @error('totalPrice')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-block">
                                        <label class="form-control-label">
                                            {{ __('tablevars.image') }}<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="kit_category_img"
                                            wire:model="kit_category_img">
                                        @error('kit_category_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if (is_object($kit_category_img))
                                        <img src="{{ $kit_category_img->temporaryUrl() }}" style="height: 100px;">
                                    @elseif (!empty($category_imgEdit))
                                        <img src="{{ asset('storage/KitCategory_Image/' . $category_imgEdit) }}"
                                            style="height: 100px;">
                                    @else
                                        <span class="no-image">No images found</span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-block" wire:ignore>
                                        <label for="description" class="form-control-label">
                                            {{ __('tablevars.description') }}<span class="text-danger">*</span>
                                        </label>
                                        <textarea type="text" id="description" class="form-control" wire:model="description">{{ $description }}</textarea>
                                        @error('description')
                                            <span class="v-msg-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer text-left">
                                    <button title="Update"
                                        class="btn btn-primary">{{ __('tablevars.update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@push('extra_js')
    <script>
        $(document).ready(function() {
            $('#kit_name').select2();

            $('#kit_name').on('change', function(e) {
                var data = $('#kit_name').select2("val");
                @this.set('kit_item_id', data);
            });
        });

        $('#form').on('submit', function(e) {
            e.preventDefault();
            var selectedItems = $('#kit_name').val();
            @this.call('validateKitItems', selectedItems)

        });

        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Enter Description',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description', contents);
                    }
                }
            });
        });
    </script>
@endpush
