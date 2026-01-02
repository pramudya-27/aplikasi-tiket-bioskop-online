import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    const loginBtn = document.getElementById("loginBtn");
    const registerBtn = document.getElementById("registerBtn");
    const loginModal = document.getElementById("loginModal");
    const registerModal = document.getElementById("registerModal");
    const closeLogin = document.getElementById("closeLogin");
    const closeRegister = document.getElementById("closeRegister");

    function openModal(modal) {
        modal.classList.remove("hidden");
    }

    function closeModal(modal) {
        modal.classList.add("hidden");
    }

    if (loginBtn && loginModal) {
        loginBtn.addEventListener("click", (e) => {
            e.preventDefault();
            openModal(loginModal);
        });
    }

    if (registerBtn && registerModal) {
        registerBtn.addEventListener("click", (e) => {
            e.preventDefault();
            openModal(registerModal);
        });
    }

    if (closeLogin && loginModal) {
        closeLogin.addEventListener("click", () => {
            closeModal(loginModal);
        });
    }

    if (closeRegister && registerModal) {
        closeRegister.addEventListener("click", () => {
            closeModal(registerModal);
        });
    }

    // Close modal when clicking outside
    window.addEventListener("click", (e) => {
        if (e.target === loginModal) {
            closeModal(loginModal);
        }
        if (e.target === registerModal) {
            closeModal(registerModal);
        }
    });

    // Slideshow Logic
    const slides = document.querySelectorAll(".zs-slide");
    const bullets = document.querySelectorAll(".zs-bullets .zs-bullet"); // Assuming bullets might be used later or if they exist
    let currentSlide = 0;
    const slideInterval = 5000; // Change slide every 5 seconds

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                // Active Slide
                slide.classList.remove("opacity-0", "scale-110", "z-0");
                slide.classList.add("opacity-100", "scale-100", "z-10");
            } else {
                // Inactive Slide
                slide.classList.remove("opacity-100", "scale-100", "z-10");
                slide.classList.add("opacity-0", "scale-110", "z-0");
            }
        });

        // Update Bullets
        bullets.forEach((bullet, i) => {
            if (i === index) {
                bullet.classList.remove("bg-white");
                bullet.classList.add("bg-brand-teal");
            } else {
                bullet.classList.remove("bg-brand-teal");
                bullet.classList.add("bg-white");
            }
        });
    }

    if (slides.length > 0) {
        // Initial state
        showSlide(0);

        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, slideInterval);
    }

    // Search Overlay Logic
    const searchTrigger = document.getElementById("searchTrigger");
    const searchOverlay = document.getElementById("searchOverlay");
    const closeSearch = document.getElementById("closeSearch");
    const searchInput = searchOverlay
        ? searchOverlay.querySelector("input")
        : null;

    if (searchTrigger && searchOverlay) {
        searchTrigger.addEventListener("click", (e) => {
            e.preventDefault();
            searchOverlay.classList.remove("hidden");
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                searchOverlay.classList.remove("opacity-0");
                if (searchInput) searchInput.focus();
            }, 10);
        });
    }

    if (closeSearch && searchOverlay) {
        closeSearch.addEventListener("click", () => {
            searchOverlay.classList.add("opacity-0");
            setTimeout(() => {
                searchOverlay.classList.add("hidden");
            }, 300);
        });
    }
});
