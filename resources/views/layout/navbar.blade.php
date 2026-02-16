    <!-- Physics Background Animation -->
    <div class="physics-background">
        <!-- Enhanced Atoms -->
        <div class="atom atom-1">
            <div class="nucleus"></div>
            <div class="electron-orbit orbit-1">
                <div class="electron"></div>
            </div>
            <div class="electron-orbit orbit-2">
                <div class="electron"></div>
            </div>
            <div class="electron-orbit orbit-3">
                <div class="electron"></div>
            </div>
            <div class="atom-glow"></div>
        </div>
        <div class="atom atom-2">
            <div class="nucleus"></div>
            <div class="electron-orbit orbit-1">
                <div class="electron"></div>
            </div>
            <div class="electron-orbit orbit-2">
                <div class="electron"></div>
            </div>
            <div class="atom-glow"></div>
        </div>
        <div class="atom atom-3">
            <div class="nucleus"></div>
            <div class="electron-orbit orbit-1">
                <div class="electron"></div>
            </div>
            <div class="electron-orbit orbit-2">
                <div class="electron"></div>
            </div>
            <div class="atom-glow"></div>
        </div>

      
    

        <!-- Enhanced Pendulums -->
        <div class="pendulum pendulum-1">
            <div class="pendulum-string"></div>
            <div class="pendulum-bob"></div>
            <div class="pendulum-shadow"></div>
        </div>
        <div class="pendulum pendulum-2">
            <div class="pendulum-string"></div>
            <div class="pendulum-bob"></div>
            <div class="pendulum-shadow"></div>
        </div>
        <div class="pendulum pendulum-3">
            <div class="pendulum-string"></div>
            <div class="pendulum-bob"></div>
            <div class="pendulum-shadow"></div>
        </div>

        <!-- Enhanced Newton's Cradle -->
        <div class="newtons-cradle">
            <div class="cradle-frame">
                <div class="cradle-ball ball-1">
                    <div class="ball-string"></div>
                    <div class="ball"></div>
                </div>
                <div class="cradle-ball ball-2">
                    <div class="ball-string"></div>
                    <div class="ball"></div>
                </div>
                <div class="cradle-ball ball-3">
                    <div class="ball-string"></div>
                    <div class="ball"></div>
                </div>
                <div class="cradle-ball ball-4">
                    <div class="ball-string"></div>
                    <div class="ball"></div>
                </div>
                <div class="cradle-ball ball-5">
                    <div class="ball-string"></div>
                    <div class="ball"></div>
                </div>
            </div>
            <div class="cradle-base"></div>
        </div>

        <!-- Enhanced Magnetic Field Lines -->
       

        <!-- Enhanced Electric Sparks -->
        <div class="electric-spark spark-1">
            <div class="spark-line"></div>
            <div class="spark-line"></div>
            <div class="spark-line"></div>
            <div class="spark-center"></div>
        </div>
        <div class="electric-spark spark-2">
            <div class="spark-line"></div>
            <div class="spark-line"></div>
            <div class="spark-center"></div>
        </div>
        <div class="electric-spark spark-3">
            <div class="spark-line"></div>
            <div class="spark-line"></div>
            <div class="spark-line"></div>
            <div class="spark-center"></div>
        </div>

        <!-- Enhanced Floating Particles -->
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
        <div class="particle particle-5"></div>
        <div class="particle particle-6"></div>
        <div class="particle particle-7"></div>
        <div class="particle particle-8"></div>

        <!-- Enhanced Floating Formulas -->
        <div class="formula formula-1">E = mc²</div>
        <div class="formula formula-2">F = ma</div>
        <div class="formula formula-3">v = λf</div>
        <div class="formula formula-4">P = IV</div>
        <div class="formula formula-5">ΔE = hf</div>
        <div class="formula formula-6">Q = mcΔT</div>
        <div class="formula formula-7">V = IR</div>

        <!-- Enhanced Light Rays -->
        <div class="light-ray ray-1"></div>
        <div class="light-ray ray-2"></div>
        <div class="light-ray ray-3"></div>
        <div class="light-ray ray-4"></div>

        <!-- Enhanced Solar System -->
        <div class="solar-system">
            <div class="sun"></div>
            <div class="planet-orbit orbit-planet-1">
                <div class="planet planet-1"></div>
            </div>
            <div class="planet-orbit orbit-planet-2">
                <div class="planet planet-2"></div>
            </div>
            <div class="planet-orbit orbit-planet-3">
                <div class="planet planet-3"></div>
            </div>
        </div>

     

        <!-- Quantum Particles -->
        <div class="quantum-field">
            <div class="quantum-particle q-1"></div>
            <div class="quantum-particle q-2"></div>
            <div class="quantum-particle q-3"></div>
            <div class="quantum-particle q-4"></div>
        </div>

     
    </div>

    <!-- Enhanced Modern Header -->
    <header class="header">
        <div class="container">
            <div class="nav-wrapper">
                <!-- Modern Logo -->
                <div class="logo">
                    <div class="logo-container">
                        <div class="logo-icon">
                            <i class="fas fa-atom"></i>
                            <div class="logo-rings">
                                <div class="ring ring-1"></div>
                                <div class="ring ring-2"></div>
                                <div class="ring ring-3"></div>
                            </div>
                        </div>
                        <div class="logo-text">
                            <h1>أحمد علاء</h1>
                            <p>معلم الفيزياء المتميز</p>
                        </div>
                    </div>
                </div>

                <!-- Modern Navigation -->
                <nav class="nav-menu" id="navMenu">
                    <div class="nav-items">
                       
                        <a href="#classes" class="nav-link">
                            <div class="nav-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <span>المحاضرات</span>
                            <div class="nav-indicator"></div>
                        </a>
                        @auth
                        @if (Auth::user() && Auth::user()->role === 'asset' || Auth::user()->role === 'Adm')
                        <a href="{{ route('assistant.questions') }}" class="nav-link">
                            <div class="nav-icon">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <span>منتدى الأسئلة</span>
                            <div class="nav-indicator"></div>
                        </a>
                        @endif
                        @endauth
                     
                
                        <a href="#contact" class="nav-link">
                            <div class="nav-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <span>تواصل معنا</span>
                            <div class="nav-indicator"></div>
                        </a>
                           @if (Auth::user())

                                 <a href="#contact" class="nav-link">
                            <div class="nav-icon">
                                <i class="fas fa-user"></i>
                            </div>
                         <span>  {{ Auth::user()->name }}</span>     
                            <div class="nav-indicator"></div>
                                                  </a>

                          
                        @else
                                <a href="{{route('login')}}" class="nav-link">
                            <div class="nav-icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                         <span>  تسجيل الدخول</span>     
                            <div class="nav-indicator"></div>
                        </a>
                             <a href="{{route('register')}}" class="nav-link">
                            <div class="nav-icon">
<i class="fas fa-user-plus"></i>
                            </div>
                         <span>  انشاء حساب </span>     
                            <div class="nav-indicator"></div>
                        </a>
                        @endif
                 @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endauth

                    </div>
                </nav>

                <!-- Modern Mobile Menu Button -->
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <div class="hamburger">
                        <span class="line line-1"></span>
                        <span class="line line-2"></span>
                        <span class="line line-3"></span>
                    </div>
                </button>
            </div>
        </div>
    </header>