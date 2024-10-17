@extends('main')

@section('container')
    <section class="container trending-category" style="min-height: 80vh;">
        <h3 class="text-center fw-bold mb-md-5 mb-4">My Article</h3>
        <div class="d-flex justify-content-center gap-4" style="flex-wrap: wrap;">
            @foreach ($posts as $post)
            <div class="post-entry border-custom col-md-3 col-5" style="min-height: 200px;">
                <a href="/profile/post/{{ $post->id }}"><img src="{{ $post->image }}" alt=""
                        class="img-fluid mb"></a>
                <div class="post-meta"><span class="date">{{ $post->category->name }}</span>
                    <span class="mx-1">•</span>
                    <span>{{ $post->created_at }}</span>
                </div>
                <h2 class="mb-2"><a href="/profile/post/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <p class="small text-secondary">{{ $post->views ?? 0 }} views</p>
            </div>
            @endforeach
        </div>
    </section>
@endsection