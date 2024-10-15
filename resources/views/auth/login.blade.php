<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section class="vh-100" style="backgorund-color: #f7f7f7;">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center vh-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong overflow-hidden shadow" style="border-radius: 1rem;">
                        <div class="card-body p-5">
                            <h3 class="mb-5 text-center">Sign in</h3>
                            <form action="/login" method="POST">
                                @csrf
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="form-control border border-1 border-secondary @error('email') is-invalid @enderror" placeholder="Email"
                                        autofocus />
                                    @error('email')
                                        <div class="text-danger small ms-1 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control border border-1 border-secondary @error('password') is-invalid @enderror" placeholder="Password"/>
                                    @error('password')
                                        <div class="text-danger small ms-1 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input class="form-check-input me-2 border border-1 border-secondary"
                                        type="checkbox" value="" id="remember" />
                                    <label class="form-check-label" for="remember"> Remember password </label>
                                </div>

                                <button class="btn btn-primary w-100" type="submit">Login</button>

                                <hr class="my-3">

                                <a href="/oauth/google" class="btn w-100 mb-2 text-white" style="background-color: #dd4b39;"><i class="fab fa-google me-2"></i> Sign in with google</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Successfully",
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
