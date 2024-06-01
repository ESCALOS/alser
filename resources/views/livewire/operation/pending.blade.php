<div>
    <div class="w-full space-y-4 lg:w-1/3">
        <div>
            <x-operation.summary :$operation />
        </div>
        <div>
            <x-operation.no-cash />
        </div>
        <div>
            <x-operation.important :originBank="$operation->originBank->name" :destinationBank="$operation->destinationBank->name" />
        </div>
    </div>
    <div class="w-full lg:w-2/3">

    </div>
</div>
