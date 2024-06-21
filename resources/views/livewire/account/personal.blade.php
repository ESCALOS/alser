<div>
    <x-mary-card title="Datos del Perfil" shadow>
        @if ($this->user->isIdentityDocumentRequired())
            <livewire:account.personal-form :user="$this->user" :verification-link-sent="$verificationLinkSent" />
        @else
            <x-profile-data-form :verification-link-sent="$verificationLinkSent" />
        @endif
    </x-mary-card>
</div>
