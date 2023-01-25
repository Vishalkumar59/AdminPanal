<x-app-layout> 
@push('scripts')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css"> --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
@endpush
<!-- Start Page Content -->
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-md-flex justify-content-between align-items-center">
                <h5 class="mb-0">Campaign History</h5>
            </div>
            {{-- @dd($oldest->created_at->format('Y-m-d  H:i:s')); --}}
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
                                    <th class="border-bottom p-3">Contact Number</th>
                                    <th class="border-bottom p-3">First Message</th>
                                    <th class="border-bottom p-3">Last Message</th>
                                    <th class="p-3">Total Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                          
                            @if(!empty($campaignContact))
                                @foreach($campaignContact as $key => $contact)

                                 {{-- {{date('d-m-Y', strtotime($history->created_at)) }} --}}
                                @php
                                 foreach($contact->campaignHistory as $campaign){
                                        $contact_id = $campaign->contact_id;
                                        // dd($contact_id);
                                        $oldest = $campaign->orderBy('created_at','DESC')->first();
                                         $latest = $campaign->orderBy('created_at','ASC')->first();
                                    }
                                @endphp
                                <tr>
                                    <td class="p-3">{{$key + 1}}</td>
                                    <td class="p-3">{{$contact->contact_number}}</td>
                                    @if($contact->id == $contact_id)
                                    <td class="p-3">{{$oldest->created_at->format('Y-m-d  H:i:s')}}</td>
                                    <td class="p-3">{{$latest->created_at->format('Y-m-d  H:i:s')}}</td>
                                    @else
                                    <td></td>
                                    <td></td>
                                    @endif
                                    
                                    <td class="text-center col-md-2 p-3">{{count($contact->campaignHistory)}}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><h5>Data Not Found</h5></td>
                                    <td></td>
                                    <td></td>
                                   
                                </tr>
                            @endif
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
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>


    <!-- start setting delete ajax code -->
    <script>
        $(document).ready(function () {

            $(".del_button").on("click",  function () {
                var history_id = $(this).val();
                $('#delete_setting_id').val(history_id);
                $('#setting_modal').modal('show');
            });

            $(document).on('click', '.delete_btn', function () {

                var history_id = $('#delete_setting_id').val();
                
                $('#setting_modal').modal('hide');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('campaign-history-delete')}}",
                    data: {history_id:history_id},
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

    
    @endpush
</x-app-layout> 
