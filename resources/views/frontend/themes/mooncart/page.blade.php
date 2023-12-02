@extends('frontend.themes.mooncart.layout.layout')
@section('title', $page->name)
@section('description', '')
@section('keywords', '')
@section('content')
    <div class="page-content">
        <!-- Blog Large -->
        <section class="content-inner-1 bg-img-fix">
            <div class="container">
                <div class="row justify-content-center">
                    <h1>{{ $page->name }}</h1>
                    <div>
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
