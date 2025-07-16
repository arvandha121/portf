document.addEventListener("DOMContentLoaded", function () {
    feather.replace();

    // Toggle Dropdown Menu
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");
    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener("click", (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle("hidden");
        });
        document.addEventListener("click", (e) => {
            if (!dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add("hidden");
            }
        });
    }

    // Toggle Mobile Sidebar
    const openBtn = document.getElementById("openMobileSidebar");
    const closeBtn = document.getElementById("closeMobileSidebar");
    const mobileSidebar = document.getElementById("mobileSidebar");

    if (mobileSidebar && openBtn && closeBtn) {
        openBtn.addEventListener("click", () => {
            mobileSidebar.classList.remove("-translate-x-full");
            document.body.classList.add("overflow-hidden");
        });

        closeBtn.addEventListener("click", () => {
            mobileSidebar.classList.add("-translate-x-full");
            document.body.classList.remove("overflow-hidden");
        });

        document.querySelectorAll("#mobileSidebar a").forEach((link) => {
            link.addEventListener("click", () => {
                mobileSidebar.classList.add("-translate-x-full");
                document.body.classList.remove("overflow-hidden");
            });
        });
    }

    // Expand Sidebar on Hover (Desktop)
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.getElementById("main-content");

    if (sidebar && mainContent) {
        sidebar.addEventListener("mouseenter", () => {
            mainContent.classList.remove("md:pl-[72px]");
            mainContent.classList.add("md:pl-[240px]");
        });

        sidebar.addEventListener("mouseleave", () => {
            mainContent.classList.remove("md:pl-[240px]");
            mainContent.classList.add("md:pl-[72px]");
        });
    }
});
