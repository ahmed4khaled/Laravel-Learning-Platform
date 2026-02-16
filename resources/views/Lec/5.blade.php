@extends('layout.app')
@include('layout.navbar')
@section('content')
      <main class="main">
        <section class="subscription section" id="subscription">
            <div class="container">
                <div class="section-header">
                    <span class="section-badge">الاشتراكات</span>
                    <h2 class="section-title">
                    
                        <span>خطط اشتراك الصف الثالث الثانوي</span>
                      
                    </h2>
                    <p class="section-subtitle">اختر الخطة المناسبة لك وابدأ التعلم فوراً!</p>
                </div>

                <div class="subscription-grid">
                    <!-- Per-Lesson Plan -->
                    <div class="subscription-card animate-on-load animate-delay-1">
                        <div class="card-header">
                            <h3 class="card-title">الاحياء </h3>
                           
                        </div>
                        <div class="card-content">
                   
                              
  <a href="{{ route('Lec.3', 3)}}" class="btn btn-primary subscribe-btn" data-subscription-type="per-lesson">
                                <span> يلا بينا</span>
                                <i class="ri-arrow-left-line"></i>
                                                    

             
                           




                                <div class="btn-glow">



                                </div>
</a>
                        </div>
                    </div>

                    <!-- Monthly Plan -->
                    <div class="subscription-card featured animate-on-load animate-delay-2">
                        <div class="card-header">
                            <h3 class="card-title"> علوم الارض</h3>
                           
                        </div>
                        <div class="card-content">
                            
                          
                                   <a href="{{ route('Lec.1', [3, 8]) }}" class="btn btn-primary subscribe-btn" data-subscription-type="monthly">
                              


                                <span>يلا بينا</span>
                                <i class="ri-arrow-left-line"></i>
                                <div class="btn-glow"></div>
</a>
                        </div>
                    </div>
            
                
                </div>
            </div>
        </section>
    </main>
    @endsection
