@extends('layout.app')
@include('layout.navbar')
@section('content')

<style>
    /* Subscription Page Styles - Matching Dashboard Grade 2 Design */
:root {
    --dashboard-primary: #6366f1;
    --dashboard-secondary: #8b5cf6;
    --dashboard-success: #10b981;
    --dashboard-warning: #f59e0b;
    --dashboard-danger: #ef4444;
    --dashboard-dark: #1f2937;
    --dashboard-light: #f8fafc;
    --dashboard-white: #ffffff;
    --dashboard-gray-100: #f3f4f6;
    --dashboard-gray-200: #e5e7eb;
    --dashboard-gray-300: #d1d5db;
    --dashboard-gray-400: #9ca3af;
    --dashboard-gray-500: #6b7280;
    --dashboard-gray-600: #4b5563;
    --dashboard-gray-700: #374151;
    --dashboard-gray-800: #1f2937;
    --dashboard-gray-900: #111827;
    --gradient-primary: linear-gradient(135deg, var(--dashboard-primary), var(--dashboard-secondary));
    --gradient-success: linear-gradient(135deg, #10b981, #059669);
    --gradient-warning: linear-gradient(135deg, #f59e0b, #d97706);
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --border-radius: 0.5rem;
    --border-radius-lg: 1rem;
    --border-radius-xl: 1.5rem;
    --border-radius-2xl: 2rem;
    --transition: 0.2s ease;
}

/* Physics Background */
.physics-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    overflow: hidden;
    background: linear-gradient(135deg, var(--dashboard-light) 0%, #e0e7ff 50%, #f3e8ff 100%);
}

.atom {
    position: absolute;
    width: 120px;
    height: 120px;
    animation: float 6s ease-in-out infinite;
}

.atom-1 {
    top: 10%;
    left: 5%;
    animation-delay: 0s;
}

.atom-2 {
    top: 60%;
    right: 10%;
    animation-delay: 3s;
}

.nucleus {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 12px;
    height: 12px;
    background: var(--gradient-primary);
    border-radius: 50%;
    box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
}

.electron-orbit {
    position: absolute;
    top: 50%;
    left: 50%;
    border: 2px solid rgba(99, 102, 241, 0.3);
    border-radius: 50%;
    animation: rotate 4s linear infinite;
}

.orbit-1 {
    width: 60px;
    height: 60px;
    transform: translate(-50%, -50%);
}

.orbit-2 {
    width: 100px;
    height: 100px;
    transform: translate(-50%, -50%);
    animation-duration: 6s;
    animation-direction: reverse;
}

.electron {
    position: absolute;
    top: -4px;
    left: 50%;
    transform: translateX(-50%);
    width: 8px;
    height: 8px;
    background: var(--dashboard-secondary);
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(139, 92, 246, 0.7);
}

.atom-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120px;
    height: 120px;
    background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: pulse 3s ease-in-out infinite;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: var(--dashboard-primary);
    border-radius: 50%;
    animation: drift 8s linear infinite;
}

.particle-1 {
    top: 20%;
    left: 20%;
    animation-delay: 0s;
}

.particle-2 {
    top: 70%;
    left: 80%;
    animation-delay: 2s;
}

.particle-3 {
    top: 40%;
    left: 60%;
    animation-delay: 4s;
}

.formula {
    position: absolute;
    font-size: 14px;
    font-weight: 600;
    color: rgba(99, 102, 241, 0.4);
    animation: fadeInOut 4s ease-in-out infinite;
}

.formula-1 {
    top: 15%;
    right: 20%;
    animation-delay: 0s;
}

.formula-2 {
    bottom: 20%;
    left: 15%;
    animation-delay: 1.5s;
}

.formula-3 {
    top: 50%;
    left: 10%;
    animation-delay: 3s;
}

/* Animations */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes rotate {
    from {
        transform: translate(-50%, -50%) rotate(0deg);
    }
    to {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}

@keyframes pulse {
    0%, 100% {
        opacity: 0.3;
        transform: translate(-50%, -50%) scale(1);
    }
    50% {
        opacity: 0.6;
        transform: translate(-50%, -50%) scale(1.1);
    }
}

@keyframes drift {
    0% {
        transform: translateX(0px) translateY(0px);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateX(100px) translateY(-100px);
        opacity: 0;
    }
}

@keyframes fadeInOut {
    0%, 100% {
        opacity: 0;
        transform: translateY(10px);
    }
    50% {
        opacity: 1;
        transform: translateY(0px);
    }
}

/* Main Styles */
body {
    font-family: 'Segoe UI', Tahoma, Arial, sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Section Header */
.subscription-section {
    padding: 80px 0;
    position: relative;
    z-index: 2;
    margin-top: 5rem;
}

.section-header {
    text-align: center;
    margin-bottom: 60px;
}

.section-badge {
    display: inline-block;
    padding: 10px 25px;
    background: var(--gradient-primary);
    color: white;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 25px;
    box-shadow: 0 4px 16px rgba(99, 102, 241, 0.3);
    transition: all 0.3s ease;
}

.section-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
}

.section-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--dashboard-dark);
    margin-bottom: 25px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: var(--gradient-primary);
    border-radius: 2px;
}

.section-subtitle {
    font-size: 1.3rem;
    color: var(--dashboard-gray-600);
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.7;
    font-weight: 400;
}

/* Subscription Grid */
.subscription-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

/* Subscription Cards */
.subscription-card {
    background: white;
    border-radius: var(--border-radius-2xl);
    padding: 2rem;
    box-shadow: var(--shadow-lg);
    border: 2px solid transparent;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
}

.subscription-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.subscription-card.basic {
    border-color: var(--dashboard-gray-200);
}

.subscription-card.popular {
    border-color: var(--dashboard-primary);
    transform: scale(1.05);
}

.subscription-card.premium {
    border-color: var(--dashboard-secondary);
}

.subscription-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--gradient-primary);
}

.subscription-card.premium::before {
    background: var(--gradient-warning);
}

/* Popular Badge */
.popular-badge {
    position: absolute;
    top: -1px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--gradient-primary);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 0 0 var(--border-radius) var(--border-radius);
    font-size: 12px;
    font-weight: 600;
}

/* Card Header */
.card-header {
    text-align: center;
    margin-bottom: 2rem;
}

.plan-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    margin: 0 auto 1rem;
}

.subscription-card.premium .plan-icon {
    background: var(--gradient-warning);
}

.card-title {
    font-size: 24px;
    font-weight: 700;
    color: var(--dashboard-dark);
    margin-bottom: 0.5rem;
}

.plan-description {
    color: var(--dashboard-gray-600);
    font-size: 14px;
}

/* Card Content */
.card-content {
    text-align: center;
}

.features-list {
    margin-bottom: 2rem;
    text-align: left;
}

.feature {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
    font-size: 14px;
    color: var(--dashboard-gray-700);
}

.feature i {
    font-size: 16px;
    color: var(--dashboard-success);
}

.feature.disabled {
    opacity: 0.5;
}

.feature.disabled i {
    color: var(--dashboard-gray-400);
}

/* Subscribe Button */
.subscribe-btn {
    width: 100%;
    background: var(--gradient-primary);
    color: white;
    border: none;
    padding: 1rem 1.5rem;
    border-radius: var(--border-radius-lg);
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.subscribe-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    text-decoration: none;
    color: white;
}

.subscription-card.premium .subscribe-btn {
    background: var(--gradient-warning);
}

.subscribe-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.subscribe-btn:hover::before {
    left: 100%;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-on-load {
    animation: fadeInUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    opacity: 0;
}

.animate-delay-1 { animation-delay: 0.2s; }
.animate-delay-2 { animation-delay: 0.4s; }
.animate-delay-3 { animation-delay: 0.6s; }

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .subscription-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .subscription-card.popular {
        transform: none;
    }
    
    .subscription-card {
        padding: 1.5rem;
    }
    
    /* Reduce physics animations on mobile */
    .physics-background .atom {
        animation-duration: 4s;
    }
    
    .physics-background .particle {
        animation-duration: 6s;
    }
    
    .physics-background .formula {
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .subscription-section {
        padding: 60px 0;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .subscription-card {
        padding: 1rem;
    }
    
    .card-title {
        font-size: 20px;
    }
    
    .plan-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: var(--dashboard-primary);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--dashboard-secondary);
}

</style>


    <section class="subscription-section section" id="subscription">
        <div class="container">
            <div class="section-header animate-on-load">
                <span class="section-badge">الاشتراكات</span>
                <h2 class="section-title">
                    @switch($grade)
                        @case('1')
                            <span>خطط اشتراك الصف الأول الثانوي</span>
                            @break
                        @case('2')
                            <span>خطط اشتراك الصف الثاني الثانوي</span>
                            @break
                        @case('3')
                            <span>خطط اشتراك الصف الثالث الثانوي</span>
                            @break
                    @endswitch
                </h2>
                <p class="section-subtitle">اختر الخطة المناسبة لك وابدأ التعلم فوراً!</p>
            </div>

            <div class="subscription-grid">
                <!-- Per-Lesson Plan -->
                <div class="subscription-card basic animate-on-load animate-delay-1">
                    <div class="card-header">
                        <div class="plan-icon">
                            <i class="ri-play-line"></i>
                        </div>
                        <h3 class="card-title">اشتراك بالحصّة</h3>
                        <p class="plan-description">مثالي للمراجعة السريعة</p>
                    </div>
                    
                    <div class="card-content">
                        <div class="features-list">
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>الوصول إلى حصة واحدة</span>
                            </div>
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>ملخصات للحصة</span>
                            </div>
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>تمارين تطبيقية للحصة</span>
                            </div>
                            <div class="feature disabled">
                                <i class="ri-close-line"></i>
                                <span>دعم فني مستمر</span>
                            </div>
                            <div class="feature disabled">
                                <i class="ri-close-line"></i>
                                <span>اختبارات دورية</span>
                            </div>
                        </div>
                        
                        @switch($grade)
                            @case('1')
                                <a href="{{ route('Lec.1', [1, 1]) }}" class="subscribe-btn" data-subscription-type="per-lesson">
                                    <i class="ri-play-fill"></i>
                                    <span>اختر الحصة</span>
                                </a>
                                @break
                            @case('2')
                                <a href="{{ route('Lec.1', [2, 1]) }}" class="subscribe-btn" data-subscription-type="per-lesson">
                                    <i class="ri-play-fill"></i>
                                    <span>اختر الحصة</span>
                                </a>
                                @break
                            @case('3')
                                <a href="{{ route('Lec.1', [3, 1]) }}" class="subscribe-btn" data-subscription-type="per-lesson">
                                    <i class="ri-play-fill"></i>
                                    <span>اختر الحصة</span>
                                </a>
                                @break
                        @endswitch
                    </div>
                </div>

                <!-- Monthly Plan -->
                <div class="subscription-card popular animate-on-load animate-delay-2">
                    <div class="popular-badge">الأكثر شعبية</div>
                    <div class="card-header">
                        <div class="plan-icon">
                            <i class="ri-calendar-line"></i>
                        </div>
                        <h3 class="card-title">اشتراك شهري</h3>
                        <p class="plan-description">الخيار الأمثل للطلاب</p>
                    </div>
                    
                    <div class="card-content">
                        <div class="features-list">
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>الوصول لجميع حصص الشهر</span>
                            </div>
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>ملخصات وواجبات شهرية</span>
                            </div>
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>دعم فني مستمر</span>
                            </div>
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>اختبارات دورية</span>
                            </div>
                            <div class="feature disabled">
                                <i class="ri-close-line"></i>
                                <span>مراجعات نهائية</span>
                            </div>
                        </div>
                        
                        @switch($grade)
                            @case('1')
                                <a href="{{ route('Lec.1', [1, 4]) }}" class="subscribe-btn" data-subscription-type="monthly">
                                    <i class="ri-crown-line"></i>
                                    <span>اختر الشهر</span>
                                </a>
                                @break
                            @case('2')
                                <a href="{{ route('Lec.1', [2, 4]) }}" class="subscribe-btn" data-subscription-type="monthly">
                                    <i class="ri-crown-line"></i>
                                    <span>اختر الشهر</span>
                                </a>
                                @break
                            @case('3')
                                <a href="{{ route('Lec.1', [3, 4]) }}" class="subscribe-btn" data-subscription-type="monthly">
                                    <i class="ri-crown-line"></i>
                                    <span>اختر الشهر</span>
                                </a>
                                @break
                        @endswitch
                    </div>
                </div>

                <!-- Yearly Plan -->
                <div class="subscription-card premium animate-on-load animate-delay-3">
                    <div class="card-header">
                        <div class="plan-icon">
                            <i class="ri-graduation-cap-line"></i>
                        </div>
                        <h3 class="card-title">اشتراك سنوي</h3>
                        <p class="plan-description">للطلاب الجادين في التفوق</p>
                    </div>
                    
                    <div class="card-content">
                        <div class="features-list">
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>الوصول لجميع حصص العام</span>
                            </div>
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>جميع الملخصات والواجبات</span>
                            </div>
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>دعم فني مستمر ومباشر</span>
                            </div>
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>اختبارات ومراجعات نهائية</span>
                            </div>
                            <div class="feature">
                                <i class="ri-check-line"></i>
                                <span>نماذج امتحانات سابقة</span>
                            </div>
                        </div>
                        
                        @switch($grade)
                            @case('1')
                                <a href="{{ route('Lec.1', [1, 8]) }}" class="subscribe-btn" data-subscription-type="yearly">
                                    <i class="ri-star-line"></i>
                                    <span>اشترك الآن</span>
                                </a>
                                @break
                            @case('2')
                                <a href="{{ route('Lec.1', [2, 8]) }}" class="subscribe-btn" data-subscription-type="yearly">
                                    <i class="ri-star-line"></i>
                                    <span>اشترك الآن</span>
                                </a>
                                @break
                            @case('3')
                                <a href="{{ route('Lec.1', [3, 8]) }}" class="subscribe-btn" data-subscription-type="yearly">
                                    <i class="ri-star-line"></i>
                                    <span>اشترك الآن</span>
                                </a>
                                @break
                            @default
                                <a href="{{ route('Lec.1', [1, 8]) }}" class="subscribe-btn" data-subscription-type="yearly">
                                    <i class="ri-star-line"></i>
                                    <span>اشترك الآن</span>
                                </a>
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script >
    // Subscription Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    initializeSubscriptionPage();
    initializeAnimations();
    initializeInteractions();
});

// Initialize Subscription Page
function initializeSubscriptionPage() {
    // Add ripple effect to buttons
    addRippleEffect();
    
    // Initialize card interactions
    initializeCardHovers();
    
    // Setup subscription tracking
    setupSubscriptionTracking();
}

// Add ripple effect to buttons
function addRippleEffect() {
    const buttons = document.querySelectorAll('.subscribe-btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s ease-out;
                pointer-events: none;
            `;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
}

// Initialize card hover effects
function initializeCardHovers() {
    const cards = document.querySelectorAll('.subscription-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            if (this.classList.contains('popular')) {
                this.style.transform = 'scale(1.05)';
            } else {
                this.style.transform = 'translateY(0) scale(1)';
            }
        });
    });
}

// Setup subscription tracking
function setupSubscriptionTracking() {
    const subscribeButtons = document.querySelectorAll('.subscribe-btn');
    
    subscribeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const subscriptionType = this.dataset.subscriptionType;
            const cardTitle = this.closest('.subscription-card').querySelector('.card-title').textContent;
            
            // Add loading state
            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="ri-loader-4-line"></i><span>جاري التحميل...</span>';
            this.style.pointerEvents = 'none';
            
            // Track subscription click
            console.log(`Subscription clicked: ${subscriptionType} - ${cardTitle}`);
            
            // Simulate loading (remove this in production)
            setTimeout(() => {
                this.innerHTML = originalContent;
                this.style.pointerEvents = 'auto';
            }, 1000);
        });
    });
}

// Initialize animations
function initializeAnimations() {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe animated elements
    document.querySelectorAll('.animate-on-load').forEach(element => {
        observer.observe(element);
    });
    
    // Add stagger animation to cards
    const cards = document.querySelectorAll('.subscription-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
    });
}

// Initialize interactions
function initializeInteractions() {
    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });
    
    document.addEventListener('mousedown', function() {
        document.body.classList.remove('keyboard-navigation');
    });
    
    // Add focus styles for keyboard navigation
    const style = document.createElement('style');
    style.textContent = `
        .keyboard-navigation .subscribe-btn:focus {
            outline: 3px solid rgba(99, 102, 241, 0.5);
            outline-offset: 2px;
        }
    `;
    document.head.appendChild(style);
}

// Performance optimizations
document.addEventListener('visibilitychange', () => {
    const animations = document.querySelectorAll('.atom, .particle');
    animations.forEach(element => {
        if (document.hidden) {
            element.style.animationPlayState = 'paused';
        } else {
            element.style.animationPlayState = 'running';
        }
    });
});

// Mobile optimizations
if (window.innerWidth <= 768) {
    // Reduce animation complexity on mobile
    const style = document.createElement('style');
    style.textContent = `
        .atom {
            animation-duration: 4s !important;
        }
        .particle {
            animation-duration: 6s !important;
        }
        .electron-orbit {
            animation-duration: 3s !important;
        }
    `;
    document.head.appendChild(style);
}

console.log('🎓 Subscription page loaded successfully!');
console.log('💳 Subscription system ready');
console.log('📱 Mobile optimizations active');

</script>

@endsection
