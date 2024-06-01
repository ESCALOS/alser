<div>
    <div class="w-full space-y-4 lg:w-1/3">
        <x-operation.summary :$operation />
        <x-operation.no-cash />
        <x-operation.important :originBank="$operation->originBank->name" :destinationBank="$operation->destinationBank->name" />
    </div>
    <div class="w-full lg:w-2/3">
        <div>

        </div>
        <div>

        </div>
    </div>
</div>
