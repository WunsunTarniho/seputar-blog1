@extends('main')

@section('container')
    <style>
        .comment-container::-webkit-scrollbar {
            display: none;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <article class="position-relative">
                            <form action="/post/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="category_id"
                                    value="{{ old('category_id', $post->category_id) }}">
                                @if (!request()->route()->getName())
                                    <div class="position-absolute d-flex align-items-center gap-3 p-2"
                                        style="top: 0; right: 5px;">
                                        <button type="button" class="btn btn-warning px-3 py-1 current-form btn-edit">
                                            <i class="bi bi-pencil fs-5"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger px-3 py-1 current-form btn-delete">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                        <button type="submit" class="btn btn-primary px-3 py-1 new-form btn-save d-none">
                                            <i class="bi bi-floppy fs-5"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger new-form cancel-edit d-none">
                                            Cancel
                                        </button>
                                    </div>
                                @endif
                                <div class="post-img current-image">
                                    <img src="{{ $post->image }}" alt="" class="img-fluid w-100">
                                </div>
                                <div class="new-form post-img pb-2 form-input d-none">
                                    <img id="previewImg" src="#" alt="image-preview"
                                        style="display: none; max-width:100%;">
                                    <input type="file" style="width: 90%;"
                                        class="form-control mt-4 ms-4 @error('image') is-invalid @enderror" id="imagePost"
                                        name="image" accept="image/*" value="{{ old('image', $post->image) }}"
                                        onchange="previewImage()">
                                    @error('image')
                                        <div class="text-danger small pt-1 ms-4">{{ $message }}</div>
                                    @enderror
                                </div>
                                <h2 class="title current-form">{{ $post->title }}</h2>
                                <div class="new-form d-none">
                                    <input type="text" name="title"
                                        class="form-control title bg-light px-3 @error('title') is-invalid @enderror"
                                        id="title" placeholder="Title" value="{{ old('title', $post->title) }}">
                                    @error('title')
                                        <div class="text-danger small pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-none new-form">
                                    <label for="slug mt-3 ps-1">Slug</label>
                                    <input type="text" name="slug"
                                        class="form-control bg-light mt-1 px-3 @error('slug') is-invalid @enderror"
                                        id="slug" placeholder="Slug" value="{{ old('slug', $post->slug) }}">
                                    @error('slug')
                                        <div class="text-danger small pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="meta-top">
                                    <ul class="d-flex gap-3 align-items-center">
                                        <li class="d-flex align-items-center ps-0"><i class="bi bi-person"></i> <a
                                                href="/{{ $post->user->username }}">{{ $post->user->username }}</a></li>
                                        <li class="d-flex align-items-center ps-0"><i class="bi bi-clock"></i> <a
                                                href="#"><time
                                                    datetime="2020-01-01">{{ $post->created_at }}</time></a>
                                        </li>
                                        <li class="d-flex align-items-center ps-0"><i class="bi bi-eye"></i> <a
                                                href="#">{{ $post->views }} Views</a></li>
                                    </ul>
                                </div>
                                <div class="content mb-3 current-form">
                                    {!! $post->desc !!}
                                </div>

                                <div class="d-none new-form mt-3">
                                    <input type="hidden" class="form-control" name="desc" id="desc"
                                        value="{{ old('desc', $post->desc) }}">
                                    @error('desc')
                                        <div class="text-danger small pb-1">{{ $message }}</div>
                                    @enderror
                                    <trix-editor class="mt-1 mb-3 content @error('desc') border-danger @enderror"
                                        input='desc' style="min-height: 300px;"></trix-editor>
                                </div>
                            </form>
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
                            </div>
                        </article>
                    </div>
                </section>

                <section id="blog-comments" class="blog-comments section">
                    <div class="container">
                        <div class="row mb-3">
                            <form class="col form-group" id="add-comment">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input id="comment-content" name="content" class="form-control px-4 py-2 border border-1"
                                    style="border-radius: 2.5em;" name="content" placeholder="Your Comment*" autocomplete="false"></input>
                            </form>
                        </div>
                        <h4 class="comments-count ps-2 fs-5">{{ count($post->comments) }} Comments</h4>
                        <div class="comment-container overflow-auto" style="min-height: 200px; max-height: 500px;">
                            @foreach ($post->comments as $index => $comment)
                                <div id="comment-{{ $index }}" class="comment ps-2">
                                    <div class="d-flex">
                                        <div class="comment-img"><img
                                                src="{{ $comment->user->image ?? '/assets/img/guest-image.webp' }}"
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
                                <img src="{{ $post->user->image ?? '/assets/img/guest-image.webp' }}"
                                    class="rounded-circle flex-shrink-0" width="50px" height="50px" alt="">
                                <div>
                                    <h4>{{ $post->user->username }}</h4>
                                    <div class="social-links">
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
                            <img src="{{ $p->image }}" alt="" class="flex-shrink-0 rounded h-auto">
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
        const previewImage = () => {
            $('.current-image').hide();
            $('#previewImage').show()
            const previewImg = document.getElementById('previewImg');
            const image = document.getElementById('imagePost');
            previewImg.style.display = 'block';
            previewImg.style.border = '1px solid black';
            const reader = new FileReader();
            reader.readAsDataURL(image.files[0]);

            reader.onload = (readerEvent) => {
                previewImg.src = readerEvent.target.result;
            }
        }

        $('.btn-edit').on('click', function() {
            $('.current-form').addClass('d-none')
            $('.new-form').removeClass('d-none')
        })

        $('.cancel-edit').on('click', function() {
            $('.current-form').removeClass('d-none')
            $('.new-form').addClass('d-none')
        })

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        document.getElementById('add-comment').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!"{{ Auth::check() }}") {
                window.location.href = '/login';
                return;
            }

            $.ajax({
                method: 'POST',
                url: `/post/{{ $post->id }}/comment`,
                data: $('#add-comment').serialize(),
                success: function(res) {
                    console.log(res)
                },
                error: function(err) {
                    console.log(err)
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
            const commentHtml = `<div id="comment-${data.comment.post_id}" class="comment ps-2">
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

        let viewTimeout;

        window.addEventListener('DOMContentLoaded', function() {
            startTimeout();
        });

        window.addEventListener('beforeunload', function() {
            clearTimeout(viewTimeout);
        })

        function startTimeout() {
            clearTimeout(viewTimeout);

            viewTimeout = setTimeout(() => {
                $.ajax({
                    method: 'POST',
                    url: '/addview',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: "{{ $post->id }}",
                    },
                    success: function(res) {
                        console.log('View recorded:', res);
                    },
                    error: function(err) {
                        console.log('Error:', err);
                    }
                });
            }, 15000);
        }

        $('.btn-delete').on('click', function() {
            const swalWithBootstrapButtons = Swal.mixin();

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "DELETE",
                        url: '/post/{{ $post->id }}',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: "{{ $post->id }}",
                        },
                        success: function(res) {
                            swalWithBootstrapButtons.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then(result => {
                                window.location.href = "/post";
                            });
                        },
                        error: function(err) {
                            swalWithBootstrapButtons.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something wrong! Try again!",
                            })
                        }
                    })
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your canceled delete article.",
                        icon: "error"
                    });
                }
            });
        })
    </script>
@endsection
