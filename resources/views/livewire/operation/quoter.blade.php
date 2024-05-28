<div class="bg-white border border-gray-200 rounded-lg shadow w-full">
    <div class="flex justify-center p-4 text-center h-96">
        <div class="w-full">
            <div class="flex">
                <h1>Nueva Operación</h1>
                <div>
                    <h3>Dólar compra: 3.7210</h3>
                    <h3>Dólar venta: 3.7740</h3>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @script
    <script>
        Alpine.data('quoter', () => ({
            purchase: true,
            dolarAmount: 1000,
            solAmount: 0,
            purchasePrice: {{ $purchaseFactor }},
            salesPrice: {{ $salesFactor }},

            init() {
                this.solAmount = (1000 * this.purchasePrice).toFixed(2);
                this.togglePurchaseClass(true);
                this.$watch('purchase', value => {
                    this.updateSolAmount();
                    this.togglePurchaseClass(value);
                    document.getElementById("inputDolar").focus();
                });
            },

            updateSolAmount() {
                const dolarAmount = parseFloat(this.dolarAmount.replace(/,/g, ''));
                this.solAmount = isNaN(dolarAmount) ? 0 : (this.purchase ? (dolarAmount * this.purchasePrice)
                    .toFixed(
                        2) : (dolarAmount / this.salesPrice).toFixed(2));
            },

            updateDolarAmount() {
                const solAmount = parseFloat(this.solAmount.replace(/,/g, ''));
                this.dolarAmount = isNaN(solAmount) ? 0 : (this.purchase ? (solAmount / this.purchasePrice)
                    .toFixed(
                        2) : (solAmount * this.salesPrice).toFixed(2));
            },

            togglePurchaseClass(purchase) {
                if (purchase) {
                    //active tab-purchase
                    document.getElementById('tab-purchase').classList.add(
                        'text-home-primary');
                    document.getElementById('tab-purchase').classList.add('border-b');
                    document.getElementById('tab-purchase').classList.add(
                        'border-indigo-700');
                    document.getElementById('tab-purchase').classList.remove(
                        'border-gray-600');
                    //inactive tab-sales
                    document.getElementById('tab-sales').classList.remove(
                        'text-home-primary');
                    document.getElementById('tab-sales').classList.remove('border-b');
                    document.getElementById('tab-sales').classList.remove(
                        'border-indigo-700');
                    document.getElementById('tab-sales').classList.add(
                        'border-gray-600');
                } else {
                    //inactive tab-purchase
                    document.getElementById('tab-purchase').classList.remove(
                        'text-home-primary');
                    document.getElementById('tab-purchase').classList.remove('border-b');
                    document.getElementById('tab-purchase').classList.remove(
                        'border-indigo-700');
                    document.getElementById('tab-purchase').classList.add(
                        'border-gray-600');
                    //active tab-sales
                    document.getElementById('tab-sales').classList.add(
                        'text-home-primary');
                    document.getElementById('tab-sales').classList.add('border-b');
                    document.getElementById('tab-sales').classList.add(
                        'border-indigo-700');
                    document.getElementById('tab-sales').classList.remove(
                        'border-gray-600');
                }
            }
        }));
    </script>
@endscript --}}
