<div class="col-md-4">
    <div class="card card-hero">
        <div class="card-header">
            <div class="card-icon">
                <i class="far fa-question-circle"></i>
            </div>
            <h4>{{ $feedbackCount }}</h4>
            <div class="card-description">Customers feedback requests</div>
        </div>
        <div class="card-body p-0">
            <div class="tickets-list">
                @foreach ($feedbacks as $feedback)
                    <a href="javascript:void(0);" class="ticket-item">
                        <div class="ticket-title">
                            <h4>{{ Helper::limitText($feedback->cust_msg, 50) }}</h4>
                        </div>
                        <div class="ticket-info">
                            <div>{{ $feedback->cust_name }}</div>
                            <div class="bullet"></div>
                            <div class="text-primary">{{ $feedback->time }}</div>
                        </div>
                    </a>
                @endforeach
                <a href="{{ route('admin.feedback.index') }}" class="ticket-item ticket-more">
                    View All <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
