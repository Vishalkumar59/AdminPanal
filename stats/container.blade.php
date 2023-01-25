<x-app-layout>

   <div class="container-fluid">
        <div class="layout-specing">
             @include('Qrcode::stats.header')
                 @include('Qrcode::stats.' . $view) 

                <div class="row mt-3 small text-muted">
                    <div class="col">
                        {{ __('Report generated on :date at :time (UTC :offset).', ['date' => \Carbon\Carbon::now()->format(__('Y-m-d')), 'time' => \Carbon\Carbon::now()->format('H:i:s'), 'offset' => \Carbon\CarbonTimeZone::create(config('app.timezone'))->toOffsetName()]) }} <a href="{{ Request::fullUrl() }}">{{ __('Refresh report') }}</a>
                    </div>
                </div>
            
            
        </div>
    </div><!--end container-->
    
</x-app-layout>