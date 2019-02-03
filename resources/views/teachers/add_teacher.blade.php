@extends('layouts.app')

@section('content')
    <br>
    <h2 style="margin-top: -25px; margin-left: 30px">Добавить учителя</h2>
    <form method="POST" style="margin-right: 30px; margin-left: 30px" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class = "form-group required">
            <label>ФИО учителя</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class = "form-group required">
            <label>Email учителя</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class = "form-group required">
            <label>Предмет учителя</label>
            <input name="subject" class="form-control" required>
        </div>

        <div class = "form-group">
            <label>Дата начала преподавательства</label>
            <input type="date" name="age" class="form-control" >
        </div>

        <div class = "form-group">
            <label>Стаж работы</label>
            <input name="stage" class="form-control" >
        </div>

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label for="image">Фотография учителя</label>

            <input id="image" type="file" class="form-control" name="image" />

            @if ($errors->has('image'))
                <span class="help-block error-block"><strong>{{ $errors->first('image') }}</strong></span>
            @endif
        </div>

        <div class = "form-group required">
            <label>Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <input type="submit" value="Добавить" class = "btn btn-primary">
    </form>
    <br>
@endsection