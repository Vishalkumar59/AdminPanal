
<x-app-layout> 

<div class="container-fluid">
    <div class="layout-specing">
        <div class="col-12 col-lg-8 mt-5 pt-5 mx-auto">
            <div class="form-group mb-0 " id="short-form-container"@if(request()->session()->get('link')) style="display: none;"@endif>
                <form action="{{ route('guest') }}" method="post" enctype="multipart/form-data" id="short-form">
                    @csrf
                    <div class="row mx-auto" >
                        <div class="col-md-10 ">
                            <input type="text" dir="ltr" autocomplete="off" autocapitalize="none" spellcheck="false" name="url" class="form-control  form-control-lg font-size-lg" placeholder="{{ __('Shorten your link') }}" autofocus required>
                             @if ($errors->has('url'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </span>
                            @endif 
                        </div>
                         <input type="hidden" name="domain" value="{{ $defaultDomain }}">
                        <div class="col-md-2" >
                           <button class="btn btn-primary btn-md btn-block font-size-lg mt-3 mt-sm-0" type="submit" data-button-loader>
                                <div class="position-absolute top-0 right-0 bottom-0 left-0 d-flex align-items-center justify-content-center">
                                    <span class="d-none spinner-border spinner-border-sm width-4 height-4" role="status"></span>
                                </div>
                                <span class="spinner-text">{{ __('Shorten') }}</span>&#8203;
                            </button>
                        </div>
                    </div>

                   
                </form>
            </div>
           
        @if(request()->session()->get('link'))
         {{-- @dd(request()->session()->get('link')); --}}
             @foreach(request()->session()->get('link') as $link)
             {{-- @dd($link->domain->url); --}}
                <div class="form-group mt-5" id="copy-form-container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend ms-3">
                                    <span class=" bg-transparent border-success {{ (__('lang_dir') == 'rtl' ? 'border-left-0' : 'border-right-0') }}"><img  src="https://icons.duckduckgo.com/ip3/{{ parse_url($link->url)['host'] }}.ico"  rel="noreferrer" class="w-25 float-end"></span>
                                </div>
                                <input type="hidden" id="hidden_get_value" value="{{ str_replace(['http://', 'https://'], '', ($link->domain->url ?? config('app.url'))) . '/' . $link->alias }}">

                                 <input type="text" dir="ltr" id="url" name="url" class="form-control form-control-lg font-size-lg is-valid bg-transparent{{ (__('lang_dir') == 'rtl' ? ' border-right-0 pr-0' : ' border-left-0 pl-0') }}" value="{{ str_replace(['http://', 'https://'], '', ($link->domain->url ?? config('app.url'))) . '/' . $link->alias }}" onclick="this.select();" style="background-image: none;" readonly>
                            </div>
                            <span class="valid-feedback text-center mt-2 d-block" role="alert">
                                <strong>{{ __('Link successfully shortened.') }}</strong>
                            </span>
                        </div>

                        <div class="col-md-4">
                            <div class="btn-group btn-group-lg d-flex mt-3 mt-sm-0">
                                <button type="button" class="btn btn-sm btn-primary font-size-lg flex-grow-1"  onclick="copyText()">
                                   <span id="clipboard">Copy</span>
                                </button>

                                {{-- <button type="button" class="btn btn-primary font-size-lg dropdown-toggle dropdown-toggle-split reset-after flex-grow-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button> --}}
                                {{-- @include('Qrcode::whatsapp-boat.menu') --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
            {{-- @include('Qrcode::whatsapp-boat.shortlink') --}}
        </div>
    </div>
</div>
    <script>
       function copyText() {
       
      
            /* Select text area by id*/

            var Text = document.getElementById("hidden_get_value");
          
  
            /* Select the text inside text area. */
           Text.select();
  
            /* Copy selected text into clipboard */
            navigator.clipboard.writeText(Text.value);
  
            /* Set the copied text as text for 
            div with id clipboard */
            document.getElementById("clipboard")
                .innerHTML = "copied !";
        }

    </script>
</x-app-layout> 