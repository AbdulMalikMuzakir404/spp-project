@extends('layouts.app')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>
                    Create Laporan Berdasarkan Range
                </h5>
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
                                        class="form-control @error('sampai') is-invalid @enderror"
                                        placeholder="sampai Address" required>
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
                                    <i class="fas fa-download"></i>
                                    Print
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>
                    Create Laporan Berdasarkan NISN
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('cetakTransaksiPdf') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mt-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tahun</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select aria-label="Default select example" name="tahun"
                                    class="@error('tahun') is-invalid @enderror form-select"
                                    value="{{ old('tahun') }}" required>
                                    <option selected="selected" value="{{ date('Y') }}">{{ date('Y') }}</option>
                                    @for ($tahun = date('Y'); $tahun >= 2000; $tahun--)
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NISN</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" id="nisn" name="nisn"
                                        class="form-control @error('nisn') is-invalid @enderror" placeholder="NISN"
                                        required>
                                    @error('nisn')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Siswa</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <p class="color-red">*Atas nama</p>
                                    <input type="text" id="nama"
                                        class="form-control" placeholder="Nama Siswa"
                                        required disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-download"></i>
                                    Print
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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

<script>
    $(function(){
      $('#nisn').on('keyup', function(){
        let nisn=$(this).val();
        console.log(nisn);
        $.ajax({
          url:'/get_siswa/'+nisn,
          method:'get',
          success:function(data){
            console.log(data);
            $('#nama').val(data['nama']);
          }
        });
      });
    });
  </script>
@endpush
