<div x-data="countdownTimer('{{ $createdAt }}', 15)">
    <p x-text="formattedTime"></p>
</div>
@script
    <script>
        function countdownTimer(createdAt, minutesToAdd) {
            return {
                timeLeft: null,
                formattedTime: '',
                init() {
                    const endTime = new Date(new Date(createdAt).getTime() + minutesToAdd * 60000);
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
                    } else {
                        const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
                        this.formattedTime = `${this.pad(minutes)}:${this.pad(seconds)}`;
                    }
                },
                pad(num) {
                    return num < 10 ? '0' + num : num;
                }
            }
        }
    </script>
@endscript
