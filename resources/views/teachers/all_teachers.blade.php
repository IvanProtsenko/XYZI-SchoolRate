@extends('layouts.app')

@section('content')

    <div class="row" style = "margin-top: 10px">
        <div class="col-md-8">
            @foreach($teachers as $teacher)
                <div class="card" style="margin-left: 30px;">
                    <div class="card-footer bg-light text-dark">
                        <div class="float-left" style="margin-bottom: -33px; margin-right: 150px">
                            <h4>@if(\Auth::User()->status == "moderator")
                                <a href={{"/main/delete_teacher".$teacher->id}}>
                                    <img src="https://img.icons8.com/color/48/000000/cancel.png" width="25px"></a>
                            @endif
                            <a href="{{url('/profile'.$teacher->id)}}">
                                <b>{{$teacher->name}}</b></a>
                                @if(\Auth::User()->status == "student")
                                    <a href={{"/main/$teacher->id/like_from_main/$selected"}}>
                                        <img src="https://img.icons8.com/ios-glyphs/30/000000/thumb-up.png">
                                    </a>
                                    <a href={{"/main/$teacher->id/dislike_from_main/$selected"}}>
                                        <img src="https://img.icons8.com/ios-glyphs/30/000000/thumbs-down.png">
                                    </a>
                                @endif
                                @if($teacher->likes > -1){{$teacher->likes}}%
                                    @else Нет отзывов
                                    @endif
                            </h4>
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
                <br>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="card" style="margin-right: 30px">
                <div class="card-footer bg-dark text-white">
                    <h2>Сортировать по:</h2>
                </div>
                <div class="card-body">
                    <form method="GET">
                        {{ csrf_field() }}
                        <div class="form-group form-check">
                            <div class="form-check">
                                <input type="radio" @if($selected == "1" || $selected=="0") checked @endif style="margin-left:-20px" name="sort" class="form-check-input" value="1">
                                <label for="sort" class="form-check-label" style="margin-left:2px" >имени</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" @if($selected == "2") checked @endif style="margin-left:-20px" name="sort" class="form-check-input" value="2">
                                <label for="sort" class="form-check-label" style="margin-left:2px" >предмету</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" @if($selected == "3") checked @endif style="margin-left:-20px" name="sort" class="form-check-input" value="3">
                                <label for="sort" class="form-check-label" style="margin-left:2px" >рейтингу</label>
                            </div>
                            <br>
                            <div class="float-left">
                                <input type="submit" value="Применить" class = "btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            @if(\Auth::User()->status == "moderator")
                <div style="margin-right: 30px">
                    <a href="{{url('/main/add_teacher')}}"
                        class = "btn btn-primary btn-lg btn-block">Добавить учителя</a>
                </div>
            @endif
        </div>
    </div>
@endsection
