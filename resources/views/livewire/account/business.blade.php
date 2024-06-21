<div>
    <x-mary-card title="Datos del Perfil" shadow>
        @if ($user->isIdentityDocumentRequired())
            <livewire:account.business-form :$user />
        @else
            <x-legal-representative-form :$user :$verificationLinkSent />
        @endif
    </x-mary-card>
</div>
