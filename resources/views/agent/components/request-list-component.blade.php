<div class="row">
    <div class="col-md-12">
        <div class="settings-widget">
            <div class="settings-inner-blk p-0">
                <div class="row">
                    <div class="col-9">
                        <div class="sell-course-head comman-space">
                            <h3>Requests</h3>
                            <p>Order Dashboard is a quick overview of all current orders.</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="sell-course-head comman-space">
                            <div class="all-btn all-category  foat-right">
                                <a href="{{ route('agent.quotes.index') }}" target="_blank" class="btn btn-primary">View
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="comman-space pb-0">
                    <div class="settings-tickets-blk course-instruct-blk table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                                @forelse ($requestQuotes as $key => $quote)
                                    <tr>
                                        <td style="width: 20%;">
                                            <span
                                                class="text-secondary"><b>{{ Helper::appDateFormat($quote->travel_date) }}</b></span></br>
                                            <span
                                                class="text-info"><b>{{ ucfirst($quote->mehram_name) }}</b></span></br>
                                            <span><b>{{ $quote->package != null ? $quote->package->name : '-' }}</b></span></br>
                                            <span>{{ $quote->packagetype != null ? $quote->packagetype->package_type : '' }}</span>
                                        </td>

                                        <td style="width: 20%;">
                                            <b>

                                                <span class="text-success">{{ $quote->adult }}
                                                    Adult ,</span>
                                                <span class="text-success">{{ $quote->child_bed + $quote->child }}
                                                    Child ,</span></br>
                                                <span class="text-success">{{ $quote->infant }}
                                                    Infant</span></br></br>
                                                @if ($quote->service_type == 1)
                                                    <span class="web-badge badge-purple">
                                                    @else
                                                        <span class="web-badge badge-warning">
                                                @endif
                                                {{ $quote->servicetype != null ? $quote->servicetype->name : '-' }}</span>
                                        </td>
                                        <td style="width: 20%;">
                                            <span><b>Request Id:</b></span>
                                            <span>{{ $quote->request_id }}</span></br>
                                            <span><b>Raised On: </b></span>
                                            <span>{{ Helper::appDateFormat($quote->created_at) }}</span>
                                        </td>
                                        <td style="width: 15%;">
                                            <span><b>Total Cost: </b></span></br>
                                            <span>{{ Aihut::get('currency') }}
                                                {{ number_format($quote->tot_cost, 2) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" align="center" class="text-danger">
                                            {{ __('tablevars.no_record') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
