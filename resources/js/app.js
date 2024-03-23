import "./bootstrap";

import mask from "@alpinejs/mask";

Alpine.plugin(mask);

Alpine.data("toggle", () => ({
    active: true,

    init() {
        this.toggleQuoterClass(true);
        this.$watch("active", (value) => {
            this.toggleQuoterClass(value);
        });
    },
    toggleQuoterClass(active) {
        if (active) {
            //visibilidad del cotizador
            document
                .getElementById("container-quoter")
                .classList.remove("absolute");
            document
                .getElementById("container-quoter")
                .classList.remove("-z-10");
            document
                .getElementById("container-quoter")
                .classList.add("relative");
            document
                .getElementById("container-promo")
                .classList.add("absolute");
            document.getElementById("container-promo").classList.add("-z-10");
            document
                .getElementById("container-promo")
                .classList.remove("relative");
            //color y fondo de los tabs
            document
                .getElementById("toggle-quoter")
                .classList.add("bg-home-primary");
            document
                .getElementById("toggle-quoter")
                .classList.add("text-white");
            document
                .getElementById("toggle-quoter")
                .classList.remove("text-gray-700");
            document
                .getElementById("toggle-promo")
                .classList.remove("bg-home-primary");
            document
                .getElementById("toggle-promo")
                .classList.remove("text-white");
            document
                .getElementById("toggle-promo")
                .classList.add("text-gray-700");
        } else {
            //visibilidad de la promo
            document
                .getElementById("container-quoter")
                .classList.add("absolute");
            document.getElementById("container-quoter").classList.add("-z-10");
            document
                .getElementById("container-quoter")
                .classList.remove("relative");
            document
                .getElementById("container-promo")
                .classList.remove("absolute");
            document
                .getElementById("container-promo")
                .classList.remove("-z-10");
            document
                .getElementById("container-promo")
                .classList.add("relative");
            //color y fondo de los tabs
            document
                .getElementById("toggle-quoter")
                .classList.remove("bg-home-primary");
            document
                .getElementById("toggle-quoter")
                .classList.remove("text-white");
            document
                .getElementById("toggle-quoter")
                .classList.add("text-gray-700");
            document
                .getElementById("toggle-promo")
                .classList.add("bg-home-primary");
            document.getElementById("toggle-promo").classList.add("text-white");
            document
                .getElementById("toggle-promo")
                .classList.remove("text-gray-700");
        }
    },
}));
Alpine.data("toggleAccountType", () => ({
    accountType: 1,

    init() {
        this.toggle(1);
        this.$watch("accountType", (value) => {
            this.toggle(value);
        });
    },

    toggle(value) {
        if (value == 1) {
            document
                .getElementById("tab_personal")
                .classList.add("bg-home-primary");
            document.getElementById("tab_personal").classList.add("text-white");
            document
                .getElementById("tab_personal")
                .classList.remove("text-gray-700");
            document
                .getElementById("tab_business")
                .classList.remove("bg-home-primary");
            document
                .getElementById("tab_business")
                .classList.remove("text-white");
            document
                .getElementById("tab_business")
                .classList.add("text-gray-700");
            document
                .getElementById("tab_container")
                .classList.add("-translate-y-4");
        } else {
            document
                .getElementById("tab_personal")
                .classList.remove("bg-home-primary");
            document
                .getElementById("tab_personal")
                .classList.remove("text-white");
            document
                .getElementById("tab_personal")
                .classList.add("text-gray-700");
            document
                .getElementById("tab_business")
                .classList.add("bg-home-primary");
            document.getElementById("tab_business").classList.add("text-white");
            document
                .getElementById("tab_business")
                .classList.remove("text-gray-700");
        }
    },
}));
