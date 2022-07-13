<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><b><i class="fas fa-dashboard"></i> {{ __('Dashboard') }}</b>
                        <div class="float-end">
                            <select wire:model="filter_time" class="form-select form-select-sm">
                                <option value="1">Heute</option>
                                {{--<option value="2">Diese Woche</option>
                                <option value="3">Dieser Monat</option>--}}
                                <option value="4">Insgesamt</option>
                            </select>
                        </div>
                        @if($standing)
                            <button onclick="changeState(false)" class="btn btn-danger btn-sm float-end"
                                    style="margin-right: 10px" id="stand_button">
                                @else
                                    <button
                                        @if(!\Illuminate\Support\Facades\Auth::user()->deactivated) onclick="changeState(true)"
                                        @endif class="btn @if(\Illuminate\Support\Facades\Auth::user()->deactivated) btn-secondary @else btn-success @endif btn-sm float-end"
                                        style="margin-right: 10px" id="stand_button"
                                        @if(\Illuminate\Support\Facades\Auth::user()->deactivated) disabled @endif>
                                        @endif
                                        @if($standing)
                                            {{__('Hinsetzen')}}
                                        @else
                                            {{__('Aufstehen')}}
                                        @endif
                                    </button>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="background-color: #1266F1"><i
                                        class="fa fa-clock"></i> {{ __('Zeit gestanden') }}</div>
                                <div class="card-body" style="background-color: #3a3a3a">
                                    <h1 class="text-center">{{ $thisUser['time'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="background-color: #B23CFD"><i
                                        class="fa fa-star"></i> {{ __('Top Ranking') }}</div>
                                <div class="card-body" style="background-color: #3a3a3a">
                                    <?php $pos = 1 ?>
                                    @foreach($tops as $key => $item)
                                        <?php
                                        $array = false;
                                        if (is_array($item['user'])) {
                                            $array = true;
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <span class="text-center circle">{{ $pos }}</span>
                                                <?php $pos++ ?>
                                            </div>
                                            <div class="col-md-8">
                                                <h3 class="text-center" style="margin-left: 30px">
                                                    {{ $array ? $item['user']['name'] : $item['user']->name }}
                                                    <span>
                                                    <img style="width: 45px; height: 45px"
                                                         src="{{($array ? $item['user']['avatar'] : $item['user']->avatar) ? asset('storage/'.($array ? $item['user']['avatar'] : $item['user']->avatar)) : "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $array ? $item['user']['email'] : $item['user']->email ) ) ) . "?s=" . 400}}"
                                                         class="rounded-circle" height="25"
                                                         loading="lazy"/>
                                                            <div class="fa-stack fa-2xs" style="position: relative; bottom: 20px; right: 25px; width: 35px; color: {{colors($item["level"])}}">
                                                                <span class="fas fa-square fa-stack-2x"
                                                                      style="color: #262626"></span>
                                                                    <strong class="fa-stack-1x">
                                                                             {{$item["level"]}}
                                                                    </strong>
                                                            </div>
                                                        </span>
                                                </h3>
                                            </div>
                                            <div wire:poll.keep-alive class="col-md-3">
                                                <h5 class="text-center">{{ $item['time'] }}</h5>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" hidden>
                            <div class="card">
                                <div class="card-header" style="background-color: #00B74A"><i
                                        class="fa"></i> {{ __('') }}</div>
                                <div class="card-body" style="background-color: #3a3a3a">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" hidden>
                            <div class="card">
                                <div class="card-header" style="background-color: #FFA900"><i
                                        class="fa"></i> {{ __('') }}</div>
                                <div class="card-body" style="background-color: #3a3a3a">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function changeState($std) {
            $.ajax({
                url: '{{ route('newEntryForUser') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "key": "{{Auth::user()->api_token}}",
                    "value": $std
                },
                dataType: 'json',
                success: function (data) {
                }
            });
        @this.set('standing', $std);
        }
    </script>
@endpush
