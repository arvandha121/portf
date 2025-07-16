<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="relative container mx-auto px-6 md:px-12 lg:px-20">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" class="h-8 w-8">
            </a>

            {{-- Desktop Menu --}}
            <nav class="hidden md:flex space-x-6 text-sm font-medium text-gray-700">
                <a href="{{ route('home') }}"
                    class="{{ request()->is('/') ? 'text-cyan-500 font-semibold' : 'hover:text-cyan-500' }}">
                    Home
                </a>
                <a href="#about"
                    class="{{ request()->is('#about') ? 'text-cyan-500 font-semibold' : 'hover:text-cyan-500' }}">
                    About
                </a>
                <a href="#skills"
                    class="{{ request()->is('#skills') ? 'text-cyan-500 font-semibold' : 'hover:text-cyan-500' }}">
                    Skills
                </a>
                <a href="#certification"
                    class="{{ request()->is('#certification') ? 'text-cyan-500 font-semibold' : 'hover:text-cyan-500' }}">
                    Certification
                </a>
                <a href="#portfolio"
                    class="{{ request()->is('#portfolio') ? 'text-cyan-500 font-semibold' : 'hover:text-cyan-500' }}">
                    Portfolio
                </a>
            </nav>

            {{-- Mobile Menu Button --}}
            <div class="md:hidden relative">
                <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
                    <i data-feather="menu" class="w-6 h-6"></i>
                </button>

                {{-- Dropdown Menu (Mobile) --}}
                <div id="mobile-menu"
                    class="hidden absolute right-0 mt-3 w-48 rounded-md bg-white shadow-lg border border-gray-100 py-2 text-sm z-50">
                    <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Home</a>
                    <a href="#about" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">About</a>
                    <a href="#skills" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Skills</a>
                    <a href="#certification" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Certification</a>
                    <a href="#portfolio" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Portfolio</a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuBtn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });

        // Highlight nav link on scroll (for anchors like #about, etc.)
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('nav a, #mobile-menu a');

        function setActiveSection() {
            let scrollY = window.pageYOffset;

            sections.forEach(current => {
                const sectionHeight = current.offsetHeight;
                const sectionTop = current.offsetTop - 100;
                const sectionId = current.getAttribute('id');

                if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                    navLinks.forEach(link => {
                        link.classList.remove('text-cyan-500', 'font-semibold');
                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('text-cyan-500', 'font-semibold');
                        }
                    });
                }
            });
        }

        window.addEventListener('scroll', setActiveSection);
    });
</script>
