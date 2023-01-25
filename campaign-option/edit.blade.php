<style>
    .fixed_add_btn {
        margin-top: 17px !important;
        margin-left: -13px !important;
    }
</style>
<x-app-layout>

    {{-- @dd(session()->get('hiddenbox')); --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">

                    <form action="{{route('campaign-option.update',$CampaignOptionlist->option_id)}}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('put')
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">Edit Campaign Option</h5>
                        </div>
                        <input type="hidden" value="{{session()->get('campaignId')}}" name="campaign_id"
                            id="campaign_id">
                        <div class="row" id="dynamic">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Parent Option<span class="text-danger"></span></label>
                                    <select class="form-select form-control" name="parent_option" id="parent_option">
                                        <option selected disable value="">Select Parent</option>
                                        @foreach($CampaignOption as $key => $parent_list)
                                        <option value="{{$parent_list->option_id}}" {{$parentselected ==
                                            $parent_list->option_id ? 'selected' : ''}}>{{$parent_list->option_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please Select Parent Option</p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6" id="parent_value">
                                <div class="px-4 py-2">
                                    <label class="form-label">Parent Option Value<span
                                            class="text-danger"></span></label>
                                    <select class="form-select form-control" name="parent_option_value"
                                        id="parent_option_value">

                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please Select Parent Option Value</p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Name<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <input value="{{$CampaignOptionlist->option_name}}" type="text"
                                            class="form-control " placeholder="Please Enter Name" name="name" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter Name</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Message<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input value="{{$CampaignOptionlist->option_message}}" type="text"
                                            class="form-control " placeholder="Please Enter Message" name="message"
                                            required>
                                        <div class="invalid-feedback">
                                            <p>Please enter Message</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Sort Order<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input value="{{$CampaignOptionlist->sort_order}}" type="number"
                                            class="form-control " placeholder="Please Enter Sort Order"
                                            name="sort_order" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter Sort Order</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">WhatsApp Template Code<span
                                            class="text-danger"></span></label>
                                    <div class="form-icon position-relative">
                                        <input value="{{$CampaignOptionlist->wa_template_code}}" type="text"
                                            class="form-control " placeholder="Enter WhatsApp Template Code"
                                            name="wp_template_code">
                                        <div class="invalid-feedback">
                                            <p>Please enter WhatsApp Template Code</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Option Type<span class="text-danger">*</span></label>
                                    <select class="form-select form-control" name="option_type" id="option_type"
                                        required>
                                        <option selected disable value="">Select Option Type</option>
                                        <option value="0" {{$CampaignOptionlist->option_type == 0 ? 'selected' : ''
                                            }}>Text</option>
                                        <option value="1" {{$CampaignOptionlist->option_type == 1 ? 'selected' : ''
                                            }}>Template</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please Select Option Type</p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="form-select form-control" name="status" id="status" required>
                                        <option selected disable value="">Select Status</option>
                                        <option value="1" {{$CampaignOptionlist->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="2" {{$CampaignOptionlist->status == 2 ? 'selected' : ''
                                            }}>In-Active</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please Select Status</p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="px-4 py-2">
                                    <label class="form-label">Reply Type<span class="text-danger"></span></label>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="inlineRadio1">Text</label>
                                                <input class="form-check-input showbox" type="radio" name="reply" id="text" value="1">
                                                
                                              </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="inlineRadio2">Button</label>
                                                <input class="form-check-input showbox" type="radio" name="reply" id="button" value="2">
                                               
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 hiddenbox">
                                <div class="px-4 py-2">
                                    <label class="form-label">Values<span class="text-danger"></span></label>
                                    <div class="form-icon position-relative">
                                        <input value="@if($CampaignOptionlist->campaignOptionValue){{$CampaignOptionlist->campaignOptionValue->name}}@endif" type="text"
                                            class="form-control " placeholder="Please Enter Option Message"
                                            name="values[]" id="getvalueid">
                                        <div class="invalid-feedback">
                                            <p>Please enter Message</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 py-4 fixed_add_btn hiddenbox">
                                <button class="btn btn-primary" type="submit" id="add_more"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                           
                            @php
                            $calc =0;
                            @endphp
                            @if(!empty($CampaignOptionValue))
                            @foreach($CampaignOptionValue as $optionValue)
                             <input type="hidden" value="{{$optionValue->value_id}}" name="value_id[]">
                            @php
                            $calc++;
                            if($calc ==1) continue;
                            @endphp

                            <div class="dynamic-add remove1 px-4 py-2 col-md-6 campaigninput hiddenbox" id="row'+i+'">
                                <div class="px-4 py-2">

                                    
                                    <label class="form-label">Values<span class="text-danger"></span></label>
                                    <div class="form-icon position-relative">
                                       
                                        <input value="{{$optionValue->name}}" type="text" class="form-control "
                                            placeholder="Please Enter Option Message" name="values[]">
                                        <div class="invalid-feedback">
                                            <p>Please enter Message</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-md-6 py-4 fixed_add_btn hiddenbox">
                                <div class="btn_remove btn-submit btn btn-danger" data-id="{{$optionValue->value_id}}" {{-- id="'+i+'" --}} type="button">X</div>
                            </div>
                            @endforeach
                            @endif
                            
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"
        integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--script start-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    @push('scripts')
    {{-- <script>
        $(document).ready(function() {
        var i = 1;
        $('#add_more').click(function(e) {
            e.preventDefault();
            i++;
            $('#dynamic').append(
                '<div class="row  dynamic-add px-4 py-2 col-md-6 " id="row' + i + '" >' +
                '<div class="px-4 py-2">' +
                '<label class="form-label">Values<span class="text-danger"></span></label>'+
                '<input type="text" class="form-control"  placeholder="Please Enter Option Message" name="values[]" value="" >' +
                '</div>' +
                '<div class="mt-4">' +
                '<div class="btn_remove btn btn-danger" id="' + i + '" type="button">X</div>' +
                '</div>' +
                '</div>');
                
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $(document).on('click', '.remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
    </script> --}}


    <script>
        $(document).ready(function(){
            $(".hiddenbox").css("visibility", "hidden");
            var data = $("#getvalueid").val();
            if( data != '')
            {
                 $('#button').prop('checked', 'true');
                 $(".hiddenbox").css("visibility", "visible");
                
            
            }else{
                $('#text').prop('checked', 'true');
                $(".hiddenbox").css("visibility", "hidden");
                
            }
        
        });
   
    </script>
    <script>
       
       
     $('.showbox').click(function() {
        var selValue =    $('input[type=radio][name=reply]:checked').attr('id')
        if(selValue == "button")
        {
            $(".hiddenbox").css("visibility", "visible");
        }else if(selValue == "text"){
            $(".hiddenbox").css("visibility", "hidden");
           
        }else{
        }
    });

    </script> 



    <script> 
        $(document).ready(function(){
            var postUrl = "{{route('campaign-option.store')}}";
            var i=1; 

            $('#add_more').click(function(e){  
                e.preventDefault(); 
                i++;  
               $('#dynamic').append(
                '<div class="hiddenbox">'+
                '<div class="row  dynamic-add"  id="row'+i+'">'+
                '<div class="col-sm-6 mb-3  d-inline px-4 py-2"  >'+
                '<input type="text" class="form-control" placeholder="Please Enter Option Message" name="values[]" value="">'+
                '</div>'+
                '<div class="col-sm-1 d-inline">'+
                '<div class="btn_remove btn btn-danger btn-submit" id="'+i+'" type="button">X</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>');  
            });

          $(document).on('click','.btn_remove', function(){ 
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
          });  

          $(document).on('click','.remove', function(){ 
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
          });
        });
    </script>  
    <script>
        $(document).ready(function(){
            $(".btn-submit").click(function(e){
            e.preventDefault();
             var campaignvalueid = $(this).data('id');
           
             $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
               type:"POST",
               url:"{{route('remove')}}", 
               data:{campaignvalueid:campaignvalueid,},
               success:function(data){
                console.log(data);
                    Command: toastr["success"](data.success)
                        toastr.options = {
                          "closeButton": true,
                          "debug": false,
                          "newestOnTop": true,
                          "progressBar": true,
                          "positionClass": "toast-top-right",
                          "preventDuplicates": false,
                          "hideDuration": "1000",
                          "timeOut": "1000",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        }
                        // location.reload();
                        window.setTimeout(function(){location.reload()},1000)
                    }
                });
            });
        });
    </script>
    <script>
         $(document).ready(function(){
             $(".btn_remove").click(function(e){
                e.preventDefault();
                $(this).parents('.remove1').hide();
             });
         });
    </script>






































    {{-- <script>
        $(document).ready(function(){
            $(".btn-submit").click(function(e){
            e.preventDefault();
             var removeValueOption = $(this).data('id');
             $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
               type:"POST",
               url:"{{route('remove')}}", 
               data:{removeValueOption:removeValueOption,},
               success:function(data){
                        Toaster(data.success);
                            // $(".campaigninput").load(location.href + ".campaigninput");
                            $('.flash-message').fadeOut(3000, function() {
                                location.reload(true);
                            });
                    }
                });
            });
        });
    </script> --}}

   
    <script>
        $(document).ready(function() {
                inputData();
        });

        function inputData()
        {
            var data = $('#parent_option').val();
             if(data){
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
               type:"POST",
               url:"{{route('parent-change-value')}}", 
               data:{data:data,},
               success:function(data){
               
                console.log(data);
                        var html = `<option selected disable value="">Select Parent Value</option>`;
                        $("#parent_value").css("visibility", "visible");
                        $.each(data.filterValueList, function(key, parentValue) {
                             html += `<option value="${parentValue.value_id}" ${parentValue.value_id == data.parentvalueid ? 'selected' : ''}>${parentValue.name}</option>`;
                        });
                        $("#parent_option_value").html(html);
                    }
                });
                $("#parent_value").css("visibility", "visible");
             }else{
                $("#parent_value").css("visibility", "hidden");
             }
        }

        $(document).ready(function(){
            $("#parent_value").css("visibility", "hidden");
            $('#parent_option').on('change',function(e){
                e.preventDefault();
            var data = $(this).val();
            if(data){
             $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
               type:"POST",
               url:"{{route('parent-change-value')}}", 
               data:{data:data,},
               success:function(data){
               
                        var html = `<option selected disable value="">Select Parent Value</option>`;
                        $("#parent_value").css("visibility", "visible");
                        $.each(data.filterValueList, function(key, parentValue) {
                             html += `<option value="${parentValue.value_id ==  data.parentvalueid ? 'selected' : ''}">${parentValue.name}</option>`;
                        });
                        $("#parent_option_value").html(html);
                    }
                });
                    

                }else{
                    $("#parent_value").css("visibility", "hidden");
                }
                
            })

        });
    </script>
     <script>
        $(document).ready(function(){
            $(".btn_remove").click(function(e){
               e.preventDefault();
               $(this).parents('.remove1').hide();
            });
        });
   </script>
    <!-- hide show section radio button start-->

    <!-- hide show section end-->
    @endpush
    <!-- script end-->
</x-app-layout>