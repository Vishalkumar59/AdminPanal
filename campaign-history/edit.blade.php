<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
                    <form action="{{route('campaign-history-update',$campaignHistoryUpdate->id)}}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">Update Campaign History</h5>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Message<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <input name="message" value="{{$campaignHistoryEdit->message}}" type="text"
                                            class="form-control " placeholder="Please Enter Message" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter message</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Message Type<span class="text-danger">*</span></label>
                                    <select  placeholder="Select Message Type" class="form-control form-select" name="status" required>
                                        <option value="sent" {{  ($campaignHistoryEdit->msg_type == 'sent') ? 'selected' : '' }}>sent</option>
                                        <option value="received" {{  ($campaignHistoryEdit->msg_type == 'received') ? 'selected' : '' }}>received</option>
                                    </select>    
                                    <div class="invalid-feedback">
                                        <p>Please select message type</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12 my-4 mx-4">
                                <input type="submit" class="btn btn-primary" value="Update">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>