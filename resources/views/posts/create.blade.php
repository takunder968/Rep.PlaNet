<!DOCTYPE HTML>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
           <div class="title">
               <h2>Title</h2>
               <input type="text" name=post[title] placeholder="タイトル" value={{ old('post.title') }}>
               <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
           </div> 
           <div class="body">
               <h2>Body</h2>
               <textarea name="post[body]" placeholder="本文">{{old('post.body')}}</textarea>
               <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
           </div>
           <!-- 画像アップロードで追加 -->
           <div class="image">
               <input type="file" name="image_path" multiple="multiple">
           </div>
           <!-- ここまで -->
           <input type ="submit" value="store"/>
          
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>