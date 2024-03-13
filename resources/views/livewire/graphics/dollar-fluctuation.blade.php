<div class="w-full bg-white border rounded shadow h-96">
    <div class="py-4 bg-gray-100">
        <h2 class="text-xl text-center">{{ $isPurchase ? 'Compra' : 'Venta' }}</h2>
    </div>
    <div class="md:px-4 h-80">
        <livewire:livewire-line-chart :line-chart-model="$chart" />
    </div>
</div>
