document.addEventListener("DOMContentLoaded", function () {
    feather.replace();

    // Dropdown Akun
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener("click", () => {
            dropdownMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", (e) => {
            if (
                !dropdownButton.contains(e.target) &&
                !dropdownMenu.contains(e.target)
            ) {
                dropdownMenu.classList.add("hidden");
            }
        });
    }

    // Sidebar Mobile
    const openMobileSidebar = document.getElementById("openMobileSidebar");
    const closeMobileSidebar = document.getElementById("closeMobileSidebar");
    const mobileSidebar = document.getElementById("mobileSidebar");

    if (openMobileSidebar && closeMobileSidebar && mobileSidebar) {
        openMobileSidebar.addEventListener("click", () => {
            mobileSidebar.classList.remove("translate-y-full");
        });

        closeMobileSidebar.addEventListener("click", () => {
            mobileSidebar.classList.add("translate-y-full");
        });

        document.addEventListener("click", (e) => {
            if (
                !mobileSidebar.contains(e.target) &&
                !openMobileSidebar.contains(e.target)
            ) {
                mobileSidebar.classList.add("translate-y-full");
            }
        });

        // Auto close on link click
        document.querySelectorAll("#mobileSidebar a").forEach((link) => {
            link.addEventListener("click", () => {
                mobileSidebar.classList.add("translate-y-full");
            });
        });
    }

    // 🧠 Sidebar Hover Padding Handler
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.getElementById("main-content");

    if (sidebar && mainContent) {
        sidebar.addEventListener("mouseenter", () => {
            mainContent.classList.remove("pl-[72px]");
            mainContent.classList.add("pl-[240px]");
        });

        sidebar.addEventListener("mouseleave", () => {
            mainContent.classList.remove("pl-[240px]");
            mainContent.classList.add("pl-[72px]");
        });
    }
});
