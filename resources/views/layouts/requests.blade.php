@extends('layouts.app')

@section('content')

    <div class="row" style = "margin-top: 10px">
        <div class="col-md-8">
            @foreach($users as $user)
                    <div class="card" style="margin-left: 30px;">
                        <div class="card-footer bg-light text-dark">
                            <div class="float-left" style="margin-right: 150px">
                                <b>{{$user->name}}</b>
                            </div>
                            <div class="float-right">
                                @if(\Auth::User()->status == "moderator" || \Auth::User()->status == "director")
                                    Пользователь:
                                    @if(\Auth::User()->status == "moderator")
                                        <a onclick="return AcceptUser()" href={{"/main/accept_user/$user->id"}}>
                                            <img src="https://img.icons8.com/flat_round/64/000000/checkmark.png" width="22px"></a>
                                        <a onclick="return DeleteUser()" href={{"/main/delete_user/$user->id"}}>
                                            <img src="https://img.icons8.com/color/48/000000/cancel.png" width="25px"></a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    Почта: <b>{{$user->email}}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
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
        function DeleteUser() {
            var deleted = confirm("Вы уверены, что хотите удалить пользователя?");
            if (!deleted) {
                return false;
            }
            else return true;
        }
        function AcceptUser() {
            var deleted = confirm("Вы уверены, что хотите дать пользователю возможность зайти на сайт?");
            if (!deleted) {
                return false;
            }
            else return true;
        }
    </script>
@endsection
