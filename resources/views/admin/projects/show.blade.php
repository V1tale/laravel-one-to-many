@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="text-start mt-4">
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <a class="btn btn-primary" href="{{ route('admin.projects.edit', $project->slug) }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        </div>
        <h2 class="text-center">{{ $project->title }}</h2>
        <div class="text-center">
            @if ($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ 'immagine di ' . $project->image }}">
            @else
                <div class="w-50 bg-secondary py-4 text-center d-inline-block">
                    No image yet
                </div>
            @endif
        </div>
        <p class="mt-3">{{ $project->content }}</p>
    </div>
@endsection
