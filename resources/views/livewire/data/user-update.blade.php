<div class="col-md-12 mb-3">
    <div class="card">
        <div class="card-header">
            <h3>Form Siswa - Update</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent.lazy="updateDataSiswa">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">NISN</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" wire:model.lazy="nisn"
                                    class="form-control @error('nisn') is-invalid @enderror" placeholder="NISN"
                                    required disabled>
                                @error('nisn')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">NIS</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" wire:model.lazy="nis"
                                    class="form-control @error('nis') is-invalid @enderror" placeholder="NIS"
                                    required>
                                @error('nis')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Spp Id</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select aria-label="Default select example" wire:model.lazy="spp_id"
                                    class="@error('spp_id') is-invalid @enderror form-select"
                                    value="{{ old('spp_id') }}" required>
                                    <option selected="selected" value="{{ $spp_id }}">{{ $tahun . " - Rp." . $nominal }}</option>
                                    @foreach ($spp as $data)
                                    <option value="{{ $data->id }}">{{ $data->tahun . " - Rp." . $data->nominal }}</option>
                                    @endforeach
                                </select>
                                @error('spp_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Kelas Id</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select aria-label="Default select example" wire:model.lazy="ruang_id"
                                    class="@error('ruang_id') is-invalid @enderror form-select"
                                    value="{{ old('ruang_id') }}" required>
                                    <option selected="selected" value="{{ $ruang_id }}">{{ $nama_kelas . " - " . $kopetensi_keahlian }}</option>
                                    @foreach ($ruang as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kelas . " - " . $data->kopetensi_keahlian }}</option>
                                    @endforeach
                                </select>
                                @error('ruang_id')
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
                                <h6 class="mb-0">Nama Lengkap</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" wire:model.lazy="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Name Lengkap" required>
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary input-group">
                                <span class="input-group-text" id="basic-addon3">+62</span>
                                <input type="text" wire:model.lazy="no_telp"
                                    class="form-control @error('no_telp') is-invalid @enderror"
                                    placeholder=" xxx xxxx xxxx" required>
                                @error('no_telp')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tunggakan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary input-group">
                                <input type="text" wire:model.lazy="tunggakan"
                                    class="form-control @error('tunggakan') is-invalid @enderror"
                                    placeholder="Tunggakan" required>
                                @error('tunggakan')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Pebaharui data spp</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <div class="container">
                                    <div class="form-check">
                                        <input wire:model.lazy="total_bayar" value="{{ $spp }}" class="form-check-input @error('total_bayar') is-invalid @enderror" type="radio"
                                            id="ya">
                                        <label class="form-check-label" for="ya">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input wire:model.lazy="total_bayar" value="tidak" class="form-check-input @error('total_bayar') is-invalid @enderror" type="radio"
                                            id="tidak" checked>
                                        <label class="form-check-label" for="tidak">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                @error('total_bayar')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <textarea wire:model.lazy="alamat" class="form-control @error('email') is-invalid @enderror" cols="30" rows="3"
                                    required placeholder="Alamat"></textarea>
                                @error('alamat')
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
                            <button wire:click="addSiswa()" class="btn btn-primary"><i class="bi bi-plus-square"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
