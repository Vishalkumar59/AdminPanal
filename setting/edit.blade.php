<x-app-layout>

    <div class="container-fluid">
        <div class="layout-specing">

            @if (session('success'))
              <div class="mt-2 pb-1 alert alert-success div">
                  <p class="msg "> {{ session('success') }}</p>
              </div>
            @endif
            <div class="col-md-12">
                <div class="card rounded shadow">
                     
                    <form action="{{route('setting.update',$setting->id)}}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">Update Setting</h5>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Sender Number<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <input name="sender_number" value="{{ $setting->sender_number }}" type="text"
                                            class="form-control " placeholder="Please Enter Sender Number" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter sender number</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-2">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select  placeholder="Select Status" class="form-control form-select" name="status" required>
                                        <option value="1" {{  ($setting->status == '1') ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{  ($setting->status == '0') ? 'selected' : '' }}>In-Active</option>
                                    </select>    
                                    <div class="invalid-feedback">
                                        <p>Please select status</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">WA Token<span class="text-danger">*</span></label>
                                    <textarea name="wa_token" rows="5" cols="30" class="form-control" placeholder="Please Enter WA Token" required>{{ $setting->wa_token }}</textarea>
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
@push('scripts')    
    <script>
    $(document).ready(function(){
        $('.div').fadeIn();
        $('.div').fadeOut(5000)
       
    });
    </script>
@endpush
</x-app-layout>