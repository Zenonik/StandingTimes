<div wire:poll.keep-alive class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><b><i class="fas fa-users"></i> {{ __('Benutzer') }}</b>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead style="color: white">
                        <tr>
                            <th scope="col">{{__('ID')}}</th>
                            <th scope="col">{{__('Profilbild')}}</th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('API Key')}}</th>
                            <th scope="col">{{__('Steht')}}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody style="color: white">
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td><img style="width: 30px; height: 30px"
                                         src="{{($user->avatar) ? asset('storage/'.($user->avatar)) : "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) ) . "?s=" . 400}}"
                                         class="rounded-circle" height="25"
                                         loading="lazy"/></td>
                                <td>{{$user->name}}@if($user->admin) <i style="color: gold" class="fas fa-crown"></i> @endif</td>
                                <td>{{$user->api_token}}</td>
                                <td>
                                    @if($user->standing)
                                        <i style="color: green" class="fas fa-check"></i>
                                    @else
                                        <i style="color: red" class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($user->standing)
                                        <button onclick="changeState(false, {{$user->id}})" class="btn btn-danger btn-sm float-end"
                                                style="margin-right: 10px" id="stand_button">
                                            @else
                                                <button onclick="changeState(true, {{$user->id}})" class="btn btn-success btn-sm float-end"
                                                        style="margin-right: 10px" id="stand_button">
                                                    @endif
                                                    @if($user->standing)
                                                        {{__('Hinsetzen')}}
                                                    @else
                                                        {{__('Aufstehen')}}
                                                    @endif
                                                </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function changeState($std, $id) {
            $.ajax({
                url: '{{ route('newEntryForUser') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "key": "{{Auth::user()->api_token}}",
                    "value": $std,
                    "user": $id
                },
                dataType: 'json',
                success: function (data) {
                }
            });
        }
    </script>
@endpush