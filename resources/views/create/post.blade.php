@extends('main')

@section('container')
    <style>
        .trix-button-row::-webkit-scrollbar {
            display: none;
        }
    </style>
    <section id="create-post">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <div class="card shadow-2-strong overflow-hidden" style="border-radius: 1rem;">
                        <div class="card-body p-5">
                            <form action="/post" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label class="mb-1" for="title">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text"name="title"
                                            class="form-control @error('title') is-invalid @enderror" id="title"
                                            placeholder="Title" value="{{ old('title') }}">
                                        @error('title')
                                            <div class="text-danger small pt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label class="mb-1" for="slug">Slug <span class="text-danger">*</span></label>
                                        <input type="text" name="slug"
                                            class="form-control @error('slug') is-invalid @enderror" id="slug"
                                            placeholder="Slug" value="{{ old('slug') }}">
                                        @error('slug')
                                            <div class="text-danger small pt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label class="mb-1" for="category">Category <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('category_id') is-invalid @enderror"
                                            id="category" name="category_id" placeholder="Category">
                                            <option value="" hidden selected>--Select--</option>
                                            @foreach ($categories as $category)
                                                @if (old('category_id') == $category->id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger small pt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label class="mb-1" for="imagePost">Image <span
                                                class="text-danger">*</span></label>
                                        <img class="mb-2" id="previewImg" src="#" alt="image-preview" style="display: none; max-width:100%;">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            id="imagePost" name="image" accept="image/*" value="{{ old('image') }}" onchange="previewImage()">
                                        @error('image')
                                            <div class="text-danger small pt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-1" for="desc">Description <span
                                            class="text-danger">*</span></label>
                                    <input type="hidden" class="form-control" name="desc" id="desc" value="{{ old('desc') }}">
                                    @error('desc')
                                        <div class="text-danger small pb-1">{{ $message }}</div>
                                    @enderror
                                    <trix-editor class="mt-1 @error('desc') border-danger @enderror" input='desc'
                                        style="min-height: 300px"></trix-editor>
                                </div>
                                <button type="submit" class="btn btn-secondary w-100">Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            title.addEventListener('change', () => {
                fetch('/post/createSlug?title=' + title.value)
                    .then(response => response.json())
                    .then(response => slug.value = response.slug)
            });

            const previewImage = () => {
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
        </script>
    </section>
@endsection
