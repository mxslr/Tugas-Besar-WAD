<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-dark mb-0">
            {{ __('Profil Saya') }} 👤
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container-xl px-4">
            <div class="row g-4">

                {{-- Update Informasi Profil --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0 text-primary">
                                <i class="bi bi-person-lines-fill me-2"></i> Informasi Profil
                            </h5>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                {{-- Ubah Password --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0 text-warning">
                                <i class="bi bi-shield-lock-fill me-2"></i> Ubah Password
                            </h5>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                {{-- Hapus Akun --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0 text-danger">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Hapus Akun
                            </h5>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
