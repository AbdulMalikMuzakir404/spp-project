@extends('layouts.app')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endpush

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Data Bayar</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Bayar</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

    <div class="container text-center">

        <div class="row gutters-sm">

            @foreach ($spp as $dataSpp)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <p>{{ 'Rp.' . $dataSpp->nominal }}</p>
                            <p>{{ $dataSpp->tahun }}</p>
                            <p>{{ $dataSpp->created_at }}</p>
                            <a href="{{ route('dataBayarDetail', $dataSpp->id) }}" class="btn btn-primary">Checkout</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}")
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}")
        @endif
    </script>
@endpush
