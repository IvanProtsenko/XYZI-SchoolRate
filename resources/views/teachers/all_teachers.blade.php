@extends('layouts.app')

@section('content')

    <div class="row" style = "margin-top: 10px">
        <div class="col-md-8">
            @foreach($teachers as $teacher)
                            <div class="card-group" style="margin-left: 30px">
                                <div class="card" style="border: 1px solid grey">
                                    <div class="card-footer">
                                        <div class="float-left" style="margin-bottom: -33px">
                                            <a href="{{url('/profile'.$teacher->id)}}">
                                                <h4><b>{{$teacher->name}}</b></h4></a>
                                        </div>
                                        <div class="float-right" style="margin-right:15px">
                                            <b>{{$teacher->subject}}</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-body">
                                                <div class="float-left">
                                                    Дата рождения: {{$teacher->age==null?'':$teacher->age->format('Y-m-d')}}
                                                </div>
                                                <div class="text-center" style="margin-bottom: -33px">
                                                    Стаж работы: {{$teacher->stage}} года
                                                </div>
                                                <div class="float-right">
                                                    {{"??"}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <br>
                @endforeach
        </div>
        <div class="col-md-4">
            <div class="card" style="margin-right: 30px">
                <div class="card-header">
                    <h2 class="card-title">Сортировать по:</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="form-group form-check">
                            <br>
                            <div class="float-left">
                                <input type="submit" value="Применить" class = "btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
