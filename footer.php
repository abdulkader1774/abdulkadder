        </main>
        
        <footer class="bg-dark text-white pt-5 pb-4 mt-5 " >
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5 class="text-uppercase mb-4">Quiz System</h5>
                        <p>A comprehensive platform for online quizzes and assessments. Test your knowledge, compete with others, and track your progress.</p>
                        <div class="mt-4">
                            <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-md-2 mb-4">
                        <h5 class="text-uppercase mb-4">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                            <li class="mb-2"><a href="user-contest.php" class="text-white text-decoration-none">Contests</a></li>
                            <li class="mb-2"><a href="practice-contest.php" class="text-white text-decoration-none">Practice</a></li>
                            <li class="mb-2"><a href="user-leaderboard.php" class="text-white text-decoration-none">Leaderboards</a></li>
                            <li class="mb-2"><a href="contact-with-admin.php" class="text-white text-decoration-none">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <h5 class="text-uppercase mb-4">Support</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="faq.php" class="text-white text-decoration-none">FAQ</a></li>
                            <li class="mb-2"><a href="privacy.php" class="text-white text-decoration-none">Privacy Policy</a></li>
                            <li class="mb-2"><a href="terms.php" class="text-white text-decoration-none">Terms of Service</a></li>
                            <li class="mb-2"><a href="contact-with-admin.php" class="text-white text-decoration-none">Help Center</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <h5 class="text-uppercase mb-4">Contact Us</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> 123 Quiz Street, Knowledge City</li>
                            <li class="mb-2"><i class="bi bi-telephone me-2"></i> +1 234 567 890</li>
                            <li class="mb-2"><i class="bi bi-envelope me-2"></i> info@quizsystem.com</li>
                        </ul>
                    </div>
                </div>
                
                <hr class="my-4 bg-light">
                
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">&copy; <?php echo date('Y'); ?> Quiz System. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">Designed with <i class="bi bi-heart-fill text-danger"></i> by Quiz Team</p>
                    </div>
                </div>
            </div>
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
            
            // Profile dropdown hover effect
            const profileDropdown = document.getElementById('profileDropdown');
            if (profileDropdown) {
                profileDropdown.addEventListener('mouseenter', function() {
                    const dropdownMenu = this.nextElementSibling;
                    const bsDropdown = bootstrap.Dropdown.getInstance(this) || new bootstrap.Dropdown(this);
                    bsDropdown.show();
                    
                    // Keep dropdown open when hovering over it
                    dropdownMenu.addEventListener('mouseleave', function() {
                        bsDropdown.hide();
                    });
                });
            }
        </script>
    </body>
</html>