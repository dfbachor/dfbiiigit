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
                                    Plant Types
                            </div>
                            <div class="col-xs-4 text-right">
                                    <a href='/strains/create'>Add Plant Type</a>
                            </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table" border='1'>
                                <tr>
                                    <td>Plant Type</td>
                                    <td>Flowering Time in Days</td>
                                    <td>Testing Status</td>
                                    <td>Genetics</td>
                                    <td>Plants</td>
                                    <td></td>
                                </tr>

                            @foreach($strains as $strain)
                                <tr>
                                    <td>{{ $strain['strainName'] }}</td>
                                    <td>{{ $strain['floweringTimeInDays'] }}</td>
                                    <td>{{ $strain['testingStatus'] }}</td>
                                    <td style="width:100px">{{ $strain['genetics'] }}</td>
                                    <td>tbd</td>
                                    <td><a href='/strains/edit/{{ $strain['id'] }}'>Edit</a></td>
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
