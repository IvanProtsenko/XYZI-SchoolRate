@extends('layouts.app')

@section('content')
    <div class="card-group">
        <div class="col-md-4">
            <div class="card" style="margin-left: 30px; margin-right: 50px; width: 400px;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and ma
                ke up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    <div class="card" style="margin-right: 30px">
        <div class="card-footer text-white bg-dark">
            <div class="float-left" style="margin-bottom: -33px">
                <h4><b>{{$teachers->name}}</b></h4>
            </div>
            <div class="float-right" style="margin-right:15px">
                <h5>Предмет: <b>{{$teachers->subject}}</b></h5>
            </div>
        </div>
        <div class="card-body">
            <div class="float-left">
                Email: <b>{{$teachers->email}}</b>
            </div>
            <div class="text-center" style="margin-bottom: -33px">
                Стаж работы: {{$teachers->stage}}, Дата рождения: {{$teachers->age->format('Y-m-d')}}
            </div>
            <div class="float-right">
                {{$teachers->status}}
            </div>
        </div>
    </div>
    </div>
@endsection
