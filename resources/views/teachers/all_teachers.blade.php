@extends('layouts.app')

@section('content')
    
    <div class="row" style = "margin-top: 10px">
        <div class="col-md-8">
                            <div class="card-group">
                                <div class="card" style="border: 1px solid grey">
                                    <div class="card-footer">
                                        <div class="float-left" style="margin-bottom: -33px">
                                            <h4><b>{{"Name"}}</b></h4>
                                        </div>
                                        <div class="float-right" style="margin-right:15px">
                                            <b>{{"Subject"}}</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-body">
                                                <div class="float-left">
                                                    {{"image"}}
                                                </div>
                                                <div class="text-center" style="margin-bottom: -33px">
                                                    {{"stage, age"}}
                                                </div>
                                                <div class="float-right">
                                                    {{"rating"}}
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
