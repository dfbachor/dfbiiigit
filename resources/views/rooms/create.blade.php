@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Room</div>
    
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" id="roomForm" method="post" action="/rooms/store" enctype="multipart/form-data"> 
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="roomName" class="control-label col-sm-3">Room Name:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="roomName" name="roomName" placeholder="Room name" data-error="room name is required" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lighting" class="control-label col-sm-3">Lighting:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">	
                                    <input class="form-control"  id="lighting" name="lighting" value="" placeholder="sunlight / indoor light etc...$_COOKIE" data-error="Lighting is required" required>
                                </div> 
                            </div>
                            
                            <div class="form-group">
                                <label for="humidifier" class="control-label col-sm-3">Humidifier:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">	
                                    <input class="form-control" id="humidifier" name="humidifier" value="" placeholder="list humidifier" data-error="Humidifier is invalid">
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="roomInformation" class="control-label col-sm-3">Room Information:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">	
                                    {{--  <input class="form-control" id="roomInformation" name="roomInformation" value="" placeholder="Information about the room" data-error="room information is required">  --}}
                                    <textarea class="form-control" placeholder="Room Information" name="roomInformation" id='roomInformation' rows='3' maxlength='2000'></textarea>
                                </div> 
                            </div>

                            <input type="submit" id="addroRoomomSubmitButton" class="btn btn-info" value="Add Room">

                        </form>		
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection


