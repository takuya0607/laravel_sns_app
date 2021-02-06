<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8 mb-3">
          <ul class="list-group">
            @forelse ($comments as $comment)
                <li class="list-group-item">
                    <div class="py-3 w-100 d-flex">
                        @isset($comment->user->img_name)
                          <img src="data:image/png;base64,{{$comment->user->img_name}}" class="rounded-circle userProfileImgIcon" style="object-fit: cover; width: 60px; height: 60px;">
                        @else
                          <i class="fas fa-user-circle fa-3x"></i>
                        @endisset
                        <div class="ml-2 d-flex flex-column">
                            <a href="{{ route('users.show' ,['name' => $comment->user->name]) }}" class="text-dark">{{ $comment->user->name }}</a>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-dark">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                    <div class="py-3">
                        {!! nl2br(e($comment->text)) !!}
                    </div>
                </li>
            @empty
              <p class="mb-0 text-dark" style="margin:auto;">コメントはまだありません。</p>
            @endforelse
            <br>
            @auth
              @if( Auth::id() !== $article->user_id )
                <li class="list-group-item">
                    <div class="py-3">
                        <form method="POST" action="{{ route('comments.store') }}">
                          @csrf
                          <div class="form-group row mb-0">
                              <div class="col-md-12 p-3 w-100 d-flex">
                                @isset($user->img_name)
                                  <img src="data:image/png;base64,{{$user->img_name}}" class="rounded-circle userProfileImgIcon" style="object-fit: cover; width: 60px; height: 60px;">
                                @else
                                  <i class="fas fa-user-circle fa-3x"></i>
                                @endisset
                                  <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $user->name }}</p>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <input type="hidden" name="article_id" value="{{ $article->id }}">
                                  <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-12 text-right">
                                  <p class="mb-4 text-danger">140文字以内</p>
                                  <button type="submit" class="btn btn-primary rounded-pill">
                                      コメントする
                                  </button>
                              </div>
                          </div>
                        </form>
                    </div>
                </li>
              @endif
            @endauth
          </ul>
      </div>
  </div>
</div>
<div class="my-4 d-flex justify-content-center">
  {{ $comments->links() }}
</div>