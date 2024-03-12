import './bootstrap';

document.addEventListener('livewire:navigating', () => {
    Alpine.data('quoter', () => ({
        active: true,
        purchase: true,
        dolarAmount: 1000,
        solAmount: 0,
        purchasePrice: 1,
        salesPrice: 1,

        async init() {
            const response = await fetch('http://127.0.0.1/api/latest-price');
            const data = await response.json();
            this.purchasePrice = parseFloat(data.purchase);
            this.salesPrice = parseFloat(data.sales);
            this.solAmount = 1000 * this.purchasePrice;
            this.toggleQuoterClass(true);
            this.togglePurchaseClass(true);
            this.$watch('active', value => {
                this.toggleQuoterClass(value);
            });
            this.$watch('purchase', value => {
                this.updateSolAmount();
                this.togglePurchaseClass(value);
            });
        },

        updateSolAmount() {
            // Actualizar la cantidad de soles cuando cambia la cantidad de dólares
            this.solAmount = this.purchase ? (this.dolarAmount * this.purchasePrice).toFixed(
                2) : (this.dolarAmount / this.salesPrice).toFixed(2);
        },

        updateDolarAmount() {
            // Actualizar la cantidad de dólares cuando cambia la cantidad de soles
            this.dolarAmount = this.purchase ? (this.solAmount / this.purchasePrice).toFixed(
                2) : (this.solAmount * this.salesPrice).toFixed(2);
        },
        toggleQuoterClass(active) {

            if (active) {
                //visibilidad del cotizador
                document.getElementById('container-quoter').classList.remove(
                    'absolute');
                document.getElementById('container-quoter').classList.remove('-z-10');
                document.getElementById('container-quoter').classList.add(
                    'relative');
                document.getElementById('container-quoter').classList.remove(
                'translate-x-full');
                document.getElementById('container-promo').classList.add('absolute');
                document.getElementById('container-promo').classList.add('-z-10')
                document.getElementById('container-promo').classList.add('translate-x-full');
                document.getElementById('container-promo').classList.remove('relative');
                //color y fondo de los tabs
                document.getElementById('toggle-quoter').classList.add(
                    'bg-home-primary');
                document.getElementById('toggle-quoter').classList.add('text-white');
                document.getElementById('toggle-quoter').classList.remove(
                    'tex-gray-700');
                document.getElementById('toggle-promo').classList.remove(
                    'bg-home-primary');
                document.getElementById('toggle-promo').classList.remove('text-white');
                document.getElementById('toggle-promo').classList.add(
                    'tex-gray-700');

            } else {
                //visibilidad de la promo
                document.getElementById('container-quoter').classList.add(
                    'absolute');
                document.getElementById('container-quoter').classList.add('-z-10');
                document.getElementById('container-quoter').classList.remove(
                    'relative');
                document.getElementById('container-quoter').classList.add('translate-x-full');
                document.getElementById('container-promo').classList.remove('translate-x-full');
                document.getElementById('container-promo').classList.remove('absolute');
                document.getElementById('container-promo').classList.remove('-z-10');
                document.getElementById('container-promo').classList.add('relative');
                //color y fondo de los tabs
                document.getElementById('toggle-quoter').classList.remove(
                    'bg-home-primary');
                document.getElementById('toggle-quoter').classList.remove('text-white');
                document.getElementById('toggle-quoter').classList.add(
                    'tex-gray-700');
                document.getElementById('toggle-promo').classList.add(
                    'bg-home-primary');
                document.getElementById('toggle-promo').classList.add('text-white');
                document.getElementById('toggle-promo').classList.remove(
                    'tex-gray-700');
            }
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
})
