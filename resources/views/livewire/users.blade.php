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
                                <td>{{$user->name}}@if($user->admin)
                                        <i style="color: gold" class="fas fa-crown"></i>
                                    @endif</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm"
                                            onclick="replaceModalData('{{$user->api_token}}', '{{$user->name}}')"
                                            data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                                        Zeigen
                                    </button>
                                </td>
                                <td>
                                    @if($user->standing)
                                        <i style="color: green" class="fas fa-check"></i>
                                    @else
                                        <i style="color: red" class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($user->standing)
                                        <button onclick="changeState(false, {{$user->id}})"
                                                class="btn btn-danger btn-sm float-end"
                                                style="margin-right: 10px" id="stand_button">
                                            @else
                                                <button onclick="changeState(true, {{$user->id}})"
                                                        class="btn @if($user->deactivated) btn-secondary @else btn-success @endif btn-sm float-end" @if($user->deactivated) disabled @endif
                                                        style="margin-right: 10px" id="stand_button">
                                                    @endif
                                                    @if($user->standing)
                                                        {{__('Hinsetzen')}}
                                                    @else
                                                        {{__('Aufstehen')}}
                                                    @endif
                                                </button>
                                                @if($user->deactivated)
                                                    <button onclick="changeActive(0, {{$user->id}})"
                                                            class="btn btn-success btn-sm float-end"
                                                            style="margin-right: 10px" id="stand_button">
                                                        @else
                                                            <button onclick="changeActive(1, {{$user->id}})"
                                                                    class="btn btn-danger btn-sm float-end"
                                                                    style="margin-right: 10px" id="stand_button">
                                                                @endif
                                                                @if($user->deactivated)
                                                                    {{__('Aktivieren')}}
                                                                @else
                                                                    {{__('Deaktivieren')}}
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('API Key')}} - <span
                            id="apiTokeUsername">User</span></h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: center"><code id="apiText">...</code></div>
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

        function changeActive($val, $id) {
            $.ajax({
                url: '{{ route('changeActive') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "value": $val,
                    "user": $id
                },
                dataType: 'json',
                success: function (data) {
                }
            });
            changeState(false, $id);
        }

        function replaceModalData($token, $user) {
            $('#apiText').text($token);
            $('#apiTokeUsername').text($user);
        }
    </script>
@endpush