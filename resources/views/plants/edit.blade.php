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
                        <form class="form-horizontal" role="form" id="plantForm" method="post" action="/plants/update"> 
                            {{ csrf_field() }}

                                <input value='{{ $plant->id }}'class="form-control" type="hidden" id="id" name = "id"> 					    
                                
                                <div class="form-group">
                                        <label for="type" class="control-label col-sm-3">Type:<strong style="color:darkred;">*</strong></label>
                                        <div class="col-sm-9">	
                                            <select class="form-control" id="type" name="type">
                                                <option value=".">Select Type</option>

                                                @if($plant->type == 'Seed')
                                                    <option value="Seed" selected>Seed</option>
                                                @else
                                                    <option value="Seed">Seed</option>
                                                @endif

                                                @if($plant->type == 'Clone')
                                                    <option value="Clone" selected>Clone</option>
                                                @else
                                                    <option value="Clone">Clone</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="strain" class="control-label col-sm-3">Strain:<strong style="color:darkred;">*</strong></label>
                                            <div class="col-sm-9">	
                                                    <select class="form-control" name="strain" id="strain">
                                                        <option value="">Select Strain</option>
                                                        @foreach($strains as $strain)
                                                            @if($strain->id == $plant->strainID)
                                                                <option value="{{$strain->id}}" selected>{{$strain->strainName}}</option>
                                                            @else
                                                                <option value="{{$strain->id}}">{{$strain->strainName}}</option>
                                                            @endif
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
                                                        @if($stage->id == $plant->strainID)
                                                            <option value="{{$stage->id}}" selected>{{$stage->stageName}}</option>
                                                        @else
                                                            <option value="{{$stage->id}}">{{$stage->stageName}}</option>
                                                        @endif
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
                                                        @if($room->id == $plant->roomID)
                                                            <option value="{{$room->id}}" selected>{{$room->roomName}}</option>
                                                        @else
                                                            <option value="{{$room->id}}">{{$room->roomName}}</option>
                                                        @endif
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
                                                        @if($medium->id == $plant->mediumID)
                                                            <option value="{{$medium->id}}" selected>{{$medium->mediumName}}</option>
                                                        @else
                                                            <option value="{{$medium->id}}">{{$medium->mediumName}}</option>
                                                        @endif                                 
                                                @endforeach
                                                </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="startDate" class="control-label col-sm-3">Start Date:<strong style="color:darkred;">*</strong></label> 
                                        <div class="col-sm-9">	
                                            <input value='{{ $plant->startDate }}' class="form-control"  id="startDate" name="startDate" value="" placeholder="04/20/2018" data-error="date is invalid" required>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label for="cycleChangeDate" class="control-label col-sm-3">Cycle Change Date:<strong style="color:darkred;">*</strong></label> 
                                        <div class="col-sm-9">	
                                            <input value='{{ $plant->cycleChangeDate }}' class="form-control"  id="cycleChangeDate" name="cycleChangeDate" value="" placeholder="04/20/2018" data-error="date is invalid">
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label for="harvestDate" class="control-label col-sm-3">Harvest Date:<strong style="color:darkred;">*</strong></label> 
                                        <div class="col-sm-9">	
                                            <input value='{{ $plant->harvestDate }}' class="form-control"  id="harvestDate" name="harvestDate" value="" placeholder="04/20/2018" data-error="date is invalid" >
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label for="completeDate" class="control-label col-sm-3">Complete Date:<strong style="color:darkred;">*</strong></label> 
                                        <div class="col-sm-9">	
                                            <input value='{{ $plant->completeDate }}' class="form-control"  id="completeDate" name="completeDate" value="" placeholder="04/20/2018" data-error="date is invalid" >
                                        </div> 
                                    </div>
                    
                                    <div class="form-group">
                                        <label for="yield" class="control-label col-sm-3">Yield:<strong style="color:darkred;">*</strong></label> 
                                        <div class="col-sm-9">	
                                            <input value='{{ $plant->yield }}' class="form-control"  id="yield" name="yield" value="" placeholder="04/20/2018" data-error="date is invalid" >
                                        </div> 
                                    </div>
                    
                                <input type="submit" id="editPLantSubmitButton" class="btn btn-info" value="Edit Plant">
                
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

            $(function() {
                $( "#cycleChangeDate" ).datepicker({
                    dateFormat: 'mm/dd/yy',
                });
            });

            $(function() {
                $( "#harvestDate" ).datepicker({
                    dateFormat: 'mm/dd/yy',
                });
            });

            $(function() {
                $( "#completeDate" ).datepicker({
                    dateFormat: 'mm/dd/yy',
                });
            });

    </script>
@endsection
