@extends('main')

@section('container')
    <style>
        .comment-container::-webkit-scrollbar {
            display: none;
        }
    </style>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <article class="article">
                            <div class="post-img">
                                <img src="{{ $post->image }}" alt="" class="img-fluid w-100">
                            </div>
                            <h2 class="title">{{ $post->title }}</h2>
                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="/{{ $post->user->username }}">{{ $post->user->username }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="#"><time datetime="2020-01-01">{{ $post->created_at }}</time></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-eye"></i> <a
                                            href="#">{{ $post->views }} Views</a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                {!! $post->desc !!}
                            </div><!-- End post content -->

                            <div class="meta-bottom">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a href="#">Business</a></li>
                                </ul>

                                <i class="bi bi-tags"></i>
                                <ul class="tags">
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">Tips</a></li>
                                    <li><a href="#">Marketing</a></li>
                                </ul>
                            </div><!-- End meta bottom -->
                        </article>
                    </div>
                </section><!-- /Blog Details Section -->

                <!-- Blog Comments Section -->
                <section id="blog-comments" class="blog-comments section">
                    <div class="container">
                        <div class="row mb-3">
                            <form class="col form-group" id="add-comment">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input id="comment-content" name="content" class="form-control px-4 py-2 border border-1"
                                    style="border-radius: 2.5em;" name="content" placeholder="Your Comment*"></input>
                            </form>
                        </div>
                        <h4 class="comments-count ps-1">{{ count($post->comments) }} Comments</h4>
                        <div class="comment-container overflow-auto" style="min-height: 200px; max-height: 500px;">
                            @foreach ($post->comments as $index => $comment)
                                <div id="comment-{{ $index }}" class="comment">
                                    <div class="d-flex">
                                        <div class="comment-img"><img
                                                src="{{ $comment->user->image ?? 'https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=' }}"
                                                alt=""></div>
                                        <div>
                                            <h5><a href="">{{ $comment->user->username }}</a> <a href="#"
                                                    class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                            <time datetime="2020-01-01">{{ $comment->created_at }}</time>
                                            <p>{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-4 sidebar">
                <div class="widgets-container">
                    <div class="blog-author-widget widget-item">
                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center w-100">
                                <img src="{{ $post->user->image ?? 'https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=' }}"
                                    class="rounded-circle flex-shrink-0" width="50px" height="50px" alt="">
                                <div>
                                    <h4>{{ $post->user->username }}</h4>
                                    <div class="social-links">
                                        <a href="https://x.com/#"><i class="bi bi-twitter-x"></i></a>
                                        <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                                        <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                                        <a href="https://instagram.com/#"><i class="biu bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                            <p>
                                {{ $post->user->desc }}
                            </p>
                        </div>
                    </div>
                    <div class="search-widget widget-item">
                        <h3 class="widget-title">Search</h3>
                        <form action="">
                            <input type="text">
                            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="recent-posts-widget widget-item">
                    <h3 class="widget-title">Recent Posts</h3>
                    @foreach ($current_post as $p)
                        <div class="post-item">
                            <img src="{{ $p->image }}" alt="" class="flex-shrink-0 rounded">
                            <div>
                                <h4><a href="/post/{{ $p->id }}">{{ Str::limit($p->title, 50) }}</a></h4>
                                <time datetime="{{ $p->created_at }}">{{ $p->created_at }}</time>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('41ef74a792ecc12db0d7', {
            cluster: 'ap1'
        });

        document.getElementById('add-comment').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log("{{ $post->id }}")
            $.ajax({
                method: 'POST',
                url: `/post/{{ $post->id }}/comment`,
                data: $('#add-comment').serialize(),
                success: function(res) {
                    console.log(res)
                },
                error: function(err) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Error Connection, Please Check Your Interner or WIFI",
                    });
                }
            })
        });

        const channel = pusher.subscribe(`comments`);

        channel.bind('event', function(data) {
            const commentHtml = `<div id="comment-${data.comment.post_id}" class="comment">
                                    <div class="d-flex">
                                        <div class="comment-img"><img
                                                src="${data.user.image ?? "https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o="}"
                                                alt=""></div>
                                        <div>
                                            <h5><a href="">${data.user.username}</a> <a href="#"
                                                    class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                            <time datetime="2020-01-01">${data.comment.created_at}</time>
                                            <p>${data.comment.content}</p>
                                        </div>
                                    </div>
                                </div>`;
            $('.comment-container').prepend(commentHtml);

            $('#comment-content').val('');
            $('.comments-count').text($('.comment-container .comment').length + " Comments");
        });
    </script>
@endsection
