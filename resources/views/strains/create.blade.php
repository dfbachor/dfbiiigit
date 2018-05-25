@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Plant Type</div>
    
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" id="strainForm" method="post" action="/strains/store" enctype="multipart/form-data"> 
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="strainName" class="control-label col-sm-3">Plant Type Name:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="strainName" name="strainName" placeholder="plant type name" data-error="strain name is required" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="testingStatus" class="control-label col-sm-3">Testing Status:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">	
                                    <input class="form-control"  id="testingStatus" name="testingStatus" value="" data-error="testing status" required>
                                </div> 
                            </div>
                        
                                <div class="form-group">
                                    <label for="floweringTimeInDays" class="control-label col-sm-3">Flowering Time In Days:<strong style="color:darkred;">*</strong></label> 
                                    <div class="col-sm-9">	
                                        <input class="form-control" id="floweringTimeInDays" name="floweringTimeInDays" value="" placeholder="flowering time in days" data-error="Flowering time in days is required">
                                    </div> 
                                </div>
                            
                                <div class="form-group">
                                <label for="genetics" class="control-label col-sm-3">Information/Genetics:<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">	
                                    {{--  <input class="form-control" id="strainInformation" name="strainInformation" value="" placeholder="Information about the strain" data-error="strain information is required">  --}}
                                    <textarea class="form-control" placeholder="plant Type Information" name="genetics" id='genetics' rows='3' maxlength='2000'></textarea>
                                </div> 
                            </div>

                            <input type="submit" class="btn btn-info" value="Add Strain">

                        </form>		
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection


