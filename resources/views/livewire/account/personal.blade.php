<div>
    <x-mary-card title="Datos del Perfil" shadow>
        @if ($user->isIdentityDocumentRequired())
            <livewire:account.personal-form :$user />
        @else
            <x-profile-data-form :$user :$verificationLinkSent />
        @endif
    </x-mary-card>
</div>
