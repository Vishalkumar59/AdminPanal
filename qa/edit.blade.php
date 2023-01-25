<x-app-layout>

      <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
                    {{-- @dd($whatsapp->id); --}}
                    <form action="{{route('update',['id' => $whatsapp->id])}}" method="POST" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">Update Q&A</h5>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Question<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        
                                        <input value="{{$whatsapp->question}}"  type="text"
                                            class="form-control " placeholder="Please Enter Question" name="question" required>
                                            <div class="invalid-feedback">
                                                <p>Please enter Question</p>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Answer<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <input  value="{{$whatsapp->answer}}" type="text" class="form-control "
                                            placeholder="Please Enter Answer" name="answer" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter Answer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Whatsapp Template Code<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        
                                        <input name="whatsapp_code" value="{{$whatsapp->whatsapp_code}}"  type="text" class="form-control "
                                            placeholder="Please Enter Whatsapp Template Code"required>
                                             <div class="invalid-feedback">
                                                <p>Please enter whatsapp template code</p>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Language<span class="text-danger">*</span></label>
                                    <select class="form-select form-control" name="language" id="language" required>
                                       
                                        <option  value="1" {{  ($whatsapp->language_code == '1') ? 'selected' : '' }}>English</option>
                                        <option  value="2" {{  ($whatsapp->language_code == '2') ? 'selected' : '' }}>French</option>
                                        <option  value="3" {{  ($whatsapp->language_code == '3') ? 'selected' : '' }}>Spanish</option>
                                       
                                    </select>
                                     <div class="invalid-feedback">
                                        <p>Please Select Language</p>
                                    </div>
                                    
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

</x-app-layout>