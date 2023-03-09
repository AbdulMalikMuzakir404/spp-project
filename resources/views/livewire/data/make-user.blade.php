<div class="container">
    <div class="row gutters-sm">

        @if ($status_siswa)
            @livewire('data.user-update')
        @else
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Form Siswa</h3>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent.lazy="makeDataSiswa">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">NISN</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" wire:model.lazy="nisn"
                                                class="form-control @error('nisn') is-invalid @enderror"
                                                placeholder="NISN" required>
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
                                                class="form-control @error('nis') is-invalid @enderror"
                                                placeholder="NIS" required>
                                            @error('nis')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Kelas Id</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select aria-label="Default select example" wire:model.lazy="ruang_id"
                                                class="@error('ruang_id') is-invalid @enderror form-select"
                                                value="{{ old('ruang_id') }}" required>
                                                <option selected="selected">KELAS ID</option>
                                                @foreach ($ruang as $data)
                                                    <option value="{{ $data->id }}">
                                                        {{ $data->nama_kelas . ' - ' . $data->kopetensi_keahlian }}
                                                    </option>
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
                                            <h6 class="mb-0">Alamat</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea wire:model.lazy="alamat" class="form-control @error('email') is-invalid @enderror" cols="30"
                                                rows="3" required placeholder="Alamat"></textarea>
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
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Table Data Siswa</h3>
                    <div class="row mt-3">
                        <div class="col">
                            <select wire:model="paginate" class="form-select-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div class="col">
                            <input wire:model="search" type="text" class="form-control w-auto"
                                placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NISN</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Sisa Tunggakan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($siswa as $key => $dataSiswa)
                                <tr>
                                    <th scope="row">{{ $key += $siswa->firstItem() }}</th>
                                    <td>{{ $dataSiswa->nisn }}</td>
                                    <td>{{ $dataSiswa->nis }}</td>
                                    <td>{{ $dataSiswa->nama_kelas . ' - ' . $dataSiswa->kopetensi_keahlian }}</td>
                                    <td>{{ $dataSiswa->name }}</td>
                                    <td>{{ '+62 ' . $dataSiswa->no_telp }}</td>
                                    <td>{{ $dataSiswa->alamat }}</td>
                                    <td>{{ $dataSiswa->total_bayar }}</td>
                                    <td>
                                        <button wire:click="getIdSiswa({{ $dataSiswa->nisn }})"
                                            class="btn btn-primary btn-sm"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button wire:click="deleteSiswa({{ $dataSiswa->nisn }})"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $siswa->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
