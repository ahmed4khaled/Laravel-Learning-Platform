@extends('layout.app')
@include('layout.navbar')

@section('content')
<style>
  /* Physics Background Animation */
body {
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(120, 119, 198, 0.2) 0%, transparent 50%);
    z-index: -1;
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-20px) rotate(1deg); }
    66% { transform: translateY(10px) rotate(-1deg); }
}

/* Floating Particles */
.main::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, rgba(255, 255, 255, 0.3), transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(255, 255, 255, 0.2), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(255, 255, 255, 0.4), transparent),
        radial-gradient(1px 1px at 130px 80px, rgba(255, 255, 255, 0.3), transparent),
        radial-gradient(2px 2px at 160px 30px, rgba(255, 255, 255, 0.2), transparent);
    background-repeat: repeat;
    background-size: 200px 100px;
    animation: sparkle 15s linear infinite;
    pointer-events: none;
    z-index: 1;
}

@keyframes sparkle {
    0% { transform: translateY(0px); }
    100% { transform: translateY(-100px); }
}

/* Section Styles */
.lessons.section {
    padding: 100px 0;
    position: relative;
    z-index: 2;
    margin-top: 5rem;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: 80px;
    position: relative;
}

.section-badge {
    display: inline-block;
    padding: 12px 30px;
    background: rgba(255, 255, 255, 0.15);
    color: white;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 25px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.section-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
}

.section-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 25px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
    border-radius: 2px;
}

.section-subtitle {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.7;
    font-weight: 400;
}

/* Lessons Grid */
.lessons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 40px;
    margin-top: 60px;
}

/* Lesson Card */
.lesson-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    flex-direction: column;
    width: 380px;

}

.lesson-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.lesson-card:hover::before {
    transform: scaleX(1);
}

.lesson-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
}

/* Lesson Thumbnail */
/* Lesson Thumbnail */
.lesson-thumbnail {
    position: relative;
    height: 320px;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.lesson-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
    transform-origin: center;
}

.default-lesson-image {
    width: 80px;
    height: 180px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.default-lesson-image i {
    font-size: 2.5rem;
    color: rgba(255, 255, 255, 0.7);
}

.lesson-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
    backdrop-filter: blur(2px);
}

.lesson-card:hover .lesson-overlay {
    opacity: 1;
}

.lesson-card:hover .lesson-image {
    transform: scale(1.05);
}

.play-icon {
    font-size: 3.5rem;
    color: white;
    transform: scale(0.8);
    transition: all 0.3s ease;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.lesson-card:hover .play-icon {
    transform: scale(1);
}
.lesson-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.lesson-card:hover .lesson-overlay {
    opacity: 1;
}

.play-icon {
    font-size: 3rem;
    color: white;
    transform: scale(0.8);
    transition: all 0.3s ease;
}

.lesson-card:hover .play-icon {
    transform: scale(1);
}

.lesson-card:hover .lesson-image {
    transform: scale(1.1);
}

/* Lesson Content */
.lesson-content {
    padding: 30px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.lesson-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
    line-height: 1.4;
}

.lesson-description {
    margin-bottom: 20px;
    flex-grow: 1;
}

.description-text {
    display: block;
    color: #4a5568;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 15px;
}

.lesson-section {
    display: inline-block;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 15px;
}

/* Lesson Meta */
.lesson-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 10px;
}

.lesson-duration {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #718096;
    font-size: 0.9rem;
    font-weight: 500;
}

.lesson-duration i {
    color: #667eea;
}

.lesson-status {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 20px;
}

.lesson-status.completed {
    background: rgba(72, 187, 120, 0.1);
    color: #38a169;
}

.lesson-status.error {
    background: rgba(245, 101, 101, 0.1);
    color: #e53e3e;
}

/* Purchase Section */
.purchase-section {
    background: rgba(102, 126, 234, 0.05);
    border-radius: 15px;
    padding: 20px;
    margin-top: auto;
}

.price-tag {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    margin-bottom: 20px;
}

.price-amount {
    font-size: 2rem;
    font-weight: 800;
    color: #667eea;
}

.price-currency {
    font-size: 1rem;
    color: #718096;
}

/* Form Styles */
.purchase-form {
    width: 100%;
}

.form-group {
    margin-bottom: 20px;
}

.form-control {
    position: relative;
    width: 100%;
}

.form-control input {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 16px;
    color: #2d3748;
    background: white;
    transition: all 0.3s ease;
    outline: none;
    box-sizing: border-box;
}

.form-control input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

.form-control label {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    color: #718096;
    transition: all 0.3s ease;
    pointer-events: none;
    font-size: 16px;
    font-weight: 500;
    background: white;
    padding: 0 8px;
}

.form-control input:focus + label,
.form-control input:not(:placeholder-shown) + label {
    top: 0;
    left: 15px;
    font-size: 12px;
    color: #667eea;
    font-weight: 600;
}

.form-control label span {
    display: inline-block;
    transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.form-control input:focus + label span,
.form-control input:not(:placeholder-shown) + label span {
    color: #667eea;
    transform: translateY(-2px);
}

.input-border {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.form-control input:focus ~ .input-border {
    transform: scaleX(1);
}

/* Button Styles */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    font-size: 1rem;
    width: 100%;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.btn-primary {
    background: linear-gradient(135deg, #48bb78, #38a169);
    color: white;
}

.btn-purchase {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.btn-register {
    background: linear-gradient(135deg, #ed8936, #dd6b20);
    color: white;
}

.btn:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
    text-decoration: none;
    color: white;
}

.btn-glow {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s ease;
}

.btn:hover .btn-glow {
    left: 100%;
}

/* Progress Bar */
.lesson-progress-bar {
    height: 4px;
    background: #e2e8f0;
    position: relative;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #48bb78, #38a169);
    transition: width 0.8s ease;
    position: relative;
}

.progress-fill::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
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
    .lessons-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    .lesson-card {
        width: 100%;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .lesson-content {
        padding: 25px;
    }
    
    .lesson-thumbnail {
        height: 150px;
    }
    
    .lesson-image {
        width: 60px;
        height: 60px;
    }
    
    .container {
        padding: 0 15px;
    }
}

@media (max-width: 480px) {
    .lessons.section {
        padding: 80px 0;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .lesson-content {
        padding: 20px;
    }
    
    .purchase-section {
        padding: 15px;
    }
    
    .form-control input {
        padding: 12px 15px;
        font-size: 14px;
    }
    
    .btn {
        padding: 12px 25px;
        font-size: 0.9rem;
    }
}

/* Loading States */
.btn.loading {
    pointer-events: none;
    opacity: 0.7;
}

.btn.loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Focus States for Accessibility */
.btn:focus,
.form-control input:focus {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}
.lesson-thumbnail {
    position: relative;
    height: min-content; /* يمكن تعديل الارتفاع حسب الحاجة */
    overflow: hidden;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}



.default-lesson-image {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(255, 255, 255, 0.3);
}
.lesson-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: all 0.5s ease;
    transform-origin: center;
}
.default-lesson-image i {
    font-size: 2.5rem;
    color: rgba(255, 255, 255, 0.7);
}
</style>
<main class="main">
    <section class="lessons section" id="lessons">
        <div class="container">
            <div class="section-header animate-on-load">
                <h2 class="section-title">
                    <span>محتوى الدورة</span>
                </h2>
                <p class="section-subtitle">استكشف الحصص المتاحة </p>
            </div>

            <div class="lessons-grid">
                @foreach ($Lec1 as $item)
                    <div class="lesson-card animate-on-load animate-delay-1">
                   <div class="lesson-thumbnail">
    @if(isset($item['img']) && $item['img'])
        <img src="{{ asset('assest/img/' . $item['img']) }}" alt="{{ $item['title'] }}" class="lesson-image">
    @else
        <div class="default-lesson-image">
            <i class="ri-book-2-line"></i>
        </div>
    @endif
    <div class="lesson-overlay">
        <i class="ri-play-circle-fill play-icon"></i>
    </div>
</div>

                    

                        <div class="lesson-content">
                            <h3 class="lesson-title">{{ $item['title'] }}</h3>
                            
                            <div class="lesson-description">
                                <span class="description-text">
                               <ul>
@foreach (preg_split('/(~)/', $item['description']) as $desc)
    <li>{{ $desc }}</li>
@endforeach
</ul>

                                    
                                
                                
                               </span>
                                <span class="lesson-section">{{ $item['Sec'] }}</span>
                            </div>

                            <div class="lesson-meta">
                                <span class="lesson-duration">
                                    <i class="ri-time-line"></i> 
                                    {{ $item['duration'] ?? null }}
                                </span>
                                
                                @if (session('no') )
                                    <span class="lesson-status error">
                                        <i class="ri-close-circle-line"></i>  
                                        {{ session('no') }}
                                    </span>
                            
                                @elseif (Auth::user() && (DB::table('sells')->where('user_id', Auth::user()['id'])->where('id_lec', $item['id'])->where('std', $std)->where('state', 1)->exists() || $item['price'] == 0))
                                    <span class="lesson-status completed">
                                        <i class="ri-check-double-line"></i> 
                                        تم الشراء
                                    </span>
                                @endif
                            </div>

                            <div class="purchase-section">
                                @if (Auth::user())
                                    @if (DB::table('sells')->where('user_id', Auth::user()['id'])->where('id_lec', $item['id'])->where('std', $std)->where('state', 1)->exists() || $item['price'] == 0)
                                        @switch($item['role'])
                                            @case('1')
                                                <a href="{{ route('course.1', [$std, $item['id'], 0]) }}" class="btn btn-primary watch-lesson-btn">
                                                    <span>مشاهدة الحصة</span>
                                                    <i class="ri-play-fill"></i>
                                                    <div class="btn-glow"></div>
                                                </a>
                                                @break
                                            @case('4')
                                                <a href="{{ route('course.4', [$std, $item['monthly'], $item['id']]) }}" class="btn btn-primary watch-lesson-btn">
                                                    <span>مشاهدة الحصة</span>
                                                    <i class="ri-play-fill"></i>
                                                    <div class="btn-glow"></div>
                                                </a>
                                                @break
                                            @case('8')
                                                <a href="{{ route('course.8', [$std, $item['termely'], $item['id']]) }}" class="btn btn-primary watch-lesson-btn">
                                                    <span>مشاهدة الحصة</span>
                                                    <i class="ri-play-fill"></i>
                                                    <div class="btn-glow"></div>
                                                </a>
                                                @break
                                            @default
                                        @endswitch
                                    @else
                                        <div class="price-tag">
                                            <span class="price-amount">{{ $item['price'] ?? '0' }}</span>
                                            <span class="price-currency">جنيه</span>
                                        </div>
                                        
                                        <form method="POST" action="{{ route('Check.Qr') }}" class="purchase-form">
                                            
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-control">
                                                    <input type="text" name="Buy" id="buy_{{ $item['id'] }}" placeholder=" " required>
                                                    <label for="buy_{{ $item['id'] }}">
                                                        <span style="transition-delay:0ms">كود</span>
                                                        <span style="transition-delay:50ms"> </span>
                                                        <span style="transition-delay:100ms">الشراء</span>
                                                    </label>
                                                    <div class="input-border"></div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="id_lec" value="{{ $item['id'] }}">
                                            <input type="hidden" name="name_lec" value="{{ $item['title'] }}">
                                            <input type="hidden" name="role_lec" value="{{ $item['role'] }}">
                                            <input type="hidden" name="monthly_lec" value="{{ $item['monthly'] }}">
                                            <input type="hidden" name="termely_lec" value="{{ $item['termely'] }}">
                                            <input type="hidden" name="role_lec" value="{{ $item['role'] }}">
                                            <input type="hidden" name="date_exp" value="{{ $item['time'] }}">
                                            <input type="hidden" name="lec_std" value="{{ $std }}">


                                            <button type="submit" name="Open" class="btn btn-purchase">
                                                <span>شراء الحصة</span>
                                                <i class="ri-shopping-cart-line"></i>
                                                <div class="btn-glow"></div>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('register') }}" class="btn btn-register">
                                        <span>إنشاء حساب للشراء</span>
                                        <i class="ri-user-add-line"></i>
                                        <div class="btn-glow"></div>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="lesson-progress-bar">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>


<script>
document.querySelectorAll('[id^="qrForm_"]').forEach(form => {
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalContent = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>جاري المعالجة...</span><i class="ri-loader-4-line"></i>';
        
        try {
            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || 'حدث خطأ أثناء المعالجة');
            }
            
            if (data.success && data.redirect) {
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'تمت العملية بنجاح ولكن لا يوجد عنوان للتحويل');
            }
            
        } catch (error) {
            alert(error.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
        }
    });
});
</script>
@endsection