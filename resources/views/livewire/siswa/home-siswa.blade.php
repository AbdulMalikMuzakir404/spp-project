<div class="container">
    <div class="main-body">

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">

                            @if (Auth::user()->photo == null)
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                    class="rounded-circle" width="150">
                            @else
                                <img src="{{ asset('storage/profile/' . Auth::user()->photo) }}" alt="img"
                                    class="rounded-circle" height="150px" width="150" id="myImg">
                            @endif

                            <div class="mt-3">
                                <h4>{{ $data->name }}</h4>
                                <p class="text-secondary mb-1">{{ $data->alamat }}
                                <p class="text-muted font-size-sm">{{ $data->level }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Tahun</th>
                                  <th scope="col">Nominal</th>
                                  <th scope="col">Created</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php
                                $arry = [];
                                    $no = 0;
                                @endphp
                                @foreach ($data_spp as $key => $dataSpp)
                                <tr>
                                  <th scope="row">{{ $key += $data_spp->firstItem() }}</th>
                                  <td>{{ $dataSpp->tahun }}</td>
                                  <td>{{ $dataSpp->nominal }}</td>
                                  <td>{{ $dataSpp->created_at }}</td>
                                </tr>
                                <div class="mt-2">
                                    @php
                                        $arr = array_push($arry, $dataSpp->nominal);
                                    @endphp
                                </div>
                                @endforeach
                              </tbody>
                        </table>
                        <div class="mt-2">
                            {{-- {{ dd($arr) }} --}}
                            <p>{{ count($arry) >= 12 ? 'Total ' : '' }}Nominal SPP Tahun {{ date('Y') }} : {{ array_sum($arry) }}</p>
                        </div>
                        <div class="mt-2">
                            {{ $data_spp->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body overflow-scroll">
                        <div class="card-head">
                            <select wire:model="tahun" class="form-select w-auto">
                                <option selected="selected" disabled>Tahun</option>
                                @for ($tahun = date('Y'); $tahun >= 2000; $tahun--)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endfor
                            </select>
                        </div>
                        <table class="table table-striped table-hover">
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
                                    <th scope="col">Status Pembayaran</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Updated</th>
                                    <th scope="col">Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($transaksi as $key => $dataTransaksi)
                                    <tr>
                                        <th scope="row">{{ $key += $transaksi->firstItem() }}</th>
                                        <td>{{ $dataTransaksi->nisn }}</td>
                                        <td>{{ $dataTransaksi->nama_pengelola }}</td>
                                        <td>{{ $dataTransaksi->nama_siswa }}</td>
                                        <td>{{ $dataTransaksi->tgl_dibayar }}</td>
                                        <td>{{ $dataTransaksi->bln_dibayar }}</td>
                                        <td>{{ $dataTransaksi->thn_dibayar }}</td>
                                        <td>{{ $dataTransaksi->jumlah_bayar }}</td>
                                        <td>{{ $dataTransaksi->tahun . " - Rp." . $dataTransaksi->nominal }}</td>
                                        <td>{{ "Rp." . $dataTransaksi->nominal - $dataTransaksi->jumlah_bayar }}</td>
                                        <td>{{ $dataTransaksi->midtrans_status }}</td>
                                        <td>{{ $dataTransaksi->created_at }}</td>
                                        <td>{{ $dataTransaksi->updated_at }}</td>
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
                        <div class="mt-2">
                            {{ $transaksi->links() }}
                        </div>
                        <p>Sisa Tunggakan : {{ "Rp." . Auth()->user()->total_bayar }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
