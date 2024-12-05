export function initializeSidebar() {
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

    // set initial state based on screen size
    let isCollapsed = window.innerWidth < 768;

    function updateLogo() {
        if (window.innerWidth < 768) {
            // small screens: Show the letter logo, hide the image logo
            logoImage.style.display = "none";
            logoLetter.style.display = "inline";
        } else {
            // larger screens: Toggle based on collapsed state
            if (isCollapsed) {
                logoImage.style.display = "none";
                logoLetter.style.display = "inline";
            } else {
                logoImage.style.display = "inline";
                logoLetter.style.display = "none";
            }
        }
    }

    // collapse the sidebar
    function collapseSidebar() {
        isCollapsed = true;

        // apply collapsed classes
        sidebar.classList.add("collapsed");
        sidebar.style.width = "4rem";
        mainContent.style.marginRight = "4rem";
        updateLogo();

        // hide dropDownLinks
        dropDownLinks.forEach((item) => {
            item.classList.remove("block");
            item.classList.add("hidden");
        });

        // show normalSidbarLinks
        normalSidbarLinks.forEach((item) => {
            item.classList.remove("hidden");
            item.classList.add("flex", "sidebar-link");
        });

        // Hide sidebar text
        sidebarTextElements.forEach((el) => {
            // el.style.opacity = "0";
            // el.style.width = "0";
            el.classList.remove('block');
            el.classList.add('hidden');
        });

        // adjust alignment for collapsed state
        sidebarLinks.forEach((link) => {
            link.classList.add("justify-center"); // center-align icons and content
            link.classList.remove("gap-3");
        });

        collapseIcon.style.transform = "rotate(180deg)";
    }

    function expandSidebar() {
        isCollapsed = false;

        // remove collapsed classes
        sidebar.classList.remove("collapsed");
        sidebar.style.width = "16rem";
        mainContent.style.marginRight = "16rem";
        updateLogo();

        // show dropDownLinks
        dropDownLinks.forEach((item) => {
            item.classList.remove("hidden");
            item.classList.add("block");
        });

        // hide normalSidbarLinks
        normalSidbarLinks.forEach((item) => {
            item.classList.remove("flex", "sidebar-link");
            item.classList.add("hidden");
        });

        // Show sidebar text
        sidebarTextElements.forEach((el) => {
            // el.style.opacity = "1";
            // el.style.width = "auto";
            el.classList.remove('hidden');
            el.classList.add('block');
        });

        // reset alignment for expanded state
        sidebarLinks.forEach((link) => {
            link.classList.remove("justify-center"); // restore default alignment
            link.classList.add("gap-3"); // restore gaps between icons and text
        });

        collapseIcon.style.transform = "";
    }

    // update sidebar state based on current collapse state
    function updateSidebarState() {
        if (isCollapsed) {
            collapseSidebar();
        } else {
            expandSidebar();
        }
    }

    // handle responsive layout changes
    function handleResponsiveLayout() {
        if (window.innerWidth < 768) {
            collapseSidebar();
        } else if (!isCollapsed) {
            expandSidebar();
        }
    }

    // initialize event listeners
    window.addEventListener("resize", handleResponsiveLayout);
    collapseBtn.addEventListener("click", () => {
        isCollapsed = !isCollapsed;
        updateSidebarState();
    });

    // initial calls
    updateSidebarState();
    updateLogo();
    handleResponsiveLayout();
}
