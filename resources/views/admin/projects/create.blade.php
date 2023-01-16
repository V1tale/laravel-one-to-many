@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center mt-3">Aggiungi un progetto</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                {{-- @include('partials.errors') --}}
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Nome del progetto</label>
                        <input type="text" id="title" name="title"
                            class="form-control @error('title')
                        is-invalid
                        @enderror"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Immagine</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image')
                            is-invalid
                        @enderror">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-group mb-3">
                            <label for="content">Descrizione</label>
                            <textarea name="content" id="content" rows="10"
                                class="form-control @error('content')
                        is-invalid
                        @enderror">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn btn-dark" type="submit">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection
