<div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                @include('agent.layouts.sidebar')
                <div class="col-xl-10 col-lg-9 col-md-12">
                    <div class="settings-widget">
                        <div class="settings-inner-blk p-0">
                            <div class="comman-space">
                                <h4 class="h5" style="text-align: center;">FeedBack</h4>
                                <hr style="border-bottom: 1px solid #e4e4e4;border-top: 0px;margin: 20px 0px;" />
                                <form id="form" wire:submit.prevent="save">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6 cust_name mb-3">
                                            <label>Name</label><span class="text-danger">*</span>
                                            <input wire:model.defer="cust_name" type="text" class="form-control"
                                                placeholder="Name">
                                            @error('cust_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 cust_email mb-3">
                                            <label>Email</label><span class="text-danger">*</span>
                                            <input wire:model.defer="cust_email" type="cust_email" class="form-control"
                                                placeholder="Email">
                                            @error('cust_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group nights_makkah mb-3">
                                            <label for="nights_makkah">Feedback</label><span
                                                class="text-danger">*</span>
                                            <select
                                                class="custom-select form-control form-select @error('feedback_cat')  validation-border @enderror"
                                                name="feedback_cat " id="catagory" wire:model="feedback_cat">
                                                <option value="">Select Category</option>
                                                <option value="Problem">Problem</option>
                                                <option value="Suggestion">Suggestion</option>
                                                <option value="Complain">Complain</option>
                                                <option value="Question">Question</option>
                                                <option value="Appreciation">Appreciation</option>
                                                <option value="Testimomials">Testimomials</option>
                                            </select>
                                            @error('feedback_cat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group nights_medina mb-3">
                                            <label for="nights_medina">Mobile</label><span class="text-danger">*</span>
                                            <input type="text"
                                                class="form-control @error('cust_num')  validation-border @enderror"
                                                placeholder="Enter Contact Number" name="contact" id="contact"
                                                wire:model="cust_num" maxlength="12">
                                            @error('cust_num')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 comments mb-3">
                                            <label>Message</label><span class="text-danger">*</span>
                                            <textarea class="form-control @error('cust_msg')  validation-border @enderror" name="cust_msg" id="cust_msg"
                                                placeholder="Message" wire:model="cust_msg" style="height: 120px"></textarea>
                                            @error('cust_msg')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div style="margin-top: 20px; display: flex; justify-content: center;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
