<style>
    .image_center{
        margin-left: 130px !important;
    }
</style>
<x-app-layout> 
    @push('scripts')
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
   @endpush
   <div class="container-fluid">
       <div class="layout-specing">
           <div class="d-md-flex justify-content-between align-items-center">
               <h5 class="mb-0">Campaign List</h5>
               <a href="{{route('campaign.create')}}"><button class="btn btn-primary" ><i data-feather="plus" class="lead_icon mg-r-5"></i>Add Campaign</button></a>
           </div>
             @if (session('success'))
                 <div class="mt-2 pb-1 alert alert-success div">
                     <p class="msg "> {{ session('success') }}</p>
                 </div>
             @endif 
             @if (session('error'))
                 <div class="mt-2 pb-1 alert alert-danger div">
                     <p class="msg "> {{ session('error') }}</p>
                 </div>
             @endif    
                  <div class="hidden">
                          
                  </div> 
           <div class="row">
                 <div class="col-md-12 col-lg-12 mt-2">
                       <div class="card rounded shadow pb-1 ">
                       
                           <div class="table-responsive shadow rounded p-2"  >
                               <table class="table table-center  bg-white mb-0 " id="campaign_table">
                                   <thead>
                                       <tr>
                                           <th class="border-bottom  text-center" style="max-width:90px !important" >Sl No</th>
                                           <th class="border-bottom  text-center col-md-3" >Name</th>
                                           <th class="border-bottom  text-center col-md-3">Trigger Message</th>
                                           <th class="border-bottom text-center col-md-3" >Shorturl</th>
                                           <th class="border-center  text-center col-md-2" >Action</th>
                                       </tr>
                                   </thead>
                                   <tbody id="Search_Tr">
                                       <!-- Start -->
                                
                                       @foreach($campaignlist as $key => $campaign)
                                       <tr>
                                           <td class="text-center">{{ $key + 1}}</td>
                                           <td class="text-center col-md-3">
                                                <a href="{{route('campaign.show',$campaign->id)}}">{{ $campaign->name}}
                                                </a>
                                            </td>
                                           <td class="text-center col-md-3">{{ $campaign->trigger_message}}</td>
                                           <td class="text-center col-md-3"><span>https://lab2.invoidea.in/whatsapp-bot/public/</span>@if(!empty($campaign->showShortURL->alias)){{$campaign->showShortURL->alias}}@endif</td>
                                           <td class="text-center col-md-2">
                                            <button class="btn btn-primary  table_btn btn-xs btn-icon view_btn "
                                                    id="campaign_view" value="{{$campaign->id}}" data-toggle="modal"
                                                    data-target="#campaign_view_modal"><i class=" uil-vector-square-alt"></i></button>
                                                    
                                               <a href="{{route('campaign.edit',$campaign->id)}}"><button class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn"><i class="uil uil-eye"></i></button> </a>
                                                   <button class="btn btn-danger btn-xs btn-icon del_button" value="{{$campaign->id}}"><i class="uil uil-trash-alt"></i></button>
                                           </td>
                                       </tr>
                                          @endforeach
                                   </tbody>
                               </table>
   
                           </div>
                       
                        {{-- <div class="row text-center px-2  mb-4">
                           <div class="col-12 mt-4">
                               <div class="d-md-flex align-items-center text-center justify-content-between">
                                   <span class="text-muted me-3">Showing {{ $whatsapp->currentPage() }} -
                                       {{ $whatsapp->lastItem() }} out of {{ $whatsapp->total() }}</span>
                                   <ul class="pagination mb-0 justify-content-center ">
                                       {{ $whatsapp->links() }}
                                   </ul>
                               </div>
                           </div>
                       </div> --}}
                   </div>
               </div>  
          
       </div>
   </div><!--end container-->       
    <!--start delete modal-->
       <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog"
           aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Whatsapp Details</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                           aria-label="Close">X</button>
                   </div>
                   <div class="modal-body">
                       <h5>Are you sure! You want to delete ?</h5>
                       <input type="hidden" id="delete_whatsapp_id" name="delete_whatsapp">
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

{{-- Campaign view modal --}}
 <div class="modal fade" id="campaign_view_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header border-bottom p-3">
                <h5 class="modal-title" id="exampleModalLabel">View Campaign</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                        class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="modal-body ">
                    <div class="row text-center" id="table_view">
                        <div class="mb-3" id="qrCode">
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
{{-- end campaign view modal --}}

   
    @push('scripts')
<script>
     // Edit ajax start
     $(document).on("click", "#campaign_view", function (e) {
            e.preventDefault();
            var campaign_view_id = $(this).val();
            $('#campaign_view_modal').modal('show');
             $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
             });
           $.ajax({
                url : "{{route('modal')}}",
                type:'POST',
                data:{campaign_view_id:campaign_view_id},
                success:function(response){
                    console.log(response.campaign.qr_code);
                    html = `
                            <img src="{{  asset('storage${response.campaign.qr_code}') }}"
                                class="img img-responsive image_center d-block">

                            <a href="{{ asset('storage${response.campaign.qr_code}') }}"
                                                class="btn btn-primary mt-3" download>Download</a>
                            `;

                    $('#qrCode').html(html)


                }
            });
       });
        // Edit ajax end 
</script>

    
       <script>
           $(document).ready(function() {
               $('#campaign_table').DataTable();
           } );
       </script>
       <script>
       $(document).ready(function(){
           $('.div').fadeIn();
           $('.div').fadeOut(3000)
          
       });
       </script>
   
       <script>
           $(document).ready(function () {
   
               $(".del_button").on("click",  function () {
                   var campagin_id = $(this).val();
                   $('#delete_whatsapp_id').val(campagin_id);
                   $('#delete_modal').modal('show');
               });
   
               $(document).on('click', '.delete_btn', function () {
   
                   var campaginId = $('#delete_whatsapp_id').val();
                   
                   $('#delete_modal').modal('hide');
   
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                       type: "POST", 
                       url : "{{url('campaign/destroy')}}",
                       data: {
                        campaginId:campaginId,
                        _method: 'DELETE'
                    },
                       success: function (response) {
                        $("#campaign_table").load(location.href + " #campaign_table");
                        // $("#pagniation_load").load(location.href + " #pagniation_load");
                        toastr.success(response);
                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);
                        $('#delete_modal').modal('hide');
                        //     console.log(response);
                        //     toastr.success(response);
                            
                        //     setTimeout(function() {
                        //      location.reload(true);
                        //   }, 3000);
                       }
                   });
               });
           });
       </script>
   
   <script type="text/javascript">
   $(document).ready(function(){
            
         
            $('.toggle-class').change(function () {
             var status = $(this).prop('checked') === true ? 1 : 0;
             var whatsapp_id = $(this).data('id');
             
                 $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                 });
                 $.ajax({
                 type: "POST",
                 dataType: "json",
                 
                 data: { 'status': status, 'whatsapp_id': whatsapp_id },
                 success: function (response) {
                    console.log(response);
                        toastr.success(response.success);
   
                     }
                 });
             });
   }); 
         </script>
   
   
      @endpush
   </x-app-layout> 