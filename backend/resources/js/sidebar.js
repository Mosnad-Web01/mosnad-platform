export function initializeSidebar() {
    // Remove 'no-js' class as soon as JavaScript runs
    document.documentElement.classList.remove("no-js");
    document.documentElement.classList.add("js");

    const sidebar = document.getElementById("sidebar");
    const collapseBtn = document.getElementById("collapse-btn");
    const mainContent = document.getElementById("main-content");
    const sidebarTextElements = document.querySelectorAll(".sidebar-text");
    const collapseIcon = document.getElementById("collapse-icon");
    const logoImage = document.getElementById("logo-image");
    const logoLetter = document.getElementById("logo-letter");
    const sidebarLinks = document.querySelectorAll(".sidebar-link");
    const dropDownLinks = document.querySelectorAll(".dropDownLink");
    const normalSidbarLinks = document.querySelectorAll(".normalSidbarLink");

    // Set initial state based on screen size
    let isCollapsed = window.innerWidth < 768;

    // Update logo visibility immediately
    function updateLogo() {
        if (window.innerWidth < 768 || isCollapsed) {
            logoImage.style.display = "none";
            logoLetter.style.display = "inline";
        } else {
            logoImage.style.display = "inline";
            logoLetter.style.display = "none";
        }
    }

    function collapseSidebar() {
        isCollapsed = true;
        sidebar.classList.add("collapsed");
        sidebar.style.width = "4rem";
        mainContent.style.marginRight = "4rem";

        dropDownLinks.forEach((item) => {
            item.classList.remove("block");
            item.classList.add("hidden");
        });

        normalSidbarLinks.forEach((item) => {
            item.classList.remove("hidden");
            item.classList.add("flex", "sidebar-link");
        });

        sidebarTextElements.forEach((el) => {
            el.classList.remove("block");
            el.classList.add("hidden");
        });

        sidebarLinks.forEach((link) => {
            link.classList.add("justify-center");
            link.classList.remove("gap-3");
        });

        collapseIcon.style.transform = "rotate(180deg)";
        updateLogo();
    }

    function expandSidebar() {
        isCollapsed = false;
        sidebar.classList.remove("collapsed");
        sidebar.style.width = "16rem";
        mainContent.style.marginRight = "16rem";

        dropDownLinks.forEach((item) => {
            item.classList.remove("hidden");
            item.classList.add("block");
        });

        normalSidbarLinks.forEach((item) => {
            item.classList.remove("flex", "sidebar-link");
            item.classList.add("hidden");
        });

        sidebarTextElements.forEach((el) => {
            el.classList.remove("hidden");
            el.classList.add("block");
        });

        sidebarLinks.forEach((link) => {
            link.classList.remove("justify-center");
            link.classList.add("gap-3");
        });

        collapseIcon.style.transform = "";
        updateLogo();
    }

    function handleResponsiveLayout() {
        if (window.innerWidth < 768) {
            collapseSidebar();
        } else if (!isCollapsed) {
            expandSidebar();
        }
    }

    // Initialize event listeners
    window.addEventListener("resize", handleResponsiveLayout);
    collapseBtn.addEventListener("click", () => {
        isCollapsed = !isCollapsed;
        isCollapsed ? collapseSidebar() : expandSidebar();
    });

    // Initial setup
    handleResponsiveLayout();
}
