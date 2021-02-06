  @extends('app')

@section('title', 'ログイン')

@section('content')
  <br>
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <h1 class="text-center"><i class="fas fa-blog"></i><a class="text-dark" href="/"></a></h1>
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">ログイン</h2>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="md-form">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>

                <input type="hidden" name="remember" id="remember" value="on">

                <br>
                <div class="text-left">
                  <a href="{{ route('password.request') }}" class="card-text">パスワードを忘れた方</a>
                </div>

                <button class="btn btn-block aqua-gradient mt-3 mb-2" type="submit">ログイン</button>
                <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-block btn-danger mt-1">
                  <i class="fab fa-google mr-1"></i>Googleでログイン
                </a>
              </form>
                <a href="{{ route('register') }}" class="btn btn-block blue-gradient btn-danger mt-3">ユーザー登録はこちら</a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection