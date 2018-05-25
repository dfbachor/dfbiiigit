@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add User</div>
    
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" id="plantForm" method="post" action="/plants/store" enctype="multipart/form-data"> 
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="type" class="control-label col-sm-3">Type:<strong style="color:darkred;">*</strong></label>
                                <div class="col-sm-9">	
                                    <select class="form-control" id="type" name="type">
                                        <option value=".">Select Type</option>
                                        <option value="Seed">Seed</option>
                                        <option value="Clone">Clone</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="strain" class="control-label col-sm-3">Strain:<strong style="color:darkred;">*</strong></label>
                                <div class="col-sm-9">	
                                        <select class="form-control" name="strain" id="strain">
                                            <option value="">Select Strain</option>
                                            @foreach($strains as $strain)
                                                <option value="{{$strain->id}}">{{$strain->strainName}}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="stage" class="control-label col-sm-3">Stage:<strong style="color:darkred;">*</strong></label>
                                <div class="col-sm-9">	
                                        <select class="form-control" name="stage" id="stage">
                                            <option value="">Select Stage</option>
                                            @foreach($stages as $stage)
                                                <option value="{{$stage->id}}">{{$stage->stageName}}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="room" class="control-label col-sm-3">Room:<strong style="color:darkred;">*</strong></label>
                                <div class="col-sm-9">	
                                        <select class="form-control" name="room" id="room">
                                            <option value="">Select Room</option>
                                            @foreach($rooms as $room)
                                                <option value="{{$room->id}}">{{$room->roomName}}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="form-group">
                                    <label for="medium" class="control-label col-sm-3">Medium:<strong style="color:darkred;">*</strong></label>
                                    <div class="col-sm-9">	
                                            <select class="form-control" name="medium" id="medium">
                                                <option value="">Select Medium</option>
                                                @foreach($mediums as $medium)
                                                    <option value="{{$medium->id}}">{{$medium->mediumName}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
    

                            <div class="form-group">
                                <label for="startDate" class="control-label col-sm-3">Start Date:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">	
                                    <input class="form-control"  id="startDate" name="startDate" value="" placeholder="04/20/2018" data-error="date is invalid" required>
                                </div> 
                            </div>
    
                            <input type="submit" class="btn btn-info" value="Add Plant">

                        </form>		
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection


@section('javascripts');
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
            $(function() {
                $( "#startDate" ).datepicker({
                    dateFormat: 'mm/dd/yy',
                });
            });

    </script>
@endsection