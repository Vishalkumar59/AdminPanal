<x-app-layout> 
@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
@endpush
<!-- Start Page Content -->
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-md-flex justify-content-between align-items-center">
                <h5 class="mb-0">Setting</h5>
                <a href="{{route('setting.create')}}"><button class="btn btn-primary" ><i data-feather="plus" class="lead_icon mg-r-5"></i>Add </button></a>

            </div>
            @if (session('success'))
              <div class="mt-2 pb-1 alert alert-success div">
                  <p class="msg "> {{ session('success') }}</p>
              </div>
             @endif 
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="table-responsive shadow rounded p-2">
                        <table class="table table-center bg-white mb-0" id="setting">
                            <thead>

                                <tr>
                                    <th class="border-bottom p-3">S.N.</th>
                                    <th class="border-bottom p-3" style="min-width: 100px;">Sender Number</th>
                                    <th class="text-center border-bottom p-3" style="min-width: 120px;">WA Token</th>
                                    <th class="text-center border-bottom p-3">Status</th>
                                    
                                    <th class="text-center p-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                            @foreach($settings as $key => $setting)
                          
                            <tr>
                                <td class="p-3">{{$key + 1}}</td>
                                <td class="text-center p-3">{{ $setting->sender_number}}</td>
                                <td class="text-center p-3 text-break">{{ $setting->wa_token}}</td>
                                <td class="text-center p-3">
                                    <div class="form-check form-switch">
                                        <input  data-id="{{$setting->id}}" class="form-check-input toggle-class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{$setting->status ? 'checked' : '' }}>
                                    </div>  
                                </td>
                                <td class="text-center col-md-2 p-3">

                                    <a href="{{route('setting.edit',$setting->id)}}"><button class="btn btn-primary btn-xs btn-icon"><i class="uil uil-edit"></i></button> </a>
                                   <button class="btn btn-danger btn-xs btn-icon del_button" value="{{$setting->id}}"><i class="uil uil-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                           
                            </tbody>
                        </table>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
            
            
        </div>
    </div><!--end container-->  

    <!--start delete modal-->
    <div class="modal fade" id="setting_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure! You want to delete ?</h5>
                    <input type="hidden" id="delete_setting_id" name="delete_setting">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary delete_btn">Delete </button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    @push('scripts')    
    <script>
    $(document).ready(function(){
        $('.div').fadeIn();
        $('.div').fadeOut(3000)
       
    });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>


    <!-- start setting delete ajax code -->
    <script>
        $(document).ready(function () {

            $(".del_button").on("click",  function () {
                var setting_id = $(this).val();
                $('#delete_setting_id').val(setting_id);
                $('#setting_modal').modal('show');
            });

            $(document).on('click', '.delete_btn', function () {

                var setting_id = $('#delete_setting_id').val();
                
                $('#setting_modal').modal('hide');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('delete')}}",
                    data: {setting_id:setting_id},
                    success: function (response) {
                        console.log(response);
                        toastr.success(response.success);
                        
                        setTimeout(function() {
                          location.reload(true);
                       }, 3000);
                    }
                });
            });
        });
    </script>
    <!-- end setting delete ajax code -->

    <!-- start setting status ajax code -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.toggle-class').change(function () {
              var status = $(this).prop('checked') === true ? 1 : 0;
              var setting_id = $(this).data('id');
              
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "{{route('changeSettingStatus')}}",
                  data: { 'status': status, 'setting_id': setting_id },
                  success: function (response) {
                     console.log(response);
                        toastr.success(response.success);
                       
                    }
                });
            });
        }); 
    </script>
    <!-- end setting status ajax code -->
    
    @endpush
</x-app-layout> 
