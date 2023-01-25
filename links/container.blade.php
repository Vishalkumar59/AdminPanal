<x-app-layout> 
@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush
<!-- Start Page Content -->
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-md-flex justify-content-between align-items-center">
                <h5 class="mb-0">Links</h5>
                <a href="{{route('short-link')}}"><button class="btn btn-primary" ><i data-feather="plus" class="lead_icon mg-r-5"></i>Create Short Link</button></a>

                {{-- <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                        <li class="breadcrumb-item text-capitalize"><a href="index.html">Landrick</a></li>
                        <li class="breadcrumb-item text-capitalize"><a href="#">Invoice</a></li>
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">List</li>
                    </ul>
                </nav> --}}
            </div>

            <div class="row">
                <div class="col-12 mt-4">
                    <div class="table-responsive shadow rounded p-2">
                        <table class="table table-center bg-white mb-0" id="link_table">
                            <thead>
                                <tr>
                                    <th class="border-bottom p-3">URL</th>
                                    <th class="border-bottom p-3" style="min-width: 220px;">Space</th>
                                    <th class="text-center border-bottom p-3" style="min-width: 200px;">Clicks</th>
                                    <th class="text-center border-bottom p-3">Created at</th>
                                    <th>Action</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->

                            @if(count($links) != 0) 
                            
                            @foreach($links as $link)
                                <tr>
                                    <th class="p-3">
                                        <img src="https://icons.duckduckgo.com/ip3/{{ parse_url($link->url)['host'] }}.ico" rel="noreferrer" class=" {{ (__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3') }}" style="height:50px;">
                                        <div class="text-truncate">
                                                        <a href="{{ route('stats.overview', $link->id) }}" class="{{ ($link->disabled || $link->expiration_clicks && $link->clicks >= $link->expiration_clicks || \Carbon\Carbon::now()->greaterThan($link->ends_at) && $link->ends_at ? 'text-danger' : '') }}" dir="ltr">{{ str_replace(['http://', 'https://'], '', ($link->domain->url ?? config('app.url'))) .'/'.$link->alias }}</a>
                                                    </div>
                                            <div class="text-muted text-truncate small cursor-help" data-toggle="tooltip-url" title="{{ $link->url }}">
                                            @if($link->title){{ $link->title }}@else<span dir="ltr">{{ str_replace(['http://', 'https://'], '', $link->url) }}</span>@endif
                                        </div>
                                    </th>

                                    <td class="p-3">
                                        @if(isset($link->space->name))
                                            <a href="{{ route('links', ['space' => $link->space->id]) }}" class="badge badge-{{ formatSpace()[$link->space->color] }} text-truncate">{{ $link->space->name }}</a>
                                        @else
                                        None
                                        @endif
                                    </td>
                                    <td class="text-center p-3">{{ number_format($link->clicks, 0, __('.'), __(',')) }}</td>
                                    <td class="text-center p-3">{{ $link->created_at->diffForHumans() }}</td>
                                    <td class="text-center p-3">
                                        <button class="btn btn-danger btn-xs btn-icon del_button" value="{{$link->id}}" ><i class="uil uil-trash-alt"></i></button>
                                    </td>
                                </tr>
                                <!-- End -->
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
            
            
        </div>
    </div><!--end container-->  

    <!--start delete modal-->
    <div class="modal fade" id="link_delete_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure! You want to delete ?</h5>
                    <input type="hidden" id="delete_link_id" name="delete_link">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary delete_btn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    @push('scripts')    
    <script>
        $(document).ready(function() {
            $('#link_table').DataTable();
           
        });
    </script>
     <!-- start setting delete ajax code -->
    <script>
        $(document).ready(function () {

            $(".del_button").on("click",  function () {
                var link_id = $(this).val();
                $('#delete_link_id').val(link_id);
                $('#link_delete_modal').modal('show');
            });

            $(document).on('click', '.delete_btn', function () {

                var link_id = $('#delete_link_id').val();
                
                $('#link_delete_modal').modal('hide');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('destroy')}}",
                    data: {link_id:link_id},
                    success: function (response) {
                        console.log(response);
                        // toastr.success(response);
                        
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
