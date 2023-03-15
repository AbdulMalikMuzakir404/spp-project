@extends('layouts.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endpush

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="m-0">Laporan Create</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Laporan Create</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

<div class="card">
    <div class="card-header">
        Create Laporan
    </div>
    <div class="card-header">
        <form action="{{ route('laporanCreate') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Dari Date</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="date" name="dari"
                                class="form-control @error('dari') is-invalid @enderror" placeholder="dari Address"
                                required>
                            @error('dari')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Sampai Date</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="date" name="sampai"
                                class="form-control @error('sampai') is-invalid @enderror" placeholder="sampai Address"
                                required>
                            @error('sampai')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-info">
                            Print
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}")
    @endif

    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}")
    @endif

    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}")
    @endif
</script>
@endpush
