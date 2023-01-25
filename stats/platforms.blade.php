
@if($remoteUser->can('stats', ['Modules\Qrcode\Models\Link', $remoteUser->plan->features->stats]) || (Auth::check() && Auth::user()->role == 1))
    <!-- Trending card -->
    <div class="card border-0 shadow-sm p-0 mb-3">
        <div class="px-3">
            <div class="row">
                <!-- Title -->
                <div class="col-12 col-md-auto d-none d-xl-flex align-items-center border-bottom border-bottom-md-0 {{ (__('lang_dir') == 'rtl' ? 'border-left-md' : 'border-right-md') }}">
                    <div class="px-2 py-4 d-flex">
                        <div class="d-flex position-relative text-primary width-10 height-10 align-items-center justify-content-center flex-shrink-0">
                            <div class="position-absolute bg-primary opacity-10 top-0 right-0 bottom-0 left-0 border-radius-xl"></div>
                            @include('Qrcode::icons.devices', ['class' => 'fill-current width-5 height-5'])
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md text-truncate">
                    <div class="row">
                        <!-- Trending up -->
                        <div class="col-12 col-md-6 border-bottom border-bottom-md-0 {{ (__('lang_dir') == 'rtl' ? 'border-left-md' : 'border-right-md')  }}">
                            <div class="px-2 py-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex align-items-center text-truncate">
                                            @if(isset($first->value))
                                                <div class="d-flex align-items-center {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">
                                                    
                                                </div>

                                                <div class="flex-grow-1 font-weight-bold text-truncate {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">
                                                    @if($first->value)
                                                        {{ $first->value }}
                                                    @else
                                                        {{ __('Unknown') }}
                                                    @endif
                                                </div>
                                            @else
                                                <div class="flex-grow-1 font-weight-bold text-truncate {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">{{ __('No data') }}</div>
                                            @endif

                                            <div class="align-self-end">{{ (isset($first->count) ? number_format($first->count, 0, __('.'), __(',')) : '—') }}</div>
                                        </div>

                                        <div class="d-flex align-items-center text-truncate text-success">
                                            <div class="d-flex align-items-center justify-content-center width-4 height-4 {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">@include('Qrcode::icons.trending-up', ['class' => 'fill-current width-3 height-3'])</div>

                                            <div class="flex-grow-1 text-truncate {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">{{ mb_strtolower(__('Most popular')) }}</div>

                                            <div>{{ (isset($first->count) ? number_format((($first->count / $total->count) * 100), 1, __('.'), __(',')).'%' : '—') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trending down -->
                        <div class="col-12 col-md-6">
                            <div class="px-2 py-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex align-items-center text-truncate">
                                            @if(isset($last->value))
                                                <div class="d-flex align-items-center {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">
                                                   
                                                </div>

                                                <div class="flex-grow-1 font-weight-bold text-truncate {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">
                                                    @if($last->value)
                                                        {{ $last->value }}
                                                    @else
                                                        {{ __('Unknown') }}
                                                    @endif
                                                </div>
                                            @else
                                                <div class="flex-grow-1 font-weight-bold text-truncate {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">{{ __('No data') }}</div>
                                            @endif
                                            <div class="align-self-end">{{ (isset($last->count) ? number_format($last->count, 0, __('.'), __(',')) : '—') }}</div>
                                        </div>

                                        <div class="d-flex align-items-center text-truncate text-danger">
                                            <div class="d-flex align-items-center justify-content-center width-4 height-4 {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">@include('Qrcode::icons.trending-down', ['class' => 'fill-current width-3 height-3'])</div>

                                            <div class="flex-grow-1 text-truncate {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}">{{ mb_strtolower(__('Least popular')) }}</div>

                                            <div>{{ (isset($last->count) ? number_format((($last->count / $total->count) * 100), 1, __('.'), __(',')).'%' : '—') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column">
        <div class="card border-0 shadow-sm">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md"><div class="font-weight-medium py-1">{{ __('Platforms') }}</div></div>
                    <div class="col-12 col-md-auto">
                        <div class="form-row">
                            @include('Qrcode::stats.filters', ['name' => __('Name'), 'count' => __('Clicks')])
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(count($platforms) == 0)
                    {{ __('No data') }}.
                @else
                    <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item px-0 text-muted">
                            <div class="row align-items-center">
                                <div class="col">
                                    {{ __('Name') }}
                                </div>
                                <div class="col-auto">
                                    {{ __('Clicks') }}
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item px-0 small text-muted">
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex text-truncate align-items-center">
                                        <div class="text-truncate">
                                            {{ __('Total') }}
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-baseline {{ (__('lang_dir') == 'rtl' ? 'mr-3 text-left' : 'ml-3 text-right') }}">
                                        <span>{{ number_format($total->count, 0, __('.'), __(',')) }}</span>

                                        <div class="width-16 text-muted {{ (__('lang_dir') == 'rtl' ? 'mr-3' : 'ml-3') }}">
                                            {{ number_format((($total->count / $total->count) * 100), 1, __('.'), __(',')) }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($platforms as $platform)
                            <div class="list-group-item px-0 border-0">
                                <div class="d-flex flex-column">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="d-flex text-truncate align-items-center">
                                            <div class="d-flex align-items-center {{ (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2') }}"></div>
                                            <div class="text-truncate">
                                                @if($platform->value)
                                                    {{ $platform->value }}
                                                @else
                                                    {{ __('Unknown') }}
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-baseline {{ (__('lang_dir') == 'rtl' ? 'mr-3 text-left' : 'ml-3 text-right') }}">
                                            <span>{{ number_format($platform->count, 0, __('.'), __(',')) }}</span>

                                            <div class="width-16 text-muted {{ (__('lang_dir') == 'rtl' ? 'mr-3' : 'ml-3') }}">
                                                {{ number_format((($platform->count / $total->count) * 100), 1, __('.'), __(',')) }}%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress height-1.25 w-100">
                                        <div class="progress-bar rounded" role="progressbar" style="width: {{ (($platform->count / $total->count) * 100) }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-3 align-items-center">
                            <div class="row">
                                <div class="col">
                                    <div class="mt-2 mb-3">{{ __('Showing :from-:to of :total', ['from' => $platforms->firstItem(), 'to' => $platforms->lastItem(), 'total' => $platforms->total()]) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    {{ $platforms->onEachSide(1)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="d-flex flex-column">
        <div class="card border-0 shadow-sm">
            @if(paymentProcessors())
                @if(Auth::check() && $remoteUser->id == Auth::user()->id)
                    @include('shared.features.locked')
                @else
                    @include('shared.features.unavailable')
                @endif
            @else
                @include('shared.features.unavailable')
            @endif
        </div>
    </div>
@endif