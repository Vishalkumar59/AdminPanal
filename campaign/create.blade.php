<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
                    <form action="{{route('campaign.store')}}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">Add Campaign</h5>
                        </div>
                        <input type="hidden" value="{{$defaultDomain}}" name="domain"/>
                        <input type="hidden" id="url" value="https://wa.me/15550835832?text=" name="url"/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Name<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <input name="name"  value="{{old('name')}}" type="text"
                                            class="form-control " placeholder="Please Enter Name" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter Name</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Trigger Message<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="trigger_msg" id="trigger_msg" value="{{old('trigger_msg')}}" type="text" class="form-control "
                                            placeholder="Please Enter Message" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter Message</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12 my-4 mx-4">
                                <input type="submit" class="btn btn-primary" value="Submit"/>
                                <a href="{{ route('campaign.index') }}" class="ms-3 bg-light text-dark">
                                    Go Back</a>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#trigger_msg").blur(function () {
            var url = "https://wa.me/15550835832?text="+$(this).val();
            $("#url").val(url);
        });
    });
</script>
</x-app-layout>