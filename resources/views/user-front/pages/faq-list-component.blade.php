<div>
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="breadcrumbs mb-4">
                        <span>
                            <span class="breadcrumb-text">
                                <a href="{{ route('customer.homepage') }}">Home</a>
                            </span>
                            <span class="breadcrumb-separator"></span>
                            <span class="breadcrumb-text">Frequently Asked Questions</span>
                        </span>
                    </nav>
                </div>
            </div>
            <h4>Frequently Asked Questions</h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="package_search_box">
                        <h4 class="box-title">Search By <small>Questions</small></h4>
                        <div class="search_content">
                            <input type="text" class="form-control" wire:model.live="search_question"
                                placeholder="Ask A Question?" wire:keyup="changeInput">
                        </div>
                    </div>
                </div>
            </div>

            <div id="accordion" role="tablist" aria-multiselectable="true" class="faq-list mb-5">
                <div class="card">
                    @forelse($faqs as $index => $faq)
                        <div class="card-header collapsed" role="tab" id="heading{{ $faq->id }}"
                            data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $faq->id }}"
                            aria-expanded="false" aria-controls="collapseOne">
                            {!! $faq->question !!} </div>
                        <div id="collapseOne{{ $faq->id }}" class="collapse" role="tabpanel"
                            aria-labelledby="heading{{ $faq->id }}" aria-expanded="false" data-parent="#accordion"
                            style="">
                            <div class="card-body">
                                <div class="P_text">{!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-red">No FAQs found.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </section>
</div>
</div>
