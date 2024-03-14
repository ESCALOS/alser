<div>
    <x-mary-choices-offline @change-selection="console.log($event.detail.value)" label="Departamentos"
        wire:model="department" :options="$this->departments" single searchable no-result-text="El departamento no existe." />
</div>
