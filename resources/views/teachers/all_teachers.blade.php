@extends('layouts.app')

@section('content')
    <br>
    <div class="row" style = "margin-top: -30px">
        <div class="col" style="margin: -10px">
            <div class="float-left">
                <h2 class="nav-link" style="color: blue">События</h2>
            </div>
            <div class="text-center" style="margin-right: 10px">
                <a class="nav-link" href="{{url('/insider/events/old')}}" style="color:black"><h2>Архив событий</h2></a>
            </div>
            <div class="float-right" style="margin-top: -50px;">
                <a href="{{url('/insider/events/add_event')}}" class = "btn btn-success">Провести событие</a>
            </div>
        </div>
    </div>
    <div class="row" style = "margin-top: 10px">
        <div class="col-md-8">
                            <div class="card-group">
                                <div class="card" style="border: 1px solid grey">
                                    <div class="card-footer">
                                        <div class="text-center" style="margin-bottom: -33px">
                                            <h4><b>{{"Name"}}, ({{"Stage"}})</b></h4>
                                        </div>
                                        <div class="float-right" style="margin-right:15px">
                                            <b>{{"Subject"}}</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-body">
                                                {{"SMTH"}}
                                                <div class="float-right">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Теги:</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="form-group form-check">
                            <br>
                            <div class="float-left">
                                <input type="submit" value="Применить" class = "btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
