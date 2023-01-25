<style>
    .fixed_add_btn{
        margin-top: 17px !important;
        margin-left: -13px !important;
    }
</style>
<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
                   
                    <form action="{{route('campaign-option.store')}}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">Add Campaign Option</h5>
                        </div>
                        <input type="hidden" value="{{session()->get('campaignId')}}" name="campaign_id" id="campaign_id">
                        <div class="row" id="dynamic">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Parent Option<span class="text-danger"></span></label>
                                    <select class="form-select form-control" name="parent_option" id="parent_option">
                                        <option selected disable value="">Select Parent</option>
                                        @foreach($CampaignOption as $key => $parent_list)

                                        <option value="{{$parent_list->option_id}}">{{$parent_list->option_name}}</option>
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

                                        <input value="{{old('name')}}" type="text" class="form-control "
                                            placeholder="Please Enter Name" name="name" required>
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
                                        <input value="{{old('message')}}" type="text" class="form-control "
                                            placeholder="Please Enter Message" name="message" required>
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
                                        <input value="{{old('sort_order')}}" type="number" class="form-control "
                                            placeholder="Please Enter Sort Order" name="sort_order" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter Sort Order</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">WhatsApp Template Code<span class="text-danger"></span></label>
                                    <div class="form-icon position-relative">
                                        <input value="{{old('wp_template_code')}}" type="text" class="form-control "
                                            placeholder="Enter WhatsApp Template Code" name="wp_template_code">
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
                                            <option value="0">Text</option>
                                         <option value="1">Template</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please Select Option Type</p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="form-select form-control" name="status" id="status"
                                        required>
                                        <option selected disable value="">Select Status</option>
                                         <option value="1">Active</option>
                                         <option value="2">In-Active</option>

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
                                                <input class="form-check-input showbox" type="radio" name="reply" id="text" value="text">
                                                
                                              </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="inlineRadio2">Button</label>
                                                <input class="form-check-input showbox" type="radio" name="reply" id="button" value="button">
                                               
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 hiddenbox">
                                <div class="px-4 py-2">
                                    <label class="form-label">Button Values<span class="text-danger"></span></label>
                                    <div class="form-icon position-relative">
                                        <input value="{{old('values')}}" type="text" class="form-control d-inline "
                                            placeholder="Please Enter Option Message" name="values[]" >
                                        <div class="invalid-feedback">
                                            <p>Please enter Button Values</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 py-4 fixed_add_btn hiddenbox">
                                <button class="btn btn-primary" type="submit" id="add_more"><i
                                        class="fa fa-plus"></i></button>
                            </div> 
                            
                        </div>
                        
                        
                        
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12 my-4 mx-4">
                                <input type="submit" class="btn btn-primary" value="Add">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--script start-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>    
    @push('scripts')

<script>
    $(document).ready(function(){
        // $(".hiddenbox").hide();
        $(".hiddenbox").css("visibility", "hidden");
    $('.showbox').click(function() {
        var selValue =    $('input[type=radio][name=reply]:checked').attr('id')
        if(selValue == "button")
        {
            // $(".hiddenbox").show();
            $(".hiddenbox").css("visibility", "visible");

        }else if(selValue == "text"){
            // $(".hiddenbox").hide();
            $(".hiddenbox").css("visibility", "hidden");
           
        }else{
        }
    });
    });
</script>



    <script>
        $(document).ready(function(){
            $('#changeinputbox').on('change',function(){
                var data = $(this).val();
               
            });
        });
    </script>
    <script>
        $(document).ready(function() {
        var i = 1;

        $('#add_more').click(function(e) {
            e.preventDefault();
            i++;
            $('#dynamic').append(
               
                '<div class="row  dynamic-add hiddenbox" id="row' + i + '" >' +
                '<div class=" col-sm-5 px-1 ms-5">' +
                '<label class="form-label">Button Values<span class="text-danger"></span></label>'+
                '<input type="text" class="form-control"  placeholder="Please Enter Option Message" name="values[]" value="" >' +
                '</div>' +
                '<div class="col-sm-6 mt-4">' +
                '<div class="btn_remove btn btn-danger hiddenbox" id="' + i + '" type="button">X</div>' +
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
    </script>
    <script>
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
                             html += `<option value="${parentValue.value_id}">${parentValue.name}</option>`;
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
      <!-- hide show section radio button start-->
   
    <!-- hide show section end-->
    @endpush
    <!-- script end-->
</x-app-layout>