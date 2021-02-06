<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
      @if (!empty($article->user->img_name))
        <img src="data:image/png;base64,{{$article->user->img_name}}" class="rounded-circle userProfileImgIcon" style="object-fit: cover; width: 60px; height: 60px;">
      @else
        <i class="fas fa-user-circle fa-3x mr-2"></i>
      @endif
    <div class="ml-3">
      <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
        <div class="font-weight-bold">{{ $article->user->name }}</div>
      </a>
      <div class="font-weight-lighter">{{ $article->created_at->format('Y/m/d H:i') }}</div>
    </div>

  @if( Auth::id() === $article->user_id )
    <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('articles.edit', ['article' => $article]) }}">
              <i class="fas fa-pen mr-1"></i>記事を更新する
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
              <i class="fas fa-trash-alt mr-1"></i>記事を削除する
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->

      <!-- modal -->
      <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $article->title }}を削除します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
  @endif

  </div>
  <div class="card-body pt-0">
    <h3 class="h4 card-title">
      <a class="text-dark" href="{{ route('articles.show', ['article' => $article]) }}">
        {{ $article->title }}
      </a>
    </h3>
    <div class="card-text">
      {{ $article->body }}
    </div>
  </div>
  <div class="card-body pt-0 pb-2 pl-3 ">
    <div class="card-text d-flex justify-content-start">
      <!-- initial-is-liked-byはv-bind:initial-is-liked-byの省略形 -->
      <!-- jsonを使用する事で、結果を値ではなく文字列でVueに渡している -->
      <!-- authorized=承認する ユーザーがログインしている状態のみを許容 -->
      <!-- endpointを新たに定義し、route関数で取得したURLを渡している -->
      <article-like
        :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
        :initial-count-likes='@json($article->count_likes)'
        :authorized='@json(Auth::check())'
        endpoint="{{ route('articles.like', ['article' => $article]) }}"
      >
      </article-like>
      <a href="{{ route('articles.show', ['article' => $article]) }}">
        <i class="fas fa-comment ml-3" style="margin-top:6px;"></i>
      </a>
      <div class="card-text ml-2" style="margin-top:2px;">
        {{ count($article->comments) }}
      </div>
    </div>

  </div>
  @foreach($article->tags as $tag)
  <!-- $loopは、foreachの中で使える変数 -->
  <!-- foreachによる繰り返し処理の最初の1回目だけに適用させる -->
  <!-- これによりタグが付いていない投稿の際の表示を指定している -->
    @if($loop->first)
      <div class="card-body pt-0 pb-4 pl-3">
        <div class="card-text line-height">
    @endif
      <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
        {{ $tag->hashtag }}
      </a>
    @if($loop->last)
        </div>
      </div>
    @endif
  @endforeach
</div>