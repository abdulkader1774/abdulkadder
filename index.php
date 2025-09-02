<?php
$pageTitle = "BDIQO - Online Quiz Platform";
include 'nav.php';
?>

<head>
  <meta charset="UTF-8">
  <title>Google Fonts - Noto Sans Bengali উদাহরণ</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family:'Noto Sans Bengali', sans-serif;
      /* margin: 20px; */
    }
    h1 {
      font-weight: 700;
      text-align: justify;
    }
    /* Hero Section Styles */


    /* Section Styles */
    .section-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #2c3e50;
    }
    
    .section-subtitle {
        font-size: 1.2rem;
        color: #7f8c8d;
        margin-bottom: 3rem;
    }
    
    /*About Section */
    .about-section{
        height: 100vh;
    }

    .home-text {
       padding-top: 10%;
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
</head>

<!-- About Section -->
<section class="about-section py-5 bg-light pt-5">
    <div class="container home-text">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <p class="section-title">বাংলাদেশ আইটি কুইজ এবং প্রোগ্রামিং প্রতিযোগিতা-২০২৫ (বিডিআইকিউপিসি)</p>
                <p class="lead"></p>
                <p class ="text-justify">
                    তরুণ প্রজন্মের কাছে প্রোগ্রামিংকে জনপ্রিয় করে তোলার উদ্দেশ্য দেশে প্রথমবারের মত বেসরকারি ভাবে আয়োজিত হতে যাচ্ছে বাংলাদেশ আইটি কুইজ এবং প্রোগ্রামিং প্রতিযোগিতা-২০২৫ (বিডিআইকিউপিসি)। কম্পিউটার প্রোগ্রামিংকে শিক্ষার্থীদের কাছে জনপ্রিয় করে তোলা এবং শিক্ষার্থীদের আইটি ভীতি দূর করে দক্ষ তরুণ প্রজন্ম গড়ে তোলাই আমাদের উদ্দেশ্য । উন্নত দেশগুলোতে বর্তমানে কম্পিউটার শিক্ষার প্রতি গুরুত্ব আরোপ করা হচ্ছে। আনন্দের বিষয় এইযে, আমাদের দেশেও বর্তমানে আইসিটি শিক্ষার প্রতি সরকারি এবং বেসরকারি গুরুত্ব দেয়া হচ্ছে। এরই ধারাবাহিকতায় , বিডিআইকিউপিসি কমিটি এই বছর থেকে আয়োজন শুরু করছে বাংলাদেশ আইটি কুইজ এবং প্রোগ্রামিং প্রতিযোগিতা। শিক্ষার্থী ও অভিভাবকদের আন্তরিক প্রচেষ্টা ও সহযোগিতাই আমাদের উদ্দেশ্য সফল করবে। 
                </p>
                <div class="mt-4">
                    <a href="about.php" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
        </div>
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
<section class="faq-section py-5 bg-light ">
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