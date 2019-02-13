@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Ваше ФИО</label>

                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{ old('name') }}" required autofocus>
                                <span class="help-block text-primary"><strong>Это обязательное поле.</strong></span>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="email" >Ваш email</label>
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required>
                                <span class="help-block text-primary"><strong>Это обязательное поле.</strong></span>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for='age'>Дата рождения </label>

                            <input id='age' type="date" class="form-control date" name='age'
                                   value="{{old('age')}}" required>
                            <span class="help-block text-primary"><strong>Это обязательное поле.</strong></span>

                            @if ($errors->has('age'))
                                <span class="help-block error-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Пароль<b> (минимальная длина пароля - 6 символов)</b></label>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Повторите введенный пароль</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <input type="checkbox" name="multi_note" value="1" onclick="showMe(this)" style="margin-bottom: 10px">
                        <b> Я модератор или директор</b>
                        <div id="div1" class="form-group" style="display:block; display:none;">
                            <label for="invite">Инвайт-код <b>(оставьте поле пустым, если вы ученик или учитель)</b></label>
                            <input id="invite" type="password" class="form-control" name="invite" value="{{old('invite')}}">
                        </div>

                        <div class="rounded border border-dark" style="padding: 10px; background-color: #ffe35b; margin-top: 10px">
                            На нашем веб-сервисе мы не приветствуем использование ненормативной лексики(в любой ее
                            форме) и оскорблений. Огромная просьба не прибегать к подобным способам выражения сво
                            его мнения. Любая информация, воспринятая администрацией сайта как оскорбление или нен
                            ормативная лексика, будет оперативно удаляться, к нарушителю будут применены соответст
                            вующие санкции (блокировка доступа к сервису). Будьте конструктивны в выражении своего мнения.
                        </div>

                        <input type="checkbox" name="multi_note" value="1" style="margin-top: 10px" required>
                        <b> Я прочитал правила сайта и согласен с ними</b>

                        <div class="form-group" style="margin-top: 20px">
                            <button type="submit" class="btn btn-primary">
                                Зарегистрироваться
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showMe (box) {
        var vis = (box.checked) ? "block" : "none";
        document.getElementById('div1').style.display = vis;
    }
</script>
@endsection
