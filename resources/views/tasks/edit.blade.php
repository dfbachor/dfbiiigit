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
                        <form class="form-horizontal" role="form" id="taskForm" method="post" action="/tasks/update"> 
                            {{ csrf_field() }}

                                <input value='{{ $task->id }}'class="form-control" type="hidden" id="id" name = "id"> 					    
                                
                            <div class="form-group">
                                <label for="task" class="control-label col-sm-3">Task:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">
                                    <input value='{{ $task->task }}'class="form-control" type="text" id="task" name="task" placeholder="task" data-error="task is required" required> 					    
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label for="assignedToUserId" class="control-label col-sm-3">Assigned To User:<strong style="color:darkred;">*</strong></label>
                                <div class="col-sm-9">	
                                        <select class="form-control" name="assignedToUserId" id="assignedToUserId">
                                            @foreach($users as $user)
                                                @if($user->id == $task->assignedToUserId)
                                                    <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                                @else
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label for="openDate" class="control-label col-sm-3">Open Date:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">	
                                    <input class="form-control" id="openDate" name="openDate" value="{{ $task->created_at }}" placeholder="04/20/2018" data-error="date is invalid" required>
                                </div> 
                            </div>
                            
                            <div class="form-group">
                                <label for="closedDate" class="control-label col-sm-3">Close Date:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">	
                                    <input class="form-control" id="closedDate" name="closedDate" value="{{ $task->closed_at }}" placeholder="04/20/2018" data-error="date is invalid">
                                </div> 
                            </div>
                    
                
                            <div class="form-group">
                                <label for="status" class="control-label col-sm-3">Status:
                                    <strong style="color:darkred;">*</strong>
                                </label> 
                                <div class="col-sm-9">	
                                    <select class="form-control input-sm" id="status" name="status">
                                        <option value=".">Select Select</option>
                                        <option value="Open">Open</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Pending">Canceled</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                
                            <input type="submit" id="editTaskSubmitButton" class="btn btn-info" value="Edit task">
                
                        </form>		
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('javascripts')
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
            $(function() {
                $( "#openDate" ).datepicker({
                });
            });


            $(function() {
                $( "#closedDate" ).datepicker({
                });
            });

            $(function() {

                $('#status').val('{{ $task->status }}');

            });


    </script>

@endsection

