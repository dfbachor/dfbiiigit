@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">

                <div class="panel-heading">

                    <div class="row">
                            <div class="col-xs-4 text-left">
                                    <a href="{{url()->previous()}}"><span class="glyphicon glyphicon-circle-arrow-left"></a>
                            </div>
                            <div class="col-xs-4 text-center">
                                    Users
                            </div>
                            <div class="col-xs-4 text-right">
                                    <a href='/users/create'>Add User</a>
                            </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table" border='1'>
                                <tr>
                                    <td>Picture</td>
                                    <td>Name</td>
                                    <td>email</td>
                                    <td></td>
                                </tr>

                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        @if($user['imageFileName'] == null || $user['imageFileName'] == "")
                                            <img src="{{ route('image', ['filename' => app('system')->imageFileName]) }}" style="width: 35px; height: 35px" class="img-rounded imgPopup">
                                        @else
                                            <img src="{{ route('image', ['filename' => $user['imageFileName']]) }}" style="width: 35px; height: 35px" class="img-rounded imgPopup">
                                        @endif
                                    </td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td><a href='/users/edit/{{ $user['id'] }}'>Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
