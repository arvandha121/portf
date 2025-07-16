document.addEventListener("DOMContentLoaded", function () {
    feather.replace();

    // Dropdown
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");
    if (dropdownButton) {
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

    // Mobile Sidebar
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
    }

    // Auto-close on link click
    document.querySelectorAll("#mobileSidebar a").forEach((link) => {
        link.addEventListener("click", () => {
            mobileSidebar.classList.add("translate-y-full");
        });
    });
});
