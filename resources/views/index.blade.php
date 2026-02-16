@extends('layout.app')
@section('title')
    Mr/Ahmed Alaa
@endsection

@include('layout.navbar')
@section('content')
  <section class="hero scroll-animate" id="home">
        <div class="hero-bg-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-image">
                    <div class="photo-frame">
                        <div class="photo-glow"></div>
                        <div class="photo-particles">
                            <div class="photo-particle"></div>
                            <div class="photo-particle"></div>
                            <div class="photo-particle"></div>
                            <div class="photo-particle"></div>
                        </div>
                    </div>
                </div>
                
                <h1 class="hero-title">
                    <span class="title-word">أحمد</span>
                    <span class="title-word">علاء</span>
                </h1>
                <p class="hero-subtitle">
                    <span class="subtitle-highlight">معلم فيزياء</span>
                    <span class="subtitle-text">مشهور ومتميز</span>
                </p>
                <p class="hero-description">
                    صاحب الشرح المفصل والمبسط، خبرة واسعة في تدريس الفيزياء للمرحلة الثانوية 
                    مع أسلوب تعليمي متطور وفعال يضمن فهم الطلاب وتفوقهم
                </p>
                
                <div class="hero-badges">
                    <div class="badge badge-star">
                        <i class="fas fa-star"></i>
                        <span>معلم متميز</span>
                        <div class="badge-glow"></div>
                    </div>
                    <div class="badge badge-users">
                        <i class="fas fa-users"></i>
                        <span>+2000 طالب</span>
                        <div class="badge-glow"></div>
                    </div>
                    <div class="badge badge-award">
                        <i class="fas fa-award"></i>
                        <span>خبرة 12+ سنة</span>
                        <div class="badge-glow"></div>
                    </div>
                    <div class="badge badge-success">
                        <i class="fas fa-trophy"></i>
                        <span>نسبة نجاح 98%</span>
                        <div class="badge-glow"></div>
                    </div>
                </div>
                
                <div class="hero-actions">
                    <button class="btn btn-cta btn-primary-cta">
                        <i class="fas fa-phone"></i>
                        <span>كلمنا للحجز</span>
                        <div class="btn-particles">
                            <div class="btn-particle"></div>
                            <div class="btn-particle"></div>
                            <div class="btn-particle"></div>
                        </div>
                    </button>
                    <button class="btn btn-secondary-cta">
                        <i class="fab fa-whatsapp"></i>
                        <span>واتساب</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="hero-scroll-indicator">
            <div class="scroll-arrow">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>
<!-- Enhanced About Teacher Section with Beautiful Animations -->
    <section class="about-teacher scroll-animate" id="about">
        <div class="container">
            <div class="section-header scroll-animate">
                <h2>
                    <span class="section-title-main">عن المعلم</span>
                    <span class="section-title-decoration"></span>
                </h2>
                <p>تعرف على أحمد علاء وخبرته المتميزة في تدريس الفيزياء</p>
            </div>
            
            <div class="about-content">
                <!-- Teacher Profile with Beautiful Animation -->
                <div class="teacher-profile scroll-animate-left">
                    <div class="profile-container">
                        <!-- Animated Background Elements -->
                        <div class="profile-bg-elements">
                            <div class="floating-element element-1">
                                <i class="fas fa-atom"></i>
                            </div>
                            <div class="floating-element element-2">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="floating-element element-3">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div class="floating-element element-4">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="floating-element element-5">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="floating-element element-6">
                                <i class="fas fa-microscope"></i>
                            </div>
                        </div>

                        <!-- Teacher Photo with Advanced Animation -->
                        <div class="teacher-photo-container">
                            <div class="photo-frame-advanced">
                                <div class="photo-border-animation">
                                    <div class="border-segment segment-1"></div>
                                    <div class="border-segment segment-2"></div>
                                    <div class="border-segment segment-3"></div>
                                    <div class="border-segment segment-4"></div>
                                </div>
                                <div class="photo-inner-glow"></div>
                                <img src="{{asset('assest/img/ahmed5.jpg')}}" class="teacher-photo-about">
                                <!-- <div class="photo-overlay-effects">
                                    <div class="effect-particle p-1"></div>
                                    <div class="effect-particle p-2"></div>
                                    <div class="effect-particle p-3"></div>
                                    <div class="effect-particle p-4"></div>
                                    <div class="effect-particle p-5"></div>
                                </div> -->
                            </div>
                            
                            <!-- Orbiting Elements -->
                            <div class="orbiting-elements">
                                <div class="orbit-ring ring-1">
                                    <div class="orbit-item item-1">
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div class="orbit-ring ring-2">
                                    <div class="orbit-item item-2">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                    <div class="orbit-item item-3">
                                        <i class="fas fa-medal"></i>
                                    </div>
                                </div>
                                <div class="orbit-ring ring-3">
                                    <div class="orbit-item item-4">
                                        <i class="fas fa-certificate"></i>
                                    </div>
                                    <div class="orbit-item item-5">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <div class="orbit-item item-6">
                                        <i class="fas fa-gem"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Animated Info Cards -->
                        <div class="info-cards">
                            <div class="info-card card-1">
                                <div class="card-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="card-content">
                                    <span class="card-number">12+</span>
                                    <span class="card-label">سنة خبرة</span>
                                </div>
                                <div class="card-glow-effect"></div>
                            </div>
                            
                            <div class="info-card card-2">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-content">
                                    <span class="card-number">2000+</span>
                                    <span class="card-label">طالب</span>
                                </div>
                                <div class="card-glow-effect"></div>
                            </div>
                            
                            <div class="info-card card-3">
                                <div class="card-icon">
                                    <i class="fas fa-percentage"></i>
                                </div>
                                <div class="card-content">
                                    <span class="card-number">98%</span>
                                    <span class="card-label">نسبة النجاح</span>
                                </div>
                                <div class="card-glow-effect"></div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Teacher Information -->
                <div class="teacher-info scroll-animate-right">
                    <div class="about-card">
                        <div class="card-header">
                            <h3>أحمد علاء محمد</h3>
                            <p class="teacher-title">معلم فيزياء أول - خبرة 12 عام</p>
                        </div>
                        
                        <div class="teacher-description">
                            <p>
                                يتميز أسلوبه التعليمي بالبساطة والوضوح، حيث يحرص على تبسيط المفاهيم المعقدة
                                وربطها بالحياة العملية، مما يساعد الطلاب على فهم الفيزياء بسهولة ومتعة.
                            </p>
                        </div>
                        
                        <div class="teaching-approach">
                            <h4>منهجية التدريس:</h4>
                            <div class="approach-items">
                                <div class="approach-item">
                                    <i class="fas fa-lightbulb"></i>
                                    <span>تبسيط المفاهيم المعقدة</span>
                                </div>
                                <div class="approach-item">
                                    <i class="fas fa-flask"></i>
                                    <span>التطبيق العملي والتجارب</span>
                                </div>
                                <div class="approach-item">
                                    <i class="fas fa-chart-line"></i>
                                    <span>متابعة مستمرة للتقدم</span>
                                </div>
                                <div class="approach-item">
                                    <i class="fas fa-comments"></i>
                                    <span>تفاعل مستمر مع الطلاب</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Classes Section -->
    <section class="classes scroll-animate" id="classes">
        <div class="container">
            <div class="section-header scroll-animate">
                <h2>
                    <span class="section-title-main">المحاضرات المتاحة</span>
                    <span class="section-title-decoration"></span>
                </h2>
                <p>دروس شاملة ومفصلة في الفيزياء للصفين الثاني والثالث الثانوي</p>
            </div>
            <div class="classes-grid">
                <div class="class-card scroll-animate-left">
                    <div class="card-background"></div>
                    <div class="card-icon">
                        <i class="fas fa-book-open"></i>
                        <div class="icon-orbit"></div>
                    </div>
                    <h3>الصف الثاني الثانوي</h3>
                    <p>منهج شامل ومبسط للفيزياء مع شرح تفصيلي لجميع الوحدات والقوانين</p>
                    <div class="card-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>شرح تفصيلي لكل وحدة</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>تمارين وحلول شاملة</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>متابعة مستمرة</span>
                        </div>
                    </div>
                    <a class="btn btn-primary card-btn" href="{{ route('Lec.3', [2]) }}">
                        <i class="fas fa-play"></i>
                        ابدأ التعلم الآن
</a>
                    <div class="card-glow"></div>
                </div>
                
                <div class="class-card scroll-animate-right">
                    <div class="card-background"></div>
                    <div class="card-icon">
                        <i class="fas fa-graduation-cap"></i>
                        <div class="icon-orbit"></div>
                    </div>
                    <h3>الصف الثالث الثانوي</h3>
                    <p>إعداد متقدم للثانوية العامة مع حل نماذج امتحانات وتدريبات مكثفة</p>
                    <div class="card-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>إعداد للثانوية العامة</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>نماذج امتحانات</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>تدريبات مكثفة</span>
                        </div>
                    </div>
                    <a class="btn btn-primary card-btn" href="{{ route('Lec.3', [3]) }}">
                        <i class="fas fa-play"></i>
                        ابدأ التعلم الآن
</a>
                    <div class="card-glow"></div>
                </div>
            </div>
        </div>
    </section>






    <!-- Enhanced Contact Section -->
    <section class="contact-section scroll-animate" id="contact">
        <div class="container">
          
            
           
            
            <div class="quick-contact scroll-animate-scale">
                <h3>تواصل سريع</h3>
                <div class="quick-contact-buttons">
                    <a href="tel:01012345678" class="quick-btn phone-btn">
                        <i class="fas fa-phone"></i>
                        <span>اتصل الآن</span>
                        <div class="btn-glow"></div>
                    </a>
                    <a href="https://wa.me/201012345678" class="quick-btn whatsapp-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>واتساب</span>
                        <div class="btn-glow"></div>
                    </a>
                    <a href="https://t.me/ahmed_physics" class="quick-btn telegram-btn" target="_blank">
                        <i class="fab fa-telegram"></i>
                        <span>تليجرام</span>
                        <div class="btn-glow"></div>
                    </a>
                    <a href="https://facebook.com/ahmed.physics" class="quick-btn facebook-btn" target="_blank">
                        <i class="fab fa-facebook"></i>
                        <span>فيسبوك</span>
                        <div class="btn-glow"></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Support Section -->
    <section class="support scroll-animate">
        <div class="container">
            <div class="support-card scroll-animate-scale">
                <div class="support-icon-container">
                    <i class="fas fa-comments support-icon"></i>
                    <div class="support-icon-glow"></div>
                </div>
                <h3>معاك قلق؟</h3>
                <p>لا تتردد في التواصل معنا لأي استفسار أو مساعدة في المواد الدراسية</p>
                <button class="btn btn-cta support-btn">
                    <i class="fas fa-phone"></i>
                    <span>تواصل معنا الآن</span>
                    <div class="btn-particles">
                        <div class="btn-particle"></div>
                        <div class="btn-particle"></div>
                        <div class="btn-particle"></div>
                    </div>
                </button>
            </div>
        </div>
    </section>
 <div class="loading-screen" id="loadingScreen">
        <div class="loading-content">
            <div class="loading-atom">
                <div class="loading-nucleus"></div>
                <div class="loading-orbit orbit-1">
                    <div class="loading-electron"></div>
                </div>
                <div class="loading-orbit orbit-2">
                    <div class="loading-electron"></div>
                </div>
                <div class="loading-orbit orbit-3">
                    <div class="loading-electron"></div>
                </div>
            </div>
            <h2>أحمد علاء - معلم الفيزياء</h2>
            <div class="loading-bar">
                <div class="loading-progress"></div>
            </div>
        </div>
    </div>
    <style>
        .aaa{
            color: white;
        }
    </style>
@endSection
