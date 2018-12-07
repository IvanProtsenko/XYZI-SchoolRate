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
                    <h4><b>{{$teacher->name}}</b></h4>
                </div>
                <div class="float-right" style="margin-right:15px">
                    <h5>Предмет: <b>{{$teacher->subject}}</b></h5>
                </div>
            </div>
            <div class="card-body">
                <div class="float-left">
                    Email: <b>{{$teacher->email}}</b>
                </div>
                <div class="text-center" style="margin-bottom: -33px">
                    Стаж работы: {{$teacher->stage}}, Дата рождения: {{$teacher->age->format('Y-m-d')}}
                </div>
                <div class="float-right">
                    {{$teacher->status}}
                </div>
            </div>
        </div>
    </div>

    @if(\Auth::User()->status != "moderator")
    <div style="margin-right: 30px; margin-left: 510px; margin-top: 20px; border: 2px solid blue; padding: 10px">
        <form action="{{url('/profile'.$teacher->id.'/review/')}}" method="post">
            {{csrf_field()}}
            <label for="comment">Новый комментарий:</label>
            <textarea class="form-control" id="comment" name="text"
                      rows="3" placeholder="Оставьте свой комментарий тут"></textarea>
            <input type="submit" value="Оставить отзыв" class="btn btn-primary"
                   style="margin-top: 10px;"/>
        </form>
    </div>
    @endif

    @foreach($reviews as $review)
        @if($review->id_send == \Auth::User()->id || \Auth::User()->status == "moderator")
        <div class="card" style="margin-right: 30px; margin-left: 510px; margin-top: 20px;">
            <div class="card-footer text-white bg-dark">
                <div class="float-left">
                    <h6>Дата создания комментария: <b>{{$review->created_at}}</b></h6>
                </div>
                <div class="float-right">
                    @if(\Auth::User()->status == "moderator")
                    <h6 style="margin-left: -20px">Id отправящего: <b>{{$review->id_send}}</b></h6>
                    @endif
                    @if($review->id_send == \Auth::User()->id || \Auth::User()->status == "moderator")
                        <a href={{"/profile$teacher->id/delete_rev/$review->id"}}>
                            <img src="https://png.icons8.com/windows/50/000000/cancel.png" width="25px"></a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                {{$review->text}}
            </div>
        </div>
        @endif
    @endforeach
@endsection
