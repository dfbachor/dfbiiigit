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
                                    Rooms
                            </div>
                            <div class="col-xs-4 text-right">
                                    <a href='/rooms/create'>Add Room</a>
                            </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table" border='1'>
                                <tr>
                                    <td>Name</td>
                                    <td>Lighting</td>
                                    <td>About</td>
                                    <td>Plants</td>
                                    <td></td>
                                </tr>

                            @foreach($rooms as $room)
                                <tr>
                                    <td>{{ $room['roomName'] }}</td>
                                    <td>{{ $room['lighting'] }}</td>
                                    <td>{{ $room['comment'] }}</td>
                                    <td>tbd</td>
                                    <td><a href='/rooms/edit/{{ $room['id'] }}'>Edit</a></td>
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
