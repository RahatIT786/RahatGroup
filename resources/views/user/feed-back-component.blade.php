<div class="slide-out-div quick-form" wire:ignore.self>
    <a class="handle" href="#" wire:ignore></a>
    <form name="frm_feedback" method="POST" wire:submit.prevent="save">
        @if (session('feed_success'))
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                {{ session('feed_success') }}
            </div>
        </div>
    @endif
        <div class="form-group">
            <input type="text" name="cust_name" id="cust_name"
                class="form-control @error('cust_name')  validation-border @enderror" placeholder="Enter Name"
                wire:model="cust_name">
        </div>

        <div class="form-group">
            <input type="text" name="cust_email" id="cust_email"
                class="form-control @error('cust_email')  validation-border @enderror" placeholder="Enter Email"
                wire:model="cust_email">
        </div>

        <div class="form-group">
            <select class="custom-select form-control @error('feedback_cat')  validation-border @enderror"
                name="feedback_cat " id="catagory" wire:model="feedback_cat">
                <option value="">Select Category</option>
                <option value="Problem">Problem</option>
                <option value="Suggestion">Suggestion</option>
                <option value="Complain">Complain</option>
                <option value="Question">Question</option>
                <option value="Appreciation">Appreciation</option>
            </select>
        </div>

        <div class="form-group">
            <label style="margin-bottom:10px;display:inline-block;font-size: 14px;line-height:1.5;">[Contact
                Number :inlove (This will help us reach you and fix the Issue quickly)</label>
            <input type="text" class="form-control @error('cust_num')  validation-border @enderror"
                placeholder="Enter Contact Number" name="contact" id="contact" wire:model="cust_num">
        </div>

        <div class="form-group">
            <textarea class="form-control @error('cust_msg')  validation-border @enderror" name="cust_msg" id="cust_msg"
                placeholder="Message" wire:model="cust_msg" style="height: 120px"></textarea>
        </div>

        <div>
            <button type="submit" class="btn main-btn" name="feedback_submit">Submit</button>

            <a href="#" class="btn cancel " wire:ignore>Cancel</a>

        </div>
    </form>
</div>
@push('extra_css')
    <style>
      .alert-danger {
    color: red !important;
}
</style>
@endpush
@script
    <script>
        document.addEventListener('livewire:initialized', function() {
            window.addEventListener('reload-page', function() {
                setTimeout(() => {
                    location.reload();
                }, 4000);
            });

        });
    </script>
@endscript
