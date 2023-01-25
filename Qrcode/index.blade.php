<style>
    #save_image {
        margin-left: 10em;
        margin-top: 14px;
    }
</style>
<x-app-layout>

    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row ">
                <div class="col-md-12 col-lg-12 my-4 lead_list">
                    <div class="card rounded shadow ">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">QR Code</h5>
                            </div>
                        </div>
                        <span class="mt-4">
                        </span>
                        <div class="form-outline">

                            <div class="p-4">
                                <div class="row mt-3">
                                    <div class="col-lg-6">

                                        <h3>QR Code generate</h3>
                                        <form method="post" action="{{route('generate-qr')}}"
                                            class="row g-3 needs-validation" novalidate>
                                            @csrf
                                            <div class="mb-3 mt-3">
                                                <label for="qr-message" class="form-label">url</label>
                                                <input type="text" class="form-control" placeholder="https://"
                                                    id="qr-message" name="qr_message" aria-describedby="message-help"
                                                    required>

                                            </div>
                                            <input type="submit" class="btn btn-primary w-25" value="Generate">
                                        </form>

                                    </div><!-- col-lg-8 -->
                                    <div class="col-lg-6">
                                        <div class="text-center">

                                            @if(\Session::has('qrImage'))
                                           {{--  <h2 class="mb-3"> <a
                                                    href="{{\Session::get('url_hit')}}">{{\Session::get('url_hit')}}</a>
                                            </h2> --}}
                                            <div class="mb-3">
                                                <img src="{{asset(Storage::url(\Session::get('qrImage'))) }}"
                                                    class="img img-responsive">
                                            </div>
                                            <a href="{{ asset(Storage::url(\Session::get('qrImage'))) }}"
                                                class="btn btn-primary" download>save</a>

                                            {{ \Session::forget('qrImage') }}
                                            @endif

                                        </div> <!-- row -->
                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>

                </div>
            </div>
            <!--end col-->
        </div>
    </div>

    <!--end row-->

    <script>
        (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
    </script>

</x-app-layout>