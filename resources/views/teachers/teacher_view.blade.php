@extends('layouts.app')

@section('content')
    <div class="card-group">
        <div class="col-md-4">
            <div class="card" style="margin-left: 30px; margin-right: 50px; width: 400px;">
                <img class="card-img-top"
                     src="{{url('/media/'.$teacher->image)}}"/>
            </div>
        </div>
        <div class="card" style="margin-right: 30px; height: 125px">
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
                @if(\Auth::User()->status == "student")
                    <a href={{"/main/$teacher->id/like"}}>
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/thumb-up.png">
                    </a>
                    <a href={{"/main/$teacher->id/dislike"}}>
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/thumbs-down.png">
                    </a>
                    @endif
                    @if($teacher->likes > -1)<b>{{$teacher->likes}}%</b>
                    @else <b>Нет отзывов</b>
                    @endif
                </div>
            </div>
            @if(\Auth::User()->status == "student")
            <div class="rounded border border-primary" style="margin-top: 20px; padding: 10px">
                <form action="{{url('/profile'.$teacher->id.'/review')}}" method="post">
                    {{csrf_field()}}
                    <label for="comment"><b>Новый комментарий:</b></label>
                    <textarea class="form-control" id="comment" name="text"
                              rows="3" placeholder="Оставьте свой комментарий тут"></textarea>
                    <input type="submit" value="Оставить отзыв" class="btn btn-primary"
                           style="margin-top: 10px;"/>
                </form>
            </div>
            @endif
            @if(\Auth::User()->status == "moderator" || \Auth::User()->status == "director")
                <h1 style="margin-top: 20px; margin-bottom: 20px"><b>Комментарии к учителю:</b></h1>
            @elseif(\Auth::User()->status == "student")
                <h1 style="margin-top: 20px; margin-bottom: 20px"><b>Ваши комментарии к учителю:</b></h1>
            @endif
            @foreach($reviews as $review)
                @if($review->id_send == \Auth::User()->id || \Auth::User()->status == "moderator"
                || (\Auth::User()->status == "moderator" || $review->status == "accepted"))
                    <div class="jumbotron" style="padding: 20px">
                        <h4 class="display-6">Дата создания комментария: <b>{{$review->created_at}}</b>
                            @if($review->id_send == \Auth::User()->id || \Auth::User()->status == "moderator"
                            || (\Auth::User()->status == "moderator" || $review->status == "accepted"))
                                <a href={{"/profile$teacher->id/delete_rev/$review->id"}}>
                                    <img src="https://img.icons8.com/color/48/000000/cancel.png" width="25px"></a>
                            @endif
                        </h4>
                        <hr class="my-4">
                        {{$review->text}}
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection
