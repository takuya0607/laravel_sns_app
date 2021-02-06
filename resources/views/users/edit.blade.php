@extends('app')

@section('title', 'プロフィール編集')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('users.update' , ['name' => $user->name]) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <span class="avatar-form image-picker">
                    <input type="file" name="img_name" class="d-none" accept="image/png,image/jpeg,image/gif" id="avatar" />
                    <label for="avatar" class="d-inline-block">
                      @if (!empty($user->img_name))
                          <img src="data:image/png;base64,<?= $user->img_name ?>" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                      @else
                          <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                      @endif
                    </label>
                </span>
                <div class="md-form">
                  <label for="name">ユーザー名</label>
                  <input class="form-control" type="text" id="name" name="name" required value="{{ $user->name }}">
                  <small>英数字3〜16文字</small>
                </div>
                <button class="btn btn-block aqua-gradient mt-2 mb-2" type="submit">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

