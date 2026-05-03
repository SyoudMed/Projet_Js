    <footer class="mt-auto py-5 bg-surface border-top border-custom text-center text-muted-custom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="mb-3 mb-md-0 fw-semibold text-main fs-5">
                    <i class="fa-solid fa-bolt text-primary me-2"></i>StartuPInvest
                </div>
                <div class="mb-3 mb-md-0">
                    <a href="#" class="text-muted-custom me-3 text-decoration-none">À propos</a>
                    <a href="#" class="text-muted-custom me-3 text-decoration-none">Confidentialité</a>
                    <a href="#" class="text-muted-custom text-decoration-none">Conditions</a>
                </div>
                <div class="text-muted-custom small">
                    &copy; <?= date('Y') ?> StartuPInvest.
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Theme Toggle JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const htmlTag = document.documentElement;
            
            // Load saved theme
            const savedTheme = localStorage.getItem('theme') || 'light';
            htmlTag.setAttribute('data-theme', savedTheme);
            updateIcon(savedTheme);

            if(themeToggleBtn) {
                themeToggleBtn.addEventListener('click', () => {
                    const currentTheme = htmlTag.getAttribute('data-theme');
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    htmlTag.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    updateIcon(newTheme);
                });
            }

            function updateIcon(theme) {
                if(!themeToggleBtn) return;
                const icon = themeToggleBtn.querySelector('i');
                if (theme === 'dark') {
                    icon.className = 'fa-solid fa-sun text-warning';
                } else {
                    icon.className = 'fa-solid fa-moon';
                }
            }
        });
    </script>
</body>
</html>
