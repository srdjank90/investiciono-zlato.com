@extends('backend.layout.backend')
@section('content')
    <!-- Breadcrumbs -->
    <div class="sk-breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.products.index') }}">{{ __('Products') }}</a></li>
                <li class="breadcrumb-item active" aria-current="posts">{{ __('Exports') }}</li>
            </ol>
        </nav>
    </div>
    <!-- Page Content -->
    <div class="row">
        <div class="sk-page-actions col-md-12">
            <div class="sk-page-actions-left">
                <a class="btn btn-primary" href="{{ route('backend.products.index') }}"><i
                        class="bi bi-arrow-left-circle"></i> {{ __('Back') }}</a>
            </div>
            <div class="sk-page-actions-right">

            </div>
        </div>
        <div class="col-md-12">
            <table>
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exports as $file)
                        <tr>
                            <td>{{ basename($file) }}</td>
                            <td><a
                                    href="{{ route('backend.files.prices.exports.download', ['file' => basename($file)]) }}">Download</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
