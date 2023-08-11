<x-app-layout>
    <x-slot name="header">
        　index
    </x-slot>

    <script>
        function deletePost(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
    
    <body>
        <h1>Blog Name</h1>
        <a class = 'sosobig' href='/posts/create'>create</a>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <p class='body'>{{ $post->body }}</p>
                    {{--<p>writer : {{ $post->user->name }}</p> --}}
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class = 'link' type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                    </form>
                </div>
                
            @endforeach
        </div>
        <div class = 'paginate'>
            {{$posts -> links()}}
        </div>
    </body>
</html>

</x-app-layout>