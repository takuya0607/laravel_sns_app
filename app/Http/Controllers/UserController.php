<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['articles.user', 'articles.likes', 'articles.tags']);

        $articles = $user->articles->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }

    public function edit(string $name)
    {
      $user = User::where('name', $name)->first();

      return view('users.edit', [
        'user' => $user,
      ]);
    }

    public function update(ProfileRequest $request, string $name)
    {
        // findOrFail = userテーブル内に、指定のidがあれば
        $user = User::where('name', $name)->first();

        // if emptyで$request->imageが空であるか確認する。
        // これで画像を差し替えていない場合、元の画像がそのまま選択される
        if (empty($request->img_name) == false) {
          if ($request ->file('img_name')->isValid([])) {
          $user->img_name = $request->img_name->getClientOriginalName();
          $fileName = $request->file('img_name')->getClientOriginalName();
          $imagePath = $request->img_name->storeAs('public/images/', $fileName);
          }
        }
        $user->name = $request->name;
        $user->save();

        return redirect()->route('articles.index');
    }

    public function destroy(User $user, string $name)
    {
      $user = User::where('name', $name)->first();
      $user->delete();
      return redirect('/');
    }
}
