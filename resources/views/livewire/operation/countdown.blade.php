<div x-data="countdown"
    class="flex items-center flex-wrap md:flex-nowrap justify-between px-4 py-2 mt-6 md:mt-0 bg-yellow-200 border border-yellow-600 rounded-md w-96">
    <p class="text-sm">Tiempo para ingresar el N° de operación</p>
    <p class="font-semibold text-md" x-text="formattedTime"></p>
</div>
@script
    <script>
        Alpine.data('countdown', () => ({
            timeLeft: null,
            formattedTime: '',
            createdAt: $wire.createdAt,
            hasDispatched: false,
            init() {
                const endTime = new Date(new Date(this.createdAt).getTime() + 15 * 60000);
                this.updateTimeLeft(endTime);

                setInterval(() => {
                    this.updateTimeLeft(endTime);
                }, 1000);
            },
            updateTimeLeft(endTime) {
                const now = new Date();
                const timeDiff = endTime - now;

                if (timeDiff <= 0) {
                    this.formattedTime = '00:00';
                    console.log('Se te acabó el tiempo')
                } else {
                    const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
                    this.formattedTime = `${this.pad(minutes)}:${this.pad(seconds)}`;

                    if (minutes <= 5 && !this.hasDispatched) {
                        console.log('Te quedan menos de 5 minutos')
                        this.hasDispatched = true;
                    }
                }
            },
            pad(num) {
                return num < 10 ? '0' + num : num;
            }
        }))
    </script>
@endscript
