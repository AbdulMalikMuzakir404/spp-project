<div class="container">
    <div class="row gutters-sm">

        @if ($status_petugas)
        @livewire('data.petugas-update')
        @else
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Form Petugas</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent.lazy="makeDataPetugas">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" wire:model.lazy="email"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email Address"
                                            required>
                                        @error('email')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
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
                            </div>
                            <div class="col-md-6">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model.lazy="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="username Lengkap" required>
                                        @error('username')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model.lazy="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="password" required>
                                        @error('password')
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
                    <h3>Form Petugas</h3>
                    <div class="row mt-3">
                        <div class="col">
                            <select wire:model="paginate" class="form-select-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div class="col">
                            <input wire:model="search" type="text" class="form-control w-auto" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Password Encrypt</th>
                                <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($petugas as $key => $dataPetugas)
                            <tr>
                              <th scope="row">{{ $key += $petugas->firstItem() }}</th>
                              <td>{{ $dataPetugas->email }}</td>
                              <td>{{ $dataPetugas->name }}</td>
                              <td>{{ $dataPetugas->username }}</td>
                              <td>{{ $dataPetugas->password_show }}</td>
                              <td>{{ $dataPetugas->password }}</td>
                              <td>
                                <button wire:click="getIdPetugas({{ $dataPetugas->id }})" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                                <button  wire:click="deletePetugas({{ $dataPetugas->id }})" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $petugas->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
