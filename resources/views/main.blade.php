<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="/assets/css/main.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<style>
    .notification.read {
        background-color: #ffffff;
    }

    .notification.unread {
        background-color: #f0f0f0;
    }

    .attachment__caption {
        display: none !important;
    }
</style>

<body class="index-page" style="background-color: #f7f7f7;">

    @include('components.navbar')
    <main class="main">
        @yield('container')
    </main>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="notificationRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="notificationRightLabel">Notification</h5>
            <button type="button" class="btn-close text-reset px-3" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body px-0 py-0">
            @foreach ($notifications as $index => $notification)
                <div id="notification-{{ $index }}"
                    class="notification ps-3 pe-4 py-2 {{ count($notification->notificationReads) ? 'read' : 'unread' }}">
                    <div class="d-flex align-items-center gap-4">
                        <div class="notification-img overflow-hidden p-1" style="width: 60px; height: 60px;">
                            <img src="{{ $notification->recipient_id ? $notification->causer->image ?? '/assets/img/guest-image.webp' : '/assets/img/mail-icon.png' }}"
                                alt="" style="width: 100%;">
                        </div>
                        <div>
                            <p class="mb-0" style="font-size: .9em;">{{ $notification->content }}</p>
                            <time datetime="2020-01-01" style="font-size: .8em;">{{ $notification->created_at }}</time>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if (!request()->route()->getName())
        <footer id="footer" class="footer dark-background">
            <div class="container footer-top">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span class="sitename">Seputar Blog</span>
                        </a>
                        <div class="footer-contact pt-3">
                            <p>Perumahan Kintamani Blok C No. 09</p>
                            <p>Batam, Kepulauan Riau</p>
                            <p class="mt-3"><strong>Phone:</strong> <span>+62 812 8538 8658</span></p>
                            <p><strong>Email:</strong> <span>wunsun58@gmail.com</span></p>
                        </div>
                        <div class="social-links d-flex mt-4">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="https://instagram.com/wunsun_code"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    {{-- <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Terms of service</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">Web Development</a></li>
                            <li><a href="#">Product Management</a></li>
                            <li><a href="#">Marketing</a></li>
                            <li><a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Hic solutasetp</h4>
                        <ul>
                            <li><a href="#">Molestiae accusamus iure</a></li>
                            <li><a href="#">Excepturi dignissimos</a></li>
                            <li><a href="#">Suscipit distinctio</a></li>
                            <li><a href="#">Dilecta</a></li>
                            <li><a href="#">Sit quas consectetur</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Nobis illum</h4>
                        <ul>
                            <li><a href="#">Ipsam</a></li>
                            <li><a href="#">Laudantium dolorum</a></li>
                            <li><a href="#">Dinera</a></li>
                            <li><a href="#">Trodelas</a></li>
                            <li><a href="#">Flexo</a></li>
                        </ul>
                    </div> --}}

                </div>
            </div>

            <div class="container copyright text-center mt-4">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">Seputar Blog</strong> <span>All Rights
                        Reserved</span>
                </p>
            </div>
        </footer>
    @endif

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    {{-- Pop Up --}}
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Sucesss",
                text: "{{ session('success') }}",
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ session('error') }}",
            });
        </script>
    @endif

    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: ''{{ env('PUSHER_APP_CLUSTER') }}'',
            channelAuthorization: {
                endpoint: `/broadcasting/auth`,
                headers: {
                    "Access-Control-Allow-Origin": "*"
                }
            }
        });

        const channelGlobal = pusher.subscribe(`notification`);

        function addNotification(data) {
            const notificationHTML = `<div id="notification-${data.notification.id}" class="notification ps-3 pe-4 py-2 unread">
                    <div class="d-flex align-items-center gap-4">
                        <div class="notification-img overflow-hidden p-1" style="width: 60px; height: 60px;"><img
                                src="${data.notification.recipient_id ? (data.causer.image ?? '/assets/img/guest-image.webp') : '/assets/img/mail-icon.png'}"
                                alt="" style="width: 100%;"></div>
                        <div>
                            <p class="mb-0" style="font-size: .9em;">${data.notification.content}</p>
                            <time datetime="2020-01-01" style="font-size: .8em;">${data.notification.created_at}</time>
                        </div>
                    </div>
                </div>`;

            $('#notificationRight .offcanvas-body').prepend(notificationHTML);
            $('.notification-read').each(function() {
                console.log($(this))
                let totalNotificationRead = $(this).text();
                result = totalNotificationRead ? parseInt(totalNotificationRead) : 0;
                $(this).text(result + 1);
            })
        }

        channelGlobal.bind('event', addNotification);

        const user_id = "{{ auth()->id() }}";
        const channelPrivate = pusher.subscribe(`notification.${user_id}`);

        channelPrivate.bind('event', addNotification);

        $('#notificationRight .offcanvas-header .text-reset').click(function() {
            $.ajax({
                method: 'POST',
                url: '/notificationRead',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(res) {
                    $('#notificationRight .offcanvas-body .notification').each(function() {
                        $(this).removeClass('unread');
                        $(this).addClass('read');
                        $('.notification-read').text('');
                    })

                    console.log(res)
                },
                error: function(err) {
                    console.log(err)
                }
            });

        })
    </script>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>
    <script src="/assets/vendor/aos/aos.js"></script>
    <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="/assets/js/main.js"></script>

</body>

</html>
