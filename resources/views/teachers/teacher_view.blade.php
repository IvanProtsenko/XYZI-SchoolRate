@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    <h4>{{$teachers->status}}</h4>
=======
    <div class="card" style="border: 1px solid grey">
        <div class="card-footer">
            <div class="float-left" style="margin-bottom: -33px">
                <h4><b>{{$teachers->name}}</b></h4>
            </div>
            <div class="float-right" style="margin-right:15px">
                <b>{{$teachers->email}}</b>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card-body">
                    <div class="float-left">
                        {{$teachers->status}}
                    </div>
                    <div class="text-center" style="margin-bottom: -33px">
                        {{$teachers->stage}}, {{$teachers->age}}
                    </div>
                    <div class="float-right">
                        {{$teachers->subject}}
                    </div>
                </div>
            </div>
        </div>
    </div>
>>>>>>> b4b1eb7450d924b289270ecc1ed4e231b57fcdad
@endsection
