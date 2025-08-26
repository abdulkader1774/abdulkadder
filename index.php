<?php
$pageTitle = "BDIQO - Online Quiz Platform";
include 'nav.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
                    <div class="hero-overlay"></div>
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title">Welcome to BDIQO</h1>
                            <p class="hero-subtitle">Transform your learning experience with interactive quizzes</p>
                            <a href="registration.php" class="btn btn-primary btn-lg hero-btn">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
                    <div class="hero-overlay"></div>
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title">Test Your Knowledge</h1>
                            <p class="hero-subtitle">Challenge yourself with our comprehensive quiz system</p>
                            <a href="user-contest.php" class="btn btn-outline-light btn-lg hero-btn">Take a Quiz</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
                    <div class="hero-overlay"></div>
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title">Join Our Community</h1>
                            <p class="hero-subtitle">Compete with others and climb the leaderboards</p>
                            <a href="practice-contest.php" class="btn btn-primary btn-lg hero-btn">Start Practicing</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Why Choose BDIQO?</h2>
            <p class="section-subtitle">Experience the best online quiz platform</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h3>Fast & Reliable</h3>
                    <p>Quick loading times and seamless quiz experience without interruptions</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <h3>Track Progress</h3>
                    <p>Monitor your performance with detailed analytics and progress reports</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>Community</h3>
                    <p>Join thousands of learners and compete in our global leaderboards</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="About BDIQO" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">About BDIQO</h2>
                <p class="lead">Revolutionizing online learning through interactive quizzes</p>
                <p>BDIQO is a comprehensive online quiz platform designed to help learners of all levels test their knowledge, 
                   track their progress, and compete with others in a fun and engaging environment.</p>
                <p>Our platform offers a wide range of quizzes across various subjects, from academic topics to general knowledge, 
                   ensuring there's something for everyone.</p>
                <div class="mt-4">
                    <a href="about.php" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="pricing-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Simple Pricing</h2>
            <p class="section-subtitle">Choose the plan that works for you</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card pricing-card">
                    <div class="card-body text-center">
                        <h3 class="pricing-title">Free</h3>
                        <div class="pricing-price">
                            <span class="price">$0</span>
                            <span class="period">/month</span>
                        </div>
                        <ul class="pricing-features">
                            <li>5 Quizzes per day</li>
                            <li>Basic Analytics</li>
                            <li>Community Leaderboard</li>
                            <li>Email Support</li>
                        </ul>
                        <a href="registration.php" class="btn btn-outline-primary w-100">Get Started</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card pricing-card popular">
                    <div class="card-body text-center">
                        <div class="popular-badge">Most Popular</div>
                        <h3 class="pricing-title">Pro</h3>
                        <div class="pricing-price">
                            <span class="price">$9.99</span>
                            <span class="period">/month</span>
                        </div>
                        <ul class="pricing-features">
                            <li>Unlimited Quizzes</li>
                            <li>Advanced Analytics</li>
                            <li>Personal Leaderboard</li>
                            <li>Priority Support</li>
                            <li>Custom Quizzes</li>
                        </ul>
                        <a href="registration.php" class="btn btn-primary w-100">Get Started</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card pricing-card">
                    <div class="card-body text-center">
                        <h3 class="pricing-title">Enterprise</h3>
                        <div class="pricing-price">
                            <span class="price">$29.99</span>
                            <span class="period">/month</span>
                        </div>
                        <ul class="pricing-features">
                            <li>Everything in Pro</li>
                            <li>Team Management</li>
                            <li>Custom Branding</li>
                            <li>API Access</li>
                            <li>Dedicated Support</li>
                        </ul>
                        <a href="contact-with-admin.php" class="btn btn-outline-primary w-100">Contact Sales</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-subtitle">Find answers to common questions</p>
        </div>
        
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        How do I create an account?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Click on the "Register" button in the top navigation or visit the registration page. 
                        Fill in your details and you'll be ready to start quizzing in minutes!
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Are the quizzes timed?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, most of our quizzes are timed to simulate real exam conditions. However, 
                        we also offer practice modes without time limits for learning purposes.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Can I create my own quizzes?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Absolutely! With our Pro and Enterprise plans, you can create custom quizzes 
                        and share them with other users or keep them private for personal use.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        How do leaderboards work?
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Leaderboards rank users based on their quiz scores and completion times. 
                        You can compete globally or with specific groups of users.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                        Is my data secure?
                    </button>
                </h2>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, we take data security very seriously. All user data is encrypted and 
                        we comply with industry-standard security practices to protect your information.
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <p>Still have questions? <a href="contact-with-admin.php" class="text-primary">Contact us</a></p>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container">
        <div class="text-center">
            <h2 class="mb-3">Ready to Start Your Quiz Journey?</h2>
            <p class="lead mb-4">Join thousands of learners who are already improving their knowledge with BDIQO</p>
            <a href="registration.php" class="btn btn-light btn-lg">Sign Up Now</a>
        </div>
    </div>
</section>

<style>
    /* Hero Section Styles */
    .hero-section {
        height: 100vh;
        position: relative;
    }
    
    .hero-slide {
        height: 100vh;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 100%);
    }
    
    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        width: 100%;
        padding: 0 20px;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    .hero-subtitle {
        font-size: 1.5rem;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }
    
    .hero-btn {
        padding: 15px 30px;
        font-size: 1.2rem;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    
    .hero-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    /* Section Styles */
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #2c3e50;
    }
    
    .section-subtitle {
        font-size: 1.2rem;
        color: #7f8c8d;
        margin-bottom: 3rem;
    }
    
    /* Feature Cards */
    .feature-card {
        padding: 2rem;
        border-radius: 15px;
        background: white;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
    }
    
    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .feature-icon i {
        font-size: 2rem;
        color: white;
    }
    
    .feature-card h3 {
        color: #2c3e50;
        margin-bottom: 1rem;
    }
    
    /* Pricing Cards */
    .pricing-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        position: relative;
        height: 100%;
    }
    
    .pricing-card:hover {
        transform: translateY(-5px);
    }
    
    .pricing-card.popular {
        border: 2px solid #007bff;
        transform: scale(1.05);
    }
    
    .popular-badge {
        position: absolute;
        top: -10px;
        right: 20px;
        background: #007bff;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .pricing-title {
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }
    
    .pricing-price {
        margin-bottom: 2rem;
    }
    
    .price {
        font-size: 3rem;
        font-weight: 700;
        color: #007bff;
    }
    
    .period {
        color: #7f8c8d;
        font-size: 1rem;
    }
    
    .pricing-features {
        list-style: none;
        padding: 0;
        margin: 0 0 2rem 0;
    }
    
    .pricing-features li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #eee;
    }
    
    .pricing-features li:last-child {
        border-bottom: none;
    }
    
    /* FAQ Styles */
    .accordion-button {
        font-weight: 600;
        padding: 1.5rem;
        border: none;
        border-bottom: 1px solid #eee;
    }
    
    .accordion-button:not(.collapsed) {
        background: white;
        color: #007bff;
        box-shadow: none;
    }
    
    .accordion-body {
        padding: 1.5rem;
        background: #f8f9fa;
    }
    
    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .pricing-card.popular {
            transform: scale(1);
        }
        
        .feature-card, .pricing-card {
            margin-bottom: 2rem;
        }
    }
    
    @media (max-width: 576px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }
        
        .hero-btn {
            padding: 12px 25px;
            font-size: 1rem;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
    }
</style>

<script>
    // Initialize carousel with autoplay
    document.addEventListener('DOMContentLoaded', function() {
        const myCarousel = document.getElementById('heroCarousel');
        const carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000,
            wrap: true
        });
    });
</script>

<?php include 'footer.php'; ?>