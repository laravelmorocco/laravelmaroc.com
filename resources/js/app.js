import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import collapse from '@alpinejs/collapse';
import focus from "@alpinejs/focus";

import AlpineFloatingUI from '@awcodes/alpine-floating-ui';
import Tooltip from '@ryangjchandler/alpine-tooltip';

import NotificationsAlpinePlugin from './utils/module.esm';
import internationalNumber from './plugins/internationalNumber';
import datepicker from './plugins/datepicker';
import { registerHeader } from '@helpers/header';
import '@helpers/helpers';
import '@helpers/scrollspy';
import './elements';
import './utils/editor';
import './utils/filepond';
import './utils/clipboard';

import "perfect-scrollbar/css/perfect-scrollbar.css";
import "../css/theme.css";

registerHeader();

Alpine.plugin(AlpineFloatingUI);
Alpine.plugin(intersect);
Alpine.plugin(collapse)
Alpine.plugin(focus);
Alpine.plugin(NotificationsAlpinePlugin);
Alpine.plugin(Tooltip);
Alpine.data('internationalNumber', internationalNumber);
Alpine.data('datepicker', datepicker);

import "@fortawesome/fontawesome-free/css/all.css";

import PerfectScrollbar from "perfect-scrollbar";
window.PerfectScrollbar = PerfectScrollbar;

Alpine.data("mainState", () => {
    const init = function () {
        window.addEventListener("scroll", () => {
            let st =
                window.pageYOffset || document.documentElement.scrollTop;
            if (st > lastScrollTop) {
                // downscroll
                this.scrollingDown = true;
                this.scrollingUp = false;
            } else {
                // upscroll
                this.scrollingDown = false;
                this.scrollingUp = true;
                if (st == 0) {
                    //  reset
                    this.scrollingDown = false;
                    this.scrollingUp = false;
                }
            }
            lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
        });
    };

    const scrollToAnchor = (anchor) => {
        const element = document.querySelector(anchor);
        if (element) {
            window.scrollTo({
                top: element.offsetTop,
                behavior: 'smooth',
            });
        }
    };

    const loadingMask = {
        pageLoaded: false,
        init() {
            window.onload = () => {
                this.pageLoaded = true;
            };
            this.animateCharge();
        },
        animateCharge() {
            setInterval(() => {
                this.showText = true;
                setTimeout(() => {
                    this.showText = false;
                }, 2000);
            }, 4000);
        },
    };


    const getTheme = () => {
        if (window.localStorage.getItem("dark")) {
            return JSON.parse(window.localStorage.getItem("dark"));
        }
        return (
            !!window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        );
    };
    const setTheme = (value) => {
        window.localStorage.setItem("dark", value);
    };

    const handleOutsideClick = (event) => {
        if (
            this.isSidebarOpen &&
            !event.target.closest(".sidebar") &&
            !event.target.closest(".sidebar-toggle")
        ) {
            this.isSidebarOpen = false;
        }
    };

    document.addEventListener("click", handleOutsideClick);

    return {
        init,
        loadingMask,
        scrollToAnchor,
        isDarkMode: getTheme(),
        toggleTheme() {
            this.isDarkMode = !this.isDarkMode;
            setTheme(this.isDarkMode);
        },
        isSidebarOpen: sessionStorage.getItem("sidebarOpen") === "true",
        handleSidebarToggle() {
            this.isSidebarOpen = !this.isSidebarOpen;
            sessionStorage.setItem("sidebarOpen", this.isSidebarOpen.toString());
        },
        closeSidebarOnMobile() {
            if (window.innerWidth < 1024) {
                this.isSidebarOpen = false;
            }
        },
        isSidebarHovered: false,
        handleSidebarHover(value) {
            if (window.innerWidth < 1024) {
                return;
            }
            this.isSidebarHovered = value;
        },
        handleWindowResize() {
            if (window.innerWidth <= 1024) {
                this.isSidebarOpen = false;
            } else {
                this.isSidebarOpen = true;
            }
        },
        scrollingDown: false,
        scrollingUp: false,
    };
});

window.Alpine = Alpine;

Alpine.start();
