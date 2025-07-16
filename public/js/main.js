// Mobile Menu Toggle
document.addEventListener("DOMContentLoaded", () => {
    // Feather icons
    feather.replace();
    const menuBtn = document.getElementById("mobile-menu-button");
    const menu = document.getElementById("mobile-menu");

    if (menuBtn && menu) {
        menuBtn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });

        menu.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                menu.classList.add("hidden");
            });
        });
    }

    // Highlight nav link on scroll
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll("nav a, #mobile-menu a");

    function setActiveSection() {
        let scrollY = window.pageYOffset;

        sections.forEach((current) => {
            const sectionHeight = current.offsetHeight;
            const sectionTop = current.offsetTop - 100;
            const sectionId = current.getAttribute("id");

            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                navLinks.forEach((link) => {
                    link.classList.remove("text-cyan-500", "font-semibold");
                    if (link.getAttribute("href") === `#${sectionId}`) {
                        link.classList.add("text-cyan-500", "font-semibold");
                    }
                });
            }
        });
    }

    window.addEventListener("scroll", setActiveSection);
});
