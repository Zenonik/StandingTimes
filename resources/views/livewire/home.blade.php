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
                                            <div class="col-md-2">
                                                <span class="text-center circle">{{ $pos }}</span>
                                                <?php $pos++ ?>
                                            </div>
                                            <div class="col-md-7">
                                                <h3 class="text-center">
                                                    {{ $array ? $item['user']['name'] : $item['user']->name }}
                                                    <img style="width: 45px; height: 45px"
                                                         src="{{($array ? $item['user']['avatar'] : $item['user']->avatar) ? asset('storage/'.($array ? $item['user']['avatar'] : $item['user']->avatar)) : "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $array ? $item['user']['email'] : $item['user']->email ) ) ) . "?s=" . 400}}"
                                                         class="rounded-circle" height="25"
                                                         loading="lazy"/>
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
