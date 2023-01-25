<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
                    <form action="{{route('store')}}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">Add Q&A</h5>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Question<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <input name="question" value="{{old('question')}}" type="text"
                                            class="form-control " placeholder="Please Enter Question" required>
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

                                        <input name="answer" value="{{old('answer')}}" type="text" class="form-control "
                                            placeholder="Please Enter Answer" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter Answer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Whatsapp Template Code<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <input name="whatsapp_code" value="{{old('whatsapp_code')}}" type="text"
                                            class="form-control " placeholder="Please Enter Whatsapp Template Code"
                                            required>
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
                                        <option selected disable value="">Select Language</option>
                                        <option value="1">English</option>
                                        <option value="2">French</option>
                                        <option value="3">Spanish</option>

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
                                <input type="submit" class="btn btn-primary" value="Submit">
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