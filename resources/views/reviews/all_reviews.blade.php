@extends('layouts.app')

@section('content')

    <div class="row" style = "margin-top: 10px">
        <div class="col-md-8">
            @foreach($reviews as $review)
                @if((\Auth::User()->status ==
                                "moderator" && $review->status == "waiting") || (\Auth::User()->status ==
                                "director" && $review->status == "accepted"))
                <div class="card" style="margin-left: 30px;">
                    <div class="card-footer bg-light text-dark">
                        <div style="margin-bottom: -20px; margin-right: 150px">
                            @foreach($teachers as $teacher)
                                @if($teacher->id == $review->id_get)
                                    <div class="float-left">
                                        <a href="{{url('/profile'.$review->id_get)}}"><h4><b>{{$teacher->name}}</b></h4></a>
                                    </div>
                                    <div class="float-right" style="margin-right: -150px">
                                        @if(\Auth::User()->status == "moderator" || \Auth::User()->status == "director")
                                            Отзыв:
                                            @if(\Auth::User()->status == "moderator")
                                                <a onclick="return AcceptRev()" href={{"/main/accept_rev/$review->id"}}>
                                                    <img src="https://img.icons8.com/flat_round/64/000000/checkmark.png" width="22px"></a>
                                            @endif
                                            <a onclick="return DeleteRev()" href={{"/profile$teacher->id/delete_rev/$review->id"}}>
                                                <img src="https://img.icons8.com/color/48/000000/cancel.png" width="25px"></a>
                                            @if(\Auth::User()->status == "moderator")
                                                <a onclick="return BanStudent()" href={{"/main/ban/$review->id_send"}}>
                                                    Забанить ученика</a>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card-body">
                                <b>{{$review->text}}</b>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                @endif
            @endforeach
        </div>
        <div class="col-md-4">
            @if(\Auth::User()->status == "moderator")
                <div style="margin-right: 30px">
                    <a href="{{url('/main/add_teacher')}}"
                       class = "btn btn-primary btn-lg btn-block">Добавить учителя</a>
                </div>
            @endif
        </div>
    </div>
    <script>
        function DeleteRev() {
            var deleted = confirm("Вы уверены, что хотите удалить отзыв?");
            if (!deleted) {
                return false;
            }
            else return true;
        }
        function AcceptRev() {
            var deleted = confirm("Вы уверены, что хотите принять отзыв?");
            if (!deleted) {
                return false;
            }
            else return true;
        }
        function BanStudent() {
            var deleted = confirm("Вы уверены, что хотите забанить этого ученика?");
            if (!deleted) {
                return false;
            }
            else return true;
        }
    </script>
@endsection
