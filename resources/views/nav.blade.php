<nav class="navbar navbar-expand navbar-dark aqua-gradient">

  <a class="navbar-brand" href="/"><i class="fas fa-blog mr-1"></i>Mutter</a>

  <ul class="navbar-nav ml-auto">

    <!-- guest~はユーザーがゲスト状態→ログインしていない状態 -->
    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest

    <!-- auth~はユーザーがログインしている状態 -->
    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth

    @auth
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route('users.show', ['name' => Auth::user()->name]) }}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <div class="dropdown">
          <button class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete" type="button">
            ログアウト
          </button>
          </a>
        </div>
      </div>
    </li>

    <!-- modal -->
      <div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <!-- buttonタグのformと、idの名称を一致させる事で紐付けを行う -->
                <div class="modal-body">
                  本当にログアウトしますか？
                </div>
                <div class="modal-footer justify-content-between">
                  <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <form id="logout-button" method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button form="logout-button" class="btn btn-danger" type="submit">
                  ログアウト
                  </button>
                </form>
          </div>
        </div>
      </div>
    <!-- modal -->

    @endauth

  </ul>

</nav>