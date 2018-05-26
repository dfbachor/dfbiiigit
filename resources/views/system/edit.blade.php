@extends('layouts.app')


@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit System</div>
    
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" id="systemForm" method="post" action="/system/update" enctype="multipart/form-data">
                            {{ csrf_field() }}
            

                            <div class="form-group">
                                <label for="id" class="control-label col-sm-3">ID:</label> 
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="id" id="id" placeholder="id" value='{{ $system[0]->id }}' readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="companyName" class="control-label col-sm-3">Company Name<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="companyName" id="companyName" value='{{ $system[0]->companyName }}'>
                                </div>
                            </div>

                            {{--  <div class="form-group">
                                <label for="companyPhone" class="control-label col-sm-3">Company Phone</label> 
                                <div class="col-sm-9">
                                        <input type="text" class="form-control" name="companyPhone" id="companyPhone" placeholder="John doe" value='{{ app('system')->companyPhone }}'>
                                </div>
                            </div>  --}}

                            <div class="form-group">
                                <label for="companyEmail" class="control-label col-sm-3">Email<strong style="color:darkred;">*</strong></label> 
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="johndoe@domain.com" value='{{ $system[0]->email }}'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="companyLogo" class="control-label col-sm-3">Company Logo:</label> 
                                <div class="col-sm-6">	
                                    <input class="form-control" type="file" id="companyLogo" name="companyLogo" placeholder="Image File Name">
                                </div>
                                <div class="col-sm-3">
                                    {{-- <img width="100" height="100" src="{{ app('system')->imageFileName }}" /> --}}

                                    @if($system[0]->imageFileName == null || $system[0]->imageFileName == "")
                                        <img src="{{ route('image', ['filename' => 'system_1_1_default.png']) }}" style="width: 35px; height: 35px" class="img-rounded imgPopup img-responsive">
                                    @else
                                        <img src="{{ route('image', ['filename' => $system[0]->imageFileName]) }}" style="width: 35px; height: 35px" class="img-rounded imgPopup img-responsive">
                                    @endif
                                    
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info" value="Update" />
                        </form>         
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
