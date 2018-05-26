@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection


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
                                        Edit Room
                                </div>
                                <div class="col-xs-4 text-right">
                                    <a class='delete' href='/rooms/destroy/{{$room->id}}'>delete</a>
                                </div>
                        </div>
                    </div>
    
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" id="roomForm" method="post" action="/rooms/update"> 
                            {{ csrf_field() }}

                                <input value='{{ $room->id }}'class="form-control" type="hidden" id="id" name = "id"> 					    
                                
                                <div class="form-group">
                                    <label for="roomName" class="control-label col-sm-3">Room Name:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">
                                        <input value='{{ $room->roomName }}' class="form-control" type="text" id="roomName" name="roomName" placeholder="Room name" data-error="room name is required" required>
                                    </div>
                                </div>
                    
                                <div class="form-group">
                                    <label for="lighting" class="control-label col-sm-3">Lighting:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">	
                                        <input value='{{ $room->lighting }}' class="form-control"  id="lighting" name="lighting" value="" placeholder="light type / wattage / etc..." data-error="Lighting is required" required>
                                    </div> 
                                </div>
                                
                    
                                <div class="form-group">
                                    <label for="exhaustType" class="control-label col-sm-3">Exhaust Type:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">	
                                        <input value='{{ $room->exhaustType }}' class="form-control" id="exhaustType" name="exhaustType" value="" placeholder="exhaust type" data-error="Exhaust Type is invalid">
                                    </div> 
                                </div>
                    
                                <div class="form-group">
                                    <label for="humidifier" class="control-label col-sm-3">Humidifier:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">	
                                        <input value='{{ $room->humidifier }}' class="form-control" id="humidifier" name="humidifier" value="" placeholder="list humidifier" data-error="Humidifier is invalid">
                                    </div> 
                                </div>
                    
                                <div class="form-group">
                                    <label for="roomInformation" class="control-label col-sm-3">Room Information:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">	
                                        {{--  <input class="form-control" id="roomInformation" name="roomInformation" value="" placeholder="Information about the room" data-error="room information is required">  --}}
                                        <textarea class="form-control" placeholder="Room Information" name="roomInformation" id='roomInformation' rows='3' maxlength='2000'>{{ $room->comment }}</textarea>
                                    </div> 
                                </div>
                
                            <input type="submit" id="editRoomSubmitButton" class="btn btn-info" value="Edit Room">
                
                        </form>		
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


