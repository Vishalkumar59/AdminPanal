

<x-app-layout> 
 @push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Question & Answer List</h5>
            <a href="{{route('create')}}"><button class="btn btn-primary" ><i data-feather="plus" class="lead_icon mg-r-5"></i>Add Q&A</button></a>
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
		            <div class="card rounded shadow pb-1 reload_table">
		            
		                <div class="table-responsive shadow rounded p-2" >
		                    <table class="table table-center  bg-white mb-0 " id="qa_table">
		                        <thead>
		                            <tr>
		                                <th class="border-bottom  text-center" style="max-width:90px !important" >Sl No</th>
		                                <th class="border-bottom  text-center col-md-3" >Question</th>
										<th class="border-bottom  text-center col-md-3" >Answer</th>
		                                <th class="border-bottom text-center col-md-3" >Whatsapp Code</th>
		                                <th class="border-center  text-center col-md-1" >Status</th>
		                                <th class="border-center  text-center col-md-2" >Action</th>
		                                
		                            </tr>
		                        </thead>
		                        <tbody id="Search_Tr">
		                            <!-- Start -->

		                            @foreach($whatsapp as $key => $wtsp)
		                            <tr>
		                                <td class="text-center">{{ $key + 1}}</td>
		                                <td class="text-center col-md-3">{{ $wtsp->question}}</td>
		                                <td class="text-center col-md-3">{{ $wtsp->answer}}</td>
		                                <td class="text-center col-md-3">{{ $wtsp->whatsapp_code}}</td>
		                                <td class="text-center col-md-1">
		                                    <div class="form-check form-switch">
		                                        <input  data-id="{{$wtsp->id}}" class="form-check-input toggle-class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{$wtsp->status ? 'checked' : '' }}>
		                                    </div>
		                                </td>

		                                <td class="text-center col-md-2">
		                                    <a href="{{route('edit',$wtsp->id)}}"><button class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn"><i class="uil uil-edit"></i></button> </a>
		                                    	<button class="btn btn-danger btn-xs btn-icon del_button" value="{{$wtsp->id}}"><i class="uil uil-trash-alt"></i></button>
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

 @push('scripts')

    <script>
        $(document).ready(function() {
            $('#qa_table').DataTable();
           
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
                var whatsapp_id = $(this).val();
                $('#delete_whatsapp_id').val(whatsapp_id);
                $('#delete_modal').modal('show');
            });

            $(document).on('click', '.delete_btn', function () {

                var whatsapp_id = $('#delete_whatsapp_id').val();
                
                $('#delete_modal').modal('hide');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('destroy')}}",
                    data: {whatsapp_id:whatsapp_id},
                    success: function (response) {
                     	console.log(response);
                     	toastr.success(response);
                     	
                     	setTimeout(function() {
                          location.reload(true);
                       }, 3000);
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
              url: "{{route('changeWhatsappStatus')}}",
              data: { 'status': status, 'whatsapp_id': whatsapp_id },
              success: function (response) {
                 console.log(response);
                 	toastr.success(response.success);

          	    }
          	});
      	});
}); 
  	</script>


  	 <!-- start delete ajax-->
    
    <!--end delete ajax-->
   @endpush
</x-app-layout> 