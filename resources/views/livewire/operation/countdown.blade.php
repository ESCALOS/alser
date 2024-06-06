<div x-data="countdown"
    class="flex flex-wrap items-center justify-between px-4 py-2 mt-6 bg-yellow-200 border border-yellow-600 rounded-md md:flex-nowrap md:mt-0 w-96">
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
            intervalId: null,
            init() {
                const endTime = new Date(new Date(this.createdAt).getTime() + 15 * 60000);

                if (this.updateTimeLeft(endTime)) {
                    this.intervalId = setInterval(() => {
                        this.updateTimeLeft(endTime);
                    }, 1000);
                }

            },
            updateTimeLeft(endTime) {
                const now = new Date();
                const timeDiff = endTime - now;

                if (timeDiff <= 0) {
                    this.formattedTime = '00:00';
                    $wire.dispatch('operation-cancelled')
                    Swal.fire({
                        title: "<strong>Operación rechazada</strong>",
                        text: "Tu operación fue rechazada dado que no enviaste el número de transferencia en el tiempo indicado. Si ya realizaste la transferencia pero no lograste enviarnos el número de operación; puedes volver a ingresar una nueva solicitud y colocar dicho número."
                    });
                    if (this.intervalId) {
                        clearInterval(this.intervalId);
                    }
                    return false;
                } else {
                    const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
                    this.formattedTime = `${this.pad(minutes)}:${this.pad(seconds)}`;

                    if (minutes <= 4 && !this.hasDispatched) {
                        Swal.fire({
                            title: "Realiza la transferencia",
                            text: "Cuidado, solo te quedan `${this.pad(minutes)}:${this.pad(seconds)}` minutos para realizar la transferencia bancaria y enviarnos el número de operación de la transferencia",
                        });
                        this.hasDispatched = true;
                    }
                }
                return true;
            },
            pad(num) {
                return num < 10 ? '0' + num : num;
            }
        }))
    </script>
@endscript
