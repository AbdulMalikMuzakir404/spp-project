<div class="col-md-12 mb-3">
    <div class="card">
        <div class="card-header">
            <h3>Form Transaksi - Update</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent.lazy="updateDataTransaksi">
                <div class="row">

                    <div class="col-md-6">
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">NISN</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select aria-label="Default select example" wire:model.lazy="nisn"
                                    class="@error('nisn') is-invalid @enderror form-select"
                                    value="{{ old('nisn') }}" required>
                                    <option selected="selected">NISN</option>
                                    @foreach ($datas as $data)
                                        <option value="{{ $data->nisn }}">
                                            {{ $data->name . ' - ' . $data->nisn }}</option>
                                    @endforeach
                                </select>
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
                                <select aria-label="Default select example" wire:model.lazy="name"
                                    class="@error('name') is-invalid @enderror form-select"
                                    value="{{ old('name') }}" required>
                                    <option selected="selected">Nama Siswa</option>
                                    @foreach ($datas as $data)
                                        <option value="{{ $data->name }}">
                                            {{ $data->name . ' - ' . $data->nisn }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">SPP ID</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select aria-label="Default select example" wire:model.lazy="spp_id"
                                    class="@error('spp_id') is-invalid @enderror form-select"
                                    value="{{ old('spp_id') }}" required>
                                    <option selected="selected">SPP ID</option>
                                    @foreach ($dataSpp as $spp)
                                        <option value="{{ $spp->id }}">
                                            {{ $spp->tahun . ' - Rp.' . $spp->nominal }}</option>
                                    @endforeach
                                </select>
                                @error('spp_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tanggal Bayar</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select aria-label="Default select example" wire:model.lazy="tgl_dibayar"
                                    class="@error('tgl_dibayar') is-invalid @enderror form-select"
                                    value="{{ old('tgl_dibayar') }}" required>
                                    <option selected="selected">Tanggal</option>
                                    @for ($tanggal = 1; $tanggal <= 31; $tanggal++)
                                        <option value="{{ $tanggal }}">{{ $tanggal }}</option>
                                    @endfor
                                </select>
                                @error('tgl_dibayar')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Bulan Bayar</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select aria-label="Default select example" wire:model.lazy="bln_dibayar"
                                    class="@error('bln_dibayar') is-invalid @enderror form-select"
                                    value="{{ old('bln_dibayar') }}" required>
                                    <option selected="selected">Bulan</option>
                                    @php
                                        $data = ['January', 'February', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    @endphp
                                    @foreach ($data as $bln)
                                        <option value="{{ $bln }}">{{ $bln }}</option>
                                    @endforeach
                                </select>
                                @error('bln_dibayar')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tahun Bayar</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select aria-label="Default select example" wire:model.lazy="thn_dibayar"
                                    class="@error('thn_dibayar') is-invalid @enderror form-select"
                                    value="{{ old('thn_dibayar') }}" required>
                                    <option selected="selected">Tahun</option>
                                    @for ($tahun = 2000; $tahun <= date('Y'); $tahun++)
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endfor
                                </select>
                                @error('thn_dibayar')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Jumlah Bayar Update</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" wire:model.lazy="jumlah_bayar_update"
                                    class="form-control @error('jumlah_bayar_update') is-invalid @enderror"
                                    placeholder="Jumlah Bayar Update">
                                @error('jumlah_bayar_update')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <button type="submit" wire:click="submit" class="btn btn-info">
                                <div wire:loading wire:target="submit">
                                    <div class="la-ball-fall">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                                Save and Change
                            </button>
                            <button wire:click="addTransaksi()" class="btn btn-primary"><i class="bi bi-plus-square"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
