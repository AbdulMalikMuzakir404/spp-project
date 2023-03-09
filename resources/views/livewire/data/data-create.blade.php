<div class="container">
    <div class="row gutters-sm">

        @if ($status_spp)
        @livewire('data.data-update')
        @else
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Form SPP</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent.lazy="makeDataSpp">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tahun</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date" wire:model.lazy="tahun"
                                            class="form-control @error('tahun') is-invalid @enderror" placeholder="tahun Address"
                                            required>
                                        @error('tahun')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nominal</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model.lazy="nominal"
                                            class="form-control @error('nominal') is-invalid @enderror"
                                            placeholder="Nominal" required>
                                        @error('nominal')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <button type="submit" wire:click="submitSpp" class="btn btn-info">
                                        <div wire:loading wire:target="submitSpp">
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

        @if ($status_kelas)
        @livewire('data.kelas-update')
        @else
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Form Kelas</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent.lazy="makeDataKelas">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama Kelas</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model.lazy="nama_kelas"
                                            class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="Nama Kelas"
                                            required>
                                        @error('nama_kelas')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Kopetensi Keahlian</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select aria-label="Default select example" wire:model.lazy="kopetensi_keahlian"
                                            class="@error('kopetensi_keahlian') is-invalid @enderror form-select"
                                            value="{{ old('kopetensi_keahlian') }}" required>
                                            <option disabled="disabled" selected="selected">Kopetensi Keahlian</option>
                                            <option value="RPL - 1">RPL - 1</option>
                                            <option value="RPL - 2">RPL - 2</option>
                                            <option value="MM">MM</option>
                                            <option value="TKJ">TKJ</option>
                                        </select>
                                        @error('kopetensi_keahlian')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <button type="submit" wire:click="submitKelas" class="btn btn-info">
                                        <div wire:loading wire:target="submitKelas">
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

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Table SPP</h3>
                    <div class="row mt-3">
                        <div class="col">
                            <select wire:model="paginate_spp" class="form-control-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div class="col">
                            <input wire:model="search_spp" type="text" class="form-control w-auto" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Tahun</th>
                              <th scope="col">Nominal</th>
                              <th scope="col">Created</th>
                              <th scope="col">Action</th>
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
                              <td>
                                <button wire:click="getIdSpp({{ $dataSpp->id }})" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                                <button wire:click="deleteSpp({{ $dataSpp->id }})" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                              </td>
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

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Table Kelas</h3>
                    <div class="row mt-3">
                        <div class="col">
                            <select wire:model="paginate_kelas" class="form-control-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div class="col">
                            <input wire:model="search_kelas" type="text" class="form-control w-auto" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Kelas</th>
                              <th scope="col">Kopetensi Keahlian</th>
                              <th scope="col">Created</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($data_kelas as $key => $dataKelas)
                            <tr>
                              <th scope="row">{{ $key += $data_kelas->firstItem() }}</th>
                              <td>{{ $dataKelas->nama_kelas }}</td>
                              <td>{{ $dataKelas->kopetensi_keahlian }}</td>
                              <td>{{ $dataKelas->created_at }}</td>
                              <td>
                                <button wire:click="getIdKelas({{ $dataKelas->id }})" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                                <button  wire:click="deleteKelas({{ $dataKelas->id }})" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $data_kelas->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
