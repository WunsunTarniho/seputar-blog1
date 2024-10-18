@extends('main')

@section('container')
    <section id="slider" class="slider section dark-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "centeredSlides": true,
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    },
                    "navigation": {
                        "nextEl": ".swiper-button-next",
                        "prevEl": ".swiper-button-prev"
                    }
                }
            </script>
                <div class="swiper-wrapper">
                    @foreach ($trendingPost->take(4) as $post)
                        <div class="swiper-slide" style="background-image: url('{{ $post->image }}'); background-position: center;">
                            <div class="content">
                                <h2 class="mb-2"><a href="/post/{{ $post->id }}">{{ $post->title }}</a></h2>
                                <p>{!! Str::limit(strip_tags(str_replace('&nbsp;', '', $post->desc), '<figcaption>'), 250) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <section id="trending-category" class="trending-category section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="container" data-aos="fade-up">
                <div class="row g-5">
                    @if (count($trendingPost))
                        <div class="col-lg-4">
                            <div class="post-entry lg">
                                <a href="/post/{{ $trendingPost[0]->id }}"><img src="{{ $trendingPost[0]->image }}"
                                        alt="" class="img-fluid w-100"></a>
                                <div class="post-meta">
                                    <span class="date">{{ $trendingPost[0]->category->name }}</span>
                                    <span class="mx-1">•</span>
                                    <span>{{ $trendingPost[0]->created_at }}</span>
                                </div>
                                <h3 style="text-align: justify"><a
                                        href="/post/{{ $trendingPost[0]->id }}">{{ Str::limit($trendingPost[0]->title, 50) }}</a>
                                </h3>
                                <p class="mb-3 d-block" style="text-align: justify">
                                    {!! Str::limit(strip_tags(str_replace('&nbsp;', '', $trendingPost[0]->desc), '<figcaption>'), 250) !!}
                                </p>
                                <p class="small text-secondary">{{ $trendingPost[0]->views ?? 0 }} views</p>
                                <div class="d-flex align-items-center author">
                                    <div class="photo"><img
                                            src="{{ $trendingPost[0]->user->image ?? '/assets/img/guest-image.webp' }}"
                                            alt="" class="img-fluid" width="50px" height="50px">
                                    </div>
                                    <div class="name">
                                        <h3 class="m-0 p-0">{{ $trendingPost[0]->user->username }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-8">
                        <div class="row g-3">
                            <div class="col-lg-4 border-start custom-border">
                                @foreach ($trendingPost->skip(1)->take(2) as $post)
                                    <div class="post-entry" style="min-height: 200px;">
                                        <a href="/post/{{ $post->id }}"><img class="w-100" src="{{ $post->image }}" alt=""
                                                class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">{{ $post->category->name }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $post->created_at }}</span>
                                        </div>
                                        <h2 class="mb-2"><a href="/post/{{ $post->id }}">{{ $post->title }}</a>
                                        </h2>
                                        <p class="small text-secondary">{{ $post->views ?? 0 }} views</p>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-lg-4 border-start custom-border">
                                @foreach ($trendingPost->skip(3) as $post)
                                    <div class="post-entry" style="min-height: 200px;">
                                        <a href="/post/{{ $post->id }}"><img class="w-100" src="{{ $post->image }}" alt=""
                                                class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">{{ $post->category->name }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $post->created_at }}</span>
                                        </div>
                                        <h2 class="mb-2"><a href="/post/{{ $post->id }}">{{ $post->title }}</a>
                                        </h2>
                                        <p class="small text-secondary">{{ $post->views ?? 0 }} views</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-lg-4">
                                <div class="trending">
                                    <ul class="trending-post">
                                        <li>
                                            @auth
                                                <a href="/profile"
                                                    class="border border-0 d-flex align-items-center justify-content-start gap-2">
                                                    <img src="{{ auth()->user()->image ?? '/assets/img/guest-image.webp' }}"
                                                        width="50px" height="50px" class="me-2 rounded-circle" />
                                                    <span class="text-wrap">{{ auth()->user()->username }}</span>
                                                </a>
                                            @else
                                                <a href="/login"
                                                    class="border border-0 d-flex align-items-center justify-content-start">
                                                    <img src='/assets/img/guest-image.webp' width="50px" height="50px"
                                                        class="me-2 rouded-circle" />
                                                    <span>Guest</span>
                                                </a>
                                            @endauth
                                        </li>
                                        <li class="px-2 pb-2">
                                            <form action="/">
                                                <input type="text" id="search" class="form-control" name="search"
                                                    placeholder="Search..." autocomplete="false" />
                                            </form>
                                        </li>
                                        <li>
                                            <a href="/post/create" class="py-1 d-flex align-items-center border border-0">
                                                <i class="bi bi-plus-square fs-4 me-2"></i>
                                                <span>Create New Post</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/favorite" class="py-1 d-flex align-items-center pb-3">
                                                <i class="bi bi-bookmark fs-4 me-2"></i>
                                                <span>Favorite</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($categories as $index => $category)
        @if ($index % 2 == 0)
            <section id="{{ Str::lower($category->name) }}-category"
                class="{{ $category->name }}-category section category">
                @if (count($category->posts))
                    <div class="container section-title" data-aos="fade-up">
                        <div class="section-title-container d-flex align-items-center justify-content-between">
                            <h2>{{ $category->name }}</h2>
                            <p><a href="/category/{{ $category->id }}">See All {{ $category->name }}</a></p>
                        </div>
                    </div>
                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                        <div class="row g-5">
                            <div class="col-lg-4">
                                <div class="post-list lg">
                                    <a href="/post/{{ $category->posts[0]->id }}"><img
                                            src="{{ $category->posts[0]->image }}" alt="" class="img-fluid w-100"></a>
                                    <div class="post-meta">
                                        <span class="date">{{ $category->name }}</span>
                                        <span class="mx-1">•</span>
                                        <span>{{ $category->posts[0]->created_at }}</span>
                                    </div>
                                    <h3 style="text-align: justify"><a
                                            href="/post/{{ $category->posts[0]->id }}">{{ $category->posts[0]->title }}</a>
                                    </h3>
                                    <p class="mb-3 d-block" style="text-align: justify">
                                        {!! Str::limit(strip_tags(str_replace('&nbsp;', '', $category->posts[0]->desc), '<figcaption>'), 250) !!}
                                    </p>
                                    <p class="small text-secondary">{{ $category->posts[0]->views ?? 0 }} views</p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img
                                                src="{{ $category->posts[0]->user->image ?? '/assets/img/guest-image.webp' }}"
                                                alt="" class="img-fluid" width="50px" height="50px">
                                        </div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">{{ $category->posts[0]->user->username }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row g-5">
                                    <div class="col-lg-4 border-start custom-border">
                                        @foreach ($category->posts->skip(1)->take(3) as $post)
                                            <div class="post-list">
                                                <a href="/post/{{ $post->id }}"><img class="w-100" src="{{ $post->image }}"
                                                        alt="" class="img-fluid"></a>
                                                <div class="post-meta"><span class="date">{{ $category->name }}</span>
                                                    <span class="mx-1">•</span> <span>{{ $post->created_at }}</span>
                                                </div>
                                                <h2 class="mb-2"><a
                                                        href="/post/{{ $post->id }}">{{ $post->title }}</a></h2>
                                                <p class="small text-secondary">{{ $post->views ?? 0 }} views</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-lg-4 border-start custom-border">
                                        @foreach ($category->posts->skip(4)->take(3) as $post)
                                            <div class="post-list">
                                                <a href="/post/{{ $post->id }}"><img class="w-100" src="{{ $post->image }}"
                                                        alt="" class="img-fluid"></a>
                                                <div class="post-meta"><span class="date">{{ $category->name }}</span>
                                                    <span class="mx-1">•</span> <span>{{ $post->created_at }}</span>
                                                </div>
                                                <h2 class="mb-2"><a
                                                        href="/post/{{ $post->id }}">{{ $post->title }}</a></h2>
                                                <p class="small text-secondary">{{ $post->views ?? 0 }} views</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-lg-4">
                                        @foreach ($category->posts->skip(7)->take(5) as $post)
                                            <div class="post-list border-bottom">
                                                <div class="post-meta"><span class="date">{{ $category->name }}</span>
                                                    <span class="mx-1">•</span> <span>{{ $post->created_at }}</span>
                                                </div>
                                                <h2 class="mb-2"><a href="blog-details.html">{{ $post->title }}</a>
                                                </h2>
                                                <div class="d-flex gap-3 mb-2 align-items-center">
                                                    <span class="author">{{ $post->user->username }}</span>
                                                    <span class="small text-secondary">{{ $post->views ?? 0 }}
                                                        views</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        @else
            <section id="{{ Str::lower($category->name) }}-category"
                class="{{ $category->name }}-category section category">
                @if (count($category->posts))
                    <div class="container section-title" data-aos="fade-up">
                        <div class="section-title-container d-flex align-items-center justify-content-between">
                            <h2>{{ $category->name }}</h2>
                            <p><a href="/category/{{ $category->id }}">See All {{ $category->name }}</a></p>
                        </div>
                    </div>
                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                        <div class="row g-5">
                            <div class="col-lg-8">
                                <div class="col-lg-4">
                                    @foreach ($category->posts->skip(7)->take(5) as $post)
                                        <div class="post-list border-bottom">
                                            <div class="post-meta"><span class="date">{{ $category->name }}</span>
                                                <span class="mx-1">•</span> <span>{{ $post->created_at }}</span>
                                            </div>
                                            <h2 class="mb-2"><a href="blog-details.html">{{ $post->title }}</a>
                                            </h2>
                                            <div class="d-flex gap-3 mb-2 align-items-center">
                                                <span class="author">{{ $post->user->username }}</span>
                                                <span class="small text-secondary">{{ $post->views ?? 0 }}
                                                    views</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row g-5">
                                    <div class="col-lg-4 border-start custom-border">
                                        @foreach ($category->posts->skip(1)->take(3) as $post)
                                            <div class="post-list">
                                                <a href="/post/{{ $post->id }}"><img class="w-100" src="{{ $post->image }}"
                                                        alt="" class="img-fluid"></a>
                                                <div class="post-meta"><span class="date">{{ $category->name }}</span>
                                                    <span class="mx-1">•</span> <span>{{ $post->created_at }}</span>
                                                </div>
                                                <h2 class="mb-2"><a
                                                        href="/post/{{ $post->id }}">{{ $post->title }}</a></h2>
                                                <p class="small text-secondary">{{ $post->views ?? 0 }} views</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-lg-4 border-start custom-border">
                                        @foreach ($category->posts->skip(4)->take(3) as $post)
                                            <div class="post-list">
                                                <a href="/post/{{ $post->id }}"><img class="w-100" src="{{ $post->image }}"
                                                        alt="" class="img-fluid"></a>
                                                <div class="post-meta"><span class="date">{{ $category->name }}</span>
                                                    <span class="mx-1">•</span> <span>{{ $post->created_at }}</span>
                                                </div>
                                                <h2 class="mb-2"><a
                                                        href="/post/{{ $post->id }}">{{ $post->title }}</a></h2>
                                                <p class="small text-secondary">{{ $post->views ?? 0 }} views</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="post-list lg">
                                    <a href="/post/{{ $category->posts[0]->id }}"><img
                                            src="{{ $category->posts[0]->image }}" alt="" class="img-fluid"></a>
                                    <div class="post-meta">
                                        <span class="date">{{ $category->name }}</span>
                                        <span class="mx-1">•</span>
                                        <span>{{ $category->posts[0]->created_at }}</span>
                                    </div>
                                    <h3 style="text-align: justify"><a
                                            href="/post/{{ $category->posts[0]->id }}">{{ $category->posts[0]->title }}</a>
                                    </h3>
                                    <p class="mb-3 d-block" style="text-align: justify">
                                        {!! Str::limit(strip_tags(str_replace('&nbsp;', '', $category->posts[0]->desc), '<figcaption>'), 250) !!}
                                    </p>
                                    <p class="small text-secondary">{{ $category->posts[0]->views ?? 0 }} views</p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img src="{{ $category->posts[0]->user->image }}"
                                                alt="" class="img-fluid" width="50px" height="50px">
                                        </div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">{{ $category->posts[0]->user->username }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        @endif
    @endforeach
@endsection
