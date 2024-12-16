# Laravel_test1

<br>
<img src="public/vendor/adminlte/dist/img/logo_01.png" width="240">
<br>

## Environments

### Local (WSL on Windows PC)

- Laravel
- AdminLTE
- MariaDB
- Livewire

### Production (Railway)

- Laravel
- AdminLTE
- MySQL

## Updates

### 20241127

- いろいろやったが、下の最後のコマンドが大事だった。
	- 上2つは`adminlte`と`livewire`が使用しているテンプレートファイルを、上書き改造したい場合にローカルに引っ張ってくるコマンドである。
	- しかし、それらはすでに`config.adinlte.php`の`adminlte.livewire`さえ編集すれば、livewireを有効化できる実装になっていた。
	- `resource/views/vondor/adminlte`と`resource/views/vondor/liveview`だったが、今回は洋なしと判断し、消去した。
- `components/layouts/app.blade.php`が`livewire`のデフォルトレイアウトのようなので、これを生成するためのコマンドである。
	- 以下のコマンドで生成されたものは、adminlteのテンプレートを踏襲していないので、修正したものをcommit.

```bash
php artisan livewire:publish
php artisan adminlte:install --only=main_views
php artisan livewire:layout
```
- sample プログラムは以下のコマンドから生成/編集

```bash
php artisan make:livewire LivewireSamplePage
```

- `route/web.php`にも注意が必要で、以下のようにControllerと同じ呼び出し方ではうまく行かなかった。

```php
// Route::get('/livewire_sample', [LivewireSamplePage::class, 'render'])->name('livewire-sample-page'); // not works
Route::get('/livewire_sample', LivewireSamplePage::class);
```
- 現時点で、`live_mpg`のページネーションのデザインがおかしくなっている。（`auto_mpg`）は大丈夫。
- 理由は不明ながら、関係ないはずのinputボタン（ただし、wire:clickにバインドした変数あり）を押すと、更新された



### 20241216 追記

- `railway up` のデプロイで、クラッシュするようになったので、一旦サービス削除
- github経由で改めてデプロイ、その際は`.env`ファイルの中身をコピー、ドメインを生成（結果的に前と一緒）、ポートを8080に設定した。
- それでもまだ`railway run php artisan migrate`がうまくいかない
- また、`railway run php artisan cache:clear`もうまくいかない
- 結果的に、`laraveltest1`の環境変数のうち、以下をパブリックのアドレスとポートに設定すると、うまくできた。
	- DB_HOST
	- DB_PORT
- migrateのあとは、`mysql.railway.internal`と`3306`に戻した。webuiからのデータベース操作は、内部アドレスでうまくいく見たい。




