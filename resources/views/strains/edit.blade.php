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
                        <form class="form-horizontal" role="form" id="strainForm" method="post" action="/strains/update"> 
                            {{ csrf_field() }}

                                <input value='{{ $strain->id }}'class="form-control" type="hidden" id="id" name = "id"> 					    
                                
                                <div class="form-group">
                                    <label for="strainName" class="control-label col-sm-3">Strain Name:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">
                                        <input value='{{ $strain->strainName }}' class="form-control" type="text" id="strainName" name="strainName" placeholder="strain name" data-error="strain name is required" required>
                                    </div>
                                </div>
                    
                                <div class="form-group">
                                    <label for="testingStatus" class="control-label col-sm-3">Testing Status:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">	
                                        <input value='{{ $strain->testingStatus }}' class="form-control"  id="testingStatus" name="testingStatus" value="" placeholder="Testing Status" data-error="Lighting is required" required>
                                    </div> 
                                </div>
                                
                            
                
                                <div class="form-group">
                                    <label for="floweringTimeInDays" class="control-label col-sm-3">Flowering Time In Days:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">	
                                        {{--  <input class="form-control" id="strainInformation" name="strainInformation" value="" placeholder="Information about the strain" data-error="strain information is required">  --}}
                                        <input value='{{ $strain->floweringTimeInDays }}' class="form-control" id="floweringTimeInDays" name="floweringTimeInDays" value="" placeholder="Flowering Time In Days" data-error="Flowering Time In Days is invalid">
                                    </div> 
                                </div>
                        
                                            <div class="form-group">
                                    <label for="genetics" class="control-label col-sm-3">Genetics:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">	
                                        {{--  <input class="form-control" id="strainInformation" name="strainInformation" value="" placeholder="Information about the strain" data-error="strain information is required">  --}}
                                        <textarea class="form-control" placeholder="Genetics" name="genetics" id='genetics' rows='3' maxlength='2000'>{{ $strain->genetics }}</textarea>
                                    </div> 
                                </div>
                
                                <input type="submit" id="editStrainSubmitButton" class="btn btn-info" value="Edit Strain">
                
                        </form>		
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection


