import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import ArticleTagsInput from './components/ArticleTagsInput'
import FollowButton from './components/FollowButton'

const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    ArticleTagsInput,
    FollowButton,
  }
})

// 画像を選択するinputタグのDOMを取得
document.querySelector('.image-picker input')
  // 画像が選択された時に実行される関数（リスナー）を追加
  // 第一引数は処理を追加するイベントの種類を指定
  // 第二引数は関数(リスナー)を指定します。イベントを検出した時にこの関数が実行される
  // この関数の引数eにはイベントに関する情報が格納されており、e.targetでイベントが発生したDOMを取得できる
  .addEventListener('change', (e) => {
    const input = e.target;
    // FileReaderクラスのインスタンスを作成
    const reader = new FileReader();
    // 画像の読み込みが完了したタイミングでこの関数が実行される
    reader.onload = (e) => {
      // imgタグのsrc属性を更新するために、imgタグのDOMを取得
      // closestメソッドは親方向に向かってDOMを検索
      // inputタグから親方向にimage-pickerクラスのDOMを検索し、そこから更にimgタグのDOMを検索
      // 読み込んだ結果をimgタグのsrcフィールドに代入
      input.closest('.image-picker').querySelector('img').src = e.target.result
    };
    // readAsDataURLメソッドで画像の読み込みを開始
    // 第一引数にFileクラスのオブジェクトを指定
    // inputタグのDOMのfilesフィールドに格納されている、Fileオブジェクトを指定
    reader.readAsDataURL(input.files[0]);
  });