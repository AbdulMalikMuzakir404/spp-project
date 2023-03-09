<!doctype html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Laporan pembayaran SPP | SMKN 1 KATAPANG</title>

        <style>
            .page-break {
                page-break-after: always;
            }

            .text-center {
                text-align: center;
            }

            .text-header {
                font-size: 1.1rem;
            }

            .size2 {
                font-size: 15px;
            }

            .border-bottom {
                border-bottom: 1px black solid;
            }

            .border {
                border: 2px block solid;
            }

            .border-top {
                border-top: 1px black solid;
            }

            .float-right {
                float: right;
            }

            .mt-4 {
                margin-top: 4px;
            }

            .mx-1 {
                margin: 1rem 0 1rem 0;
            }

            .mr-1 {
                margin-right: 1rem;
            }

            .mt-1 {
                margin-top: 1rem;
            }

            ml-2 {
                margin-left: 2rem;
            }

            .ml-min-5 {
                margin-left: -5px;
            }

            .text-uppercase {
                font: uppercase;
            }

            .d1 {
                font-size: 2rem;
            }

            .img {
                position: absolute;
                width: 150px;
                margin-left: -400px;
            }

            .link {
                font-style: underline;
            }

            .text-desc {
                font-size: 14px;
            }

            .text-bold {
                font-style: bold;
            }

            .underline {
                text-decoration: underline;
            }

            table {
                font-family: Arial, Helvetica, sans-serif;
                color: #666;
                text-shadow: 1px 1px 0px #fff;
                background: #eaebec;
                border: #ccc 1px solid;
            }

            table th {
                padding: 10px 15px;
                border-left: 1px solid #e0e0e0;
                border-bottom: 1px solid #e0e0e0;
                background: #ededed;
            }

            table tr {
                text-align: center;
                padding-left: 20px;
            }

            table td {
                padding: 10px 15px;
                border-top: 1px solid #ffffff;
                border-bottom: 1px solid #e0e0e0;
                border-left: 1px solid #e0e0e0;
                background: #fafafa;
                background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
                background: -moz-linear-gradient(top, #fbfbfb, #fafafa);
            }

            .table-center {
                margin-left: auto;
                margin-right: auto;
            }

            .mb-1 {
                margin-bottom: 1rem;
            }
        </style>

    </head>

    <body>

        <!-- header -->
        <div class="text-center">
            {{-- <img src="{{ asset('storage/profile/' . Auth::user()->photo) }}" class="img" alt="logo.png" width="90"> --}}
            <div style="margin-left:6rem;">
                <span class="text-header text-bold text-danger">
                    PEMERINTAH DAERAH PROVINSI JAWA BARAT <br> DINAS PENDIDIKAN <br>
                    <span class="size2">CABANG DINAS PENDIDIKAN WILAYAH IX</span> <br>
                    SEKOLAH MENENGAH KEJURUAN NEGERI 1 KATAPANG <br>
                </span>
                <span class="text-desc">Jalan Sekolah Nomor 20 Telepon (0233) 319238<br>FAX (0233) 319238 Website <span
                        class="underline">www.smkn1katapang-bdg.co.id</span> - Email <span
                        class="underline">smkn1katapang@gmail.com</span> <br> Desa Ceuri Kec. Katapang Kab. Bandung
                    45463 <br> </span>
            </div>
        </div>
        <div>
            <!-- /header -->

            <hr class="border">

            <!-- content -->

            <div class="size2 text-center mb-1">LAPORAN PEMBAYARAN SPP</div>

            <table style="font-size: 7px;" class="table-center mb-1">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama Pengelola</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Bulan Bayar</th>
                            <th scope="col">Tahun Bayar</th>
                            <th scope="col">Jumah Bayar</th>
                            <th scope="col">Data SPP</th>
                            <th scope="col">Tunggakan Perbulan</th>
                            <th scope="col">Created</th>
                            <th scope="col">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($transaksi as $key => $dataTransaksi)
                    @php
                        $no++;
                    @endphp
                        <tr>
                            <th scope="row">{{ $no }}</th>
                            <td>{{ $dataTransaksi->nisn }}</td>
                            <td>{{ $dataTransaksi->nama_pengelola }}</td>
                            <td>{{ $dataTransaksi->nama_siswa }}</td>
                            <td>{{ $dataTransaksi->tgl_dibayar }}</td>
                            <td>{{ $dataTransaksi->bln_dibayar }}</td>
                            <td>{{ $dataTransaksi->thn_dibayar }}</td>
                            <td>{{ $dataTransaksi->jumlah_bayar }}</td>
                            <td>{{ $dataTransaksi->tahun . " - Rp." . $dataTransaksi->nominal }}</td>
                            <td>{{ "Rp." . $dataTransaksi->nominal - $dataTransaksi->jumlah_bayar }}</td>
                            <td>{{ $dataTransaksi->created_at }}</td>
                            @if ($dataTransaksi->status_pembayaran == 1)
                                <td>
                                    <button disabled class="btn-sm btn-primary"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Lunas</button>
                                </td>
                            @elseif ($dataTransaksi->status_pembayaran == 0)
                                <td>
                                    <button disabled class="btn-sm btn-warning"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Belum Lunas</button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /content -->

            <!-- footer -->
            <div>
                <p style="font-size: 13px;">Pembuat : {{ auth()->user()->name }}</p>
                <p style="font-size: 13px;">Date : {{ date('Y-m-d') }}</p>
                <p style="font-size: 13px;">Sisa tunggakan Rp.{{ $sisa_tunggakan }}</p>
            </div>
            <!-- /footer -->
    </body>

    </html>
