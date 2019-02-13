@extends('layouts.app')

@section('content')

    <div class="row" style = "margin-top: 10px">
        <div class="col-md-8">
            @foreach($teachers as $teacher)
                <div class="card" style="margin-left: 30px;">
                    <div class="card-footer bg-light text-dark">
                        <div class="float-left" style="margin-bottom: -33px; margin-right: 150px">
                            <h4>
                                @if(\Auth::User()->status == "moderator")
                                    <a onclick="return DeleteTeacher();" href={{"/main/delete_teacher".$teacher->id}}>
                                        <img src="https://img.icons8.com/color/48/000000/cancel.png" width="25px"></a>
                                    <a href={{"/main/edit_teacher".$teacher->id}}>
                                        <img src="https://img.icons8.com/color/48/000000/edit-file.png" width="25px"></a>
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
                                    @if($teacher->likes > -1)
                                        @if($teacher->likes > 75)
                                            <b style="color: green">{{$teacher->likes}}%</b>
                                        @elseif($teacher->likes > 50)
                                            <b style="color: yellowgreen">{{$teacher->likes}}%</b>
                                        @elseif($teacher->likes > 25)
                                            <b style="color: orange">{{$teacher->likes}}%</b>
                                        @elseif($teacher->likes <= 25)
                                            <b style="color: red">{{$teacher->likes}}%</b>
                                        @endif
                                    @else <b>Нет отзывов</b>
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
                                <div id = "stage" class="float-right stage">
                                    Стаж работы: {{$stage = idate('Y', \Carbon\Carbon::now()->format('Y'))-1970+$teacher->stage}}
                                    @if($stage % 10 == 1 && $stage != 11) год
                                    @elseif($stage % 10 > 1 && $stage % 10 < 5 && ($stage < 12 || $stage)) года
                                    @else лет
                                    @endif
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
            @if(\Auth::User()->status == "director" || \Auth::User()->status == "moderator")
                <div style="margin-right: 30px">
                    <a href="{{url('/main/feedback')}}"
                       class = "btn btn-primary btn-lg btn-block">Просмотреть отзывы</a>
                </div>
                @if(\Auth::User()->status == "moderator")
                    <div style="margin-right: 30px; margin-top: 20px">
                        <a href="{{url('/main/requests')}}"
                           class = "btn btn-primary btn-lg btn-block">Просмотреть запросы регистрации</a>
                    </div>
                    <div style="margin-right: 30px; margin-top: 20px">
                        <a href="{{url('/main/add_teacher')}}"
                            class = "btn btn-primary btn-lg btn-block">Добавить учителя</a>
                    </div>
                @endif
            @endif

        </div>
    </div>
    <script>
        function DeleteTeacher () {
            var deleted = confirm("Вы уверены, что хотите удалить учителя?");
            if (!deleted) {
                return false;
            }
            else return true;
        }
    </script>
@endsection
