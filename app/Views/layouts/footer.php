    <footer class="mt-auto py-3 bg-dark text-white text-center">
        <div class="container">
            <span class="text-white-50">&copy; <?= date('Y') ?> StartuPInvest. Tous droits réservés.</span>
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
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            }
        });
    </script>
</body>
</html>
