<div class="col-md-12 mb-3">
    <div class="card">
        <div class="card-header">
            <h3>Form Petugas - Update</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent.lazy="updateDataPetugas">
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
                                Save and Change
                            </button>
                            <button wire:click="addPetugas()" class="btn btn-primary"><i class="bi bi-plus-square"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
