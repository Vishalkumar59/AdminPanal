<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
                    <form action="{{route('setting.store')}}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">Add Setting</h5>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Sender Number<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <input name="sender_number" value="{{old('sender_number')}}" type="text"
                                            class="form-control " placeholder="Please Enter Sender Number" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter sender number</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">WA Token<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <input name="wa_token" value="{{old('wa_token')}}" type="text" class="form-control"
                                            placeholder="Please Enter WA Token" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter wa token</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12 my-4 mx-4">
                                <input type="submit" class="btn btn-primary" value="Submit">
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