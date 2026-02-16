

document.addEventListener("DOMContentLoaded", () => {
  // Initialize all components
  initializeLoading()
  initializeNavigation()
  initializeScrollEffects()
  // initializeAnimations()
  initializeFormHandling()
  // initializePhysicsBackground()
  initializeMobileOptimizations()
  enhanceSitePerformance() // Add performance optimizations
})

// Loading Screen Management
function initializeLoading() {
  const loadingScreen = document.getElementById("loadingScreen")

  // Simulate loading time
  setTimeout(() => {
    loadingScreen.classList.add("hidden")

    // Remove loading screen after transition
    setTimeout(() => {
      loadingScreen.style.display = "none"
    }, 500)
  }, 2000)
}

// Enhanced Navigation
function initializeNavigation() {
  const header = document.querySelector(".header")
  const mobileMenuBtn = document.getElementById("mobileMenuBtn")
  const navMenu = document.getElementById("navMenu")
  const navLinks = document.querySelectorAll(".nav-link")

  // Scroll header effect
  let lastScrollTop = 0
  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop

    if (scrollTop > 100) {
      header.classList.add("scrolled")
    } else {
      header.classList.remove("scrolled")
    }

    lastScrollTop = scrollTop
  })

  // Mobile menu toggle
  if (mobileMenuBtn && navMenu) {
    mobileMenuBtn.addEventListener("click", () => {
      mobileMenuBtn.classList.toggle("active")
      navMenu.classList.toggle("active")
    })
  }

  // Smooth scrolling for navigation links
  navLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      const targetId = link.getAttribute("href")
      const targetSection = document.querySelector(targetId)

      if (targetSection) {
        const headerHeight = header.offsetHeight
        const targetPosition = targetSection.offsetTop - headerHeight

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        })

        // Close mobile menu if open
        if (navMenu.classList.contains("active")) {
          mobileMenuBtn.classList.remove("active")
          navMenu.classList.remove("active")
        }

        // Update active link
        navLinks.forEach((l) => l.classList.remove("active"))
        link.classList.add("active")
      }
    })
  })

  // Update active navigation based on scroll position
  window.addEventListener("scroll", updateActiveNavigation)
}

function updateActiveNavigation() {
  const sections = document.querySelectorAll("section[id]")
  const navLinks = document.querySelectorAll(".nav-link")
  const scrollPosition = window.scrollY + 200

  sections.forEach((section) => {
    const sectionTop = section.offsetTop
    const sectionHeight = section.offsetHeight
    const sectionId = section.getAttribute("id")

    if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
      navLinks.forEach((link) => {
        link.classList.remove("active")
        if (link.getAttribute("href") === `#${sectionId}`) {
          link.classList.add("active")
        }
      })
    }
  })
}

// Enhanced Scroll Effects with Performance Optimizations
function initializeScrollEffects() {
  const progressBar = document.getElementById("progressBar")

  // Scroll progress bar with optimized performance
  const updateProgressBar = throttle(() => {
    const scrollTop = window.pageYOffset
    const docHeight = document.documentElement.scrollHeight - window.innerHeight
    const scrollPercent = (scrollTop / docHeight) * 100

    if (progressBar) {
      progressBar.style.width = scrollPercent + "%"
    }
  }, 16) // 60fps

  // Use passive scroll listener for better performance
  window.addEventListener("scroll", updateProgressBar, { passive: true })
  
  // Optimize scroll performance on mobile
  if (window.innerWidth <= 768) {
    const updateProgressBarMobile = throttle(() => {
      const scrollTop = window.pageYOffset
      const docHeight = document.documentElement.scrollHeight - window.innerHeight
      const scrollPercent = (scrollTop / docHeight) * 100

      if (progressBar) {
        progressBar.style.width = scrollPercent + "%"
      }
    }, 32) // 30fps on mobile for better performance
    
    window.removeEventListener("scroll", updateProgressBar)
    window.addEventListener("scroll", updateProgressBarMobile, { passive: true })
  }

  // Scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate-in")
      }
    })
  }, observerOptions)

  // Observe all scroll-animate elements
  document
    .querySelectorAll(".scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale")
    .forEach((el) => {
      observer.observe(el)
    })
}

// Enhanced Animations
function initializeAnimations() {
  // Parallax effect for physics background
  window.addEventListener("scroll", () => {
    const scrolled = window.pageYOffset
    const parallaxElements = document.querySelectorAll(".physics-background > *")

    parallaxElements.forEach((element, index) => {
      const speed = 0.1 + index * 0.05
      const yPos = -(scrolled * speed)
      element.style.transform = `translateY(${yPos}px)`
    })
  })

  // Enhanced hover effects for cards
  const cards = document.querySelectorAll(".class-card, .contact-card, .about-card")
  cards.forEach((card) => {
    card.addEventListener("mouseenter", () => {
      card.style.transform = "translateY(-15px) scale(1.02)"
    })

    card.addEventListener("mouseleave", () => {
      card.style.transform = "translateY(0) scale(1)"
    })
  })

  // Animated counters for statistics
  const counters = document.querySelectorAll(".card-number")
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        animateCounter(entry.target)
        counterObserver.unobserve(entry.target)
      }
    })
  })

  counters.forEach((counter) => {
    counterObserver.observe(counter)
  })
}

function animateCounter(element) {
  const target = Number.parseInt(element.textContent.replace(/\D/g, ""))
  const duration = 2000
  const step = target / (duration / 16)
  let current = 0

  const timer = setInterval(() => {
    current += step
    if (current >= target) {
      current = target
      clearInterval(timer)
    }

    const suffix = element.textContent.replace(/\d/g, "").replace(/\+/g, "")
    element.textContent = Math.floor(current) + suffix
  }, 16)
}

// Enhanced Form Handling
function initializeFormHandling() {
  const contactForm = document.getElementById("contactForm")

  if (contactForm) {
    contactForm.addEventListener("submit", handleFormSubmission)
  }

  // Enhanced form validation
  const formInputs = document.querySelectorAll("input, select, textarea")
  formInputs.forEach((input) => {
    input.addEventListener("blur", validateField)
    input.addEventListener("focus", clearFieldError)
  })
}



function validateField(e) {
  const field = e.target
  const value = field.value.trim()

  // Remove existing error
  clearFieldError(e)

  // Validation rules
  if (field.hasAttribute("required") && !value) {
    showFieldError(field, "هذا الحقل مطلوب")
    return false
  }

  if (field.type === "email" && value && !isValidEmail(value)) {
    showFieldError(field, "يرجى إدخال بريد إلكتروني صحيح")
    return false
  }

  if (field.type === "tel" && value && !isValidPhone(value)) {
    showFieldError(field, "يرجى إدخال رقم هاتف صحيح")
    return false
  }

  return true
}

function showFieldError(field, message) {
  const formGroup = field.closest(".form-group")
  const errorElement = document.createElement("div")
  errorElement.className = "field-error"
  errorElement.textContent = message
  errorElement.style.color = "var(--danger-color)"
  errorElement.style.fontSize = "14px"
  errorElement.style.marginTop = "5px"

  formGroup.appendChild(errorElement)
  field.style.borderColor = "var(--danger-color)"
}

function clearFieldError(e) {
  const field = e.target
  const formGroup = field.closest(".form-group")
  const errorElement = formGroup.querySelector(".field-error")

  if (errorElement) {
    errorElement.remove()
  }

  field.style.borderColor = ""
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  return emailRegex.test(email)
}

function isValidPhone(phone) {
  const phoneRegex = /^[+]?[0-9\s\-$$$$]{10,}$/
  return phoneRegex.test(phone)
}

function showNotification(message, type = "info") {
  const notification = document.createElement("div")
  notification.className = `notification notification-${type}`
  notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${type === "success" ? "check-circle" : "info-circle"}"></i>
            <span>${message}</span>
            <button class="notification-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `

  // Styles
  notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${type === "success" ? "var(--success-color)" : "var(--primary-color)"};
        color: white;
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: var(--shadow-lg);
        z-index: 10000;
        transform: translateX(400px);
        transition: transform 0.2s ease;
        max-width: 350px;
    `

  document.body.appendChild(notification)

  // Show notification
  setTimeout(() => {
    notification.style.transform = "translateX(0)"
  }, 100)

  // Auto hide
  setTimeout(() => {
    hideNotification(notification)
  }, 5000)

  // Close button
  const closeBtn = notification.querySelector(".notification-close")
  closeBtn.addEventListener("click", () => hideNotification(notification))
}

function hideNotification(notification) {
  notification.style.transform = "translateX(400px)"
  setTimeout(() => {
    if (notification.parentNode) {
      notification.parentNode.removeChild(notification)
    }
  }, 300)
}

// Enhanced Physics Background
function initializePhysicsBackground() {
  const physicsBackground = document.querySelector(".physics-background")

  if (!physicsBackground) return

  // Dynamic particle generation
  createDynamicParticles()

  // Interactive physics elements
  addPhysicsInteractivity()

  // Performance optimization
  optimizePhysicsPerformance()
}

function createDynamicParticles() {
  const particleContainer = document.createElement("div")
  particleContainer.className = "dynamic-particles"
  particleContainer.style.cssText = `
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    `

  document.querySelector(".physics-background").appendChild(particleContainer)

  // Create floating particles
  for (let i = 0; i < 20; i++) {
    createFloatingParticle(particleContainer, i)
  }
}

function createFloatingParticle(container, index) {
  const particle = document.createElement("div")
  particle.className = "dynamic-particle"

  const size = Math.random() * 4 + 2
  const x = Math.random() * 100
  const y = Math.random() * 100
  const duration = Math.random() * 20 + 10
  const delay = Math.random() * 5

  particle.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        background: radial-gradient(circle, var(--primary-color), var(--secondary-color));
        border-radius: 50%;
        left: ${x}%;
        top: ${y}%;
        animation: dynamicParticleFloat${(index % 3) + 1} ${duration}s ease-in-out infinite ${delay}s;
        box-shadow: 0 0 10px var(--primary-color);
        opacity: 0.7;
    `

  container.appendChild(particle)
}

function addPhysicsInteractivity() {
  const atoms = document.querySelectorAll(".atom")

  atoms.forEach((atom) => {
    atom.addEventListener("mouseenter", () => {
      atom.style.animationPlayState = "paused"
      atom.style.transform = "scale(1.2)"
    })

    atom.addEventListener("mouseleave", () => {
      atom.style.animationPlayState = "running"
      atom.style.transform = "scale(1)"
    })
  })
}

function optimizePhysicsPerformance() {
  


  // Pause animations when tab is not visible
  document.addEventListener("visibilitychange", () => {
    const physicsElements = document.querySelectorAll(".physics-background *")
    physicsElements.forEach((element) => {
      if (document.hidden) {
        element.style.animationPlayState = "paused"
      } else {
        element.style.animationPlayState = "running"
      }
    })
  })
}

// Mobile Optimizations
function initializeMobileOptimizations() {
  // Touch event optimizations
  if ("ontouchstart" in window) {
    optimizeForTouch()
  }

  // Reduce motion for better performance on mobile
  if (window.innerWidth <= 768) {
    reduceMobileAnimations()
  }

  // Optimize images for mobile
  optimizeMobileImages()

  // Handle orientation changes
  window.addEventListener("orientationchange", handleOrientationChange)
}

function optimizeForTouch() {
  // Add touch feedback for buttons
  const buttons = document.querySelectorAll(".btn, .quick-btn, .nav-link")

  buttons.forEach((button) => {
    button.addEventListener("touchstart", () => {
      button.style.transform = "scale(0.95)"
    })

    button.addEventListener("touchend", () => {
      setTimeout(() => {
        button.style.transform = ""
      }, 150)
    })
  })

  // Prevent zoom on double tap
  let lastTouchEnd = 0
  document.addEventListener(
    "touchend",
    (e) => {
      const now = new Date().getTime()
      if (now - lastTouchEnd <= 300) {
        // e.preventDefault()
      }
      lastTouchEnd = now
    },
    false,
  )
}

function reduceMobileAnimations() {
  // Reduce complex animations on mobile
  const style = document.createElement("style")
  style.textContent = `
        @media (max-width: 768px) {
            .atom, .wave-container, .pendulum, .newtons-cradle, 
            .magnetic-field, .electric-spark, .solar-system {
                animation-duration: 2s !important;
            }
            
            .floating-element, .orbiting-elements, 
            .photo-overlay-effects, .energy-wave {
                display: none !important;
            }
            
            .class-card:hover, .contact-item:hover, 
            .approach-item:hover {
                transform: none !important;
            }

            /* Enhanced mobile progress bar */
            .scroll-progress {
                top: calc(1rem + 2.4rem + 20px) !important;
                height: 3px !important;
            }
            
            /* Reduce GPU usage on mobile */
            * {
                will-change: auto !important;
            }
            
            /* Optimize transitions */
            .class-card, .contact-item, .approach-item {
                transition: none !important;
            }
            
            /* Reduce shadow complexity */
            .class-card, .contact-item, .approach-item, .header {
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
            }
        }

        @media (max-width: 480px) {
            .scroll-progress {
                top: calc(1rem + 2.4rem + 20px) !important;
                height: 2px !important;
            }

            .physics-background * {
                animation-duration: 2s !important;
            }

            .loading-screen * {
                animation-duration: 1s !important;
            }
            
            /* Disable most animations on very small screens */
            .atom, .wave-container, .pendulum, .newtons-cradle,
            .magnetic-field, .electric-spark, .solar-system,
            .dna-helix, .quantum-field {
                animation: none !important;
            }
            
            /* Reduce backdrop blur on mobile for better performance */
            .header {
                backdrop-filter: blur(10px) !important;
            }
        }
        
        /* High DPI display optimizations */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .scroll-progress {
                transform: translateX(-50%) scale(0.5);
                transform-origin: center;
            }
        }
    `
  document.head.appendChild(style)
}

function optimizeMobileImages() {
  const images = document.querySelectorAll("img")

  images.forEach((img) => {
    // Add loading="lazy" for better performance
    img.setAttribute("loading", "lazy")

    // Optimize image rendering
    img.style.imageRendering = "auto"

    // Handle image load errors
    img.addEventListener("error", () => {
      img.style.display = "none"
    })
  })
}

// Enhanced Performance Optimizations
function enhanceSitePerformance() {
  // Use requestAnimationFrame for smooth animations
  const smoothScroll = (target) => {
    const start = window.pageYOffset
    const targetPosition = target.offsetTop - 100
    const distance = targetPosition - start
    const duration = 1000
    let startTime = null

    function animation(currentTime) {
      if (startTime === null) startTime = currentTime
      const timeElapsed = currentTime - startTime
      const run = ease(timeElapsed, start, distance, duration)
      window.scrollTo(0, run)
      if (timeElapsed < duration) requestAnimationFrame(animation)
    }

    function ease(t, b, c, d) {
      t /= d / 2
      if (t < 1) return c / 2 * t * t + b
      t--
      return -c / 2 * (t * (t - 2) - 1) + b
    }

    requestAnimationFrame(animation)
  }

  // Optimize scroll performance
  let ticking = false
  const updateOnScroll = () => {
    if (!ticking) {
      requestAnimationFrame(() => {
        // Update scroll-based animations here
        ticking = false
      })
      ticking = true
    }
  }

  window.addEventListener("scroll", updateOnScroll, { passive: true })

  // Reduce layout thrashing
  const elements = document.querySelectorAll(".class-card, .contact-item, .approach-item")
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = "1"
        entry.target.style.transform = "translateY(0)"
      }
    })
  }, { threshold: 0.1 })

  elements.forEach((el) => {
    el.style.opacity = "0"
    el.style.transform = "translateY(20px)"
            el.style.transition = "opacity 0.3s ease, transform 0.3s ease"
    observer.observe(el)
  })


}

function handleOrientationChange() {
  // Recalculate layouts after orientation change
  setTimeout(() => {
    window.dispatchEvent(new Event("resize"))

    // Refresh scroll animations
    const scrollElements = document.querySelectorAll(".scroll-animate")
    scrollElements.forEach((el) => {
      if (el.getBoundingClientRect().top < window.innerHeight) {
        el.classList.add("animate-in")
      }
    })
  }, 500)
}

// Utility Functions
function debounce(func, wait) {
  let timeout
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout)
      func(...args)
    }
    clearTimeout(timeout)
    timeout = setTimeout(later, wait)
  }
}

function throttle(func, limit) {
  let inThrottle
  return function () {
    const args = arguments
    
    if (!inThrottle) {
      func.apply(this, args)
      inThrottle = true
      setTimeout(() => (inThrottle = false), limit)
    }
  }
}



// Add dynamic keyframes for mobile particles
const dynamicStyles = document.createElement("style")
dynamicStyles.textContent = `
    @keyframes dynamicParticleFloat1 {
        0%, 100% { transform: translate(0, 0) rotate(0deg); opacity: 0.7; }
        25% { transform: translate(30px, -40px)  rotate(90deg); opacity: 1; }
        50% { transform: translate(-20px, -60px) rotate(180deg); opacity: 0.8; }
        75% { transform: translate(-40px, -20px) rotate(270deg); opacity: 1; }
    }
    
    @keyframes dynamicParticleFloat2 {
        0%, 100% { transform: translate(0, 0) rotate(0deg); opacity: 0.6; }
        33% { transform: translate(40px, 30px) rotate(120deg); opacity: 1; }
        66% { transform: translate(-30px, 50px) rotate(240deg); opacity: 0.9; }
    }
    
    @keyframes dynamicParticleFloat3 {
        0%, 100% { transform: translate(0, 0) rotate(0deg); opacity: 0.8; }
        50% { transform: translate(50px, -30px) rotate(180deg); opacity: 1; }
    }
    

`
document.head.appendChild(dynamicStyles)

// Enhanced scroll performance with additional optimizations
const optimizedScroll = throttle(() => {
  updateActiveNavigation()
}, 100)

window.addEventListener("scroll", optimizedScroll)

// Performance optimizations for reduced lag
let lastScrollTime = 0;
const scrollThrottle = 8; // ~120fps for faster response

// Throttled scroll handler for progress bar
function throttledScrollHandler() {
  const now = Date.now();
  if (now - lastScrollTime >= scrollThrottle) {
    updateScrollProgress();
    lastScrollTime = now;
  }
}

// Optimized scroll progress
function updateScrollProgress() {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const docHeight = document.documentElement.scrollHeight - window.innerHeight;
  const scrollPercent = (scrollTop / docHeight) * 100;
  
  const progressBar = document.getElementById('progressBar');
  if (progressBar) {
    progressBar.style.width = scrollPercent + '%';
  }
}



// Optimized scroll animations with reduced lag
function handleScrollAnimations() {
  const elements = document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale');
  
  elements.forEach(element => {
    const rect = element.getBoundingClientRect();
    const windowHeight = window.innerHeight;
    
    if (rect.top < windowHeight * 0.8) {
      element.classList.add('animate-in');
    }
  });
}

// Debounced scroll handler to reduce lag
let scrollTimeout;
function debouncedScrollHandler() {
  clearTimeout(scrollTimeout);
  scrollTimeout = setTimeout(() => {
    handleScrollAnimations();
  }, 50);
}

// Optimized header scroll effect
function handleHeaderScroll() {
  const header = document.querySelector('.header');
  if (header) {
    if (window.scrollY > 100) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  }
}

// Add optimized event listeners
window.addEventListener("scroll", throttledScrollHandler);
window.addEventListener("scroll", debouncedScrollHandler);
window.addEventListener("scroll", handleHeaderScroll);



// Preload critical resources
function preloadCriticalResources() {
  const criticalImages = ["/placeholder.svg?height=380&width=240", "/placeholder.svg?height=400&width=240"]

  criticalImages.forEach((src) => {
    const link = document.createElement("link")
    link.rel = "preload"
    link.as = "image"
    link.href = src
    document.head.appendChild(link)
  })
}

preloadCriticalResources()

// Service Worker registration for offline support
if ("serviceWorker" in navigator) {
  window.addEventListener("load", () => {
    navigator.serviceWorker
      .register("/sw.js")
      .then((registration) => {
        console.log("SW registered: ", registration)
      })
      .catch((registrationError) => {
        console.log("SW registration failed: ", registrationError)
      })
  })
}

// Enhanced accessibility
function initializeAccessibility() {
  // Add skip to content link
  const skipLink = document.createElement("a")
  skipLink.href = "#home"
  skipLink.textContent = "تخطي إلى المحتوى الرئيسي"
  skipLink.className = "skip-link"
  skipLink.style.cssText = `
        position: absolute;
        top: -40px;
        left: 6px;
        background: var(--primary-color);
        color: white;
        padding: 8px;
        text-decoration: none;
        border-radius: 4px;
        z-index: 10000;
        transition: top 0.2s;
    `

  skipLink.addEventListener("focus", () => {
    skipLink.style.top = "6px"
  })

  skipLink.addEventListener("blur", () => {
    skipLink.style.top = "-40px"
  })

  document.body.insertBefore(skipLink, document.body.firstChild)

  // Enhance keyboard navigation
  const focusableElements = document.querySelectorAll(
    'a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])',
  )

  focusableElements.forEach((element) => {
    element.addEventListener("focus", () => {
      element.style.outline = "2px solid var(--primary-color)"
      element.style.outlineOffset = "2px"
    })

    element.addEventListener("blur", () => {
      element.style.outline = ""
      element.style.outlineOffset = ""
    })
  })
}

initializeAccessibility()

console.log("🎓 Physics Teacher Website Loaded Successfully!")
console.log("📱 Mobile optimizations active")
console.log("⚡ Performance monitoring enabled")
console.log("🚀 Animations and transitions significantly sped up for faster performance")
console.log("♿ Accessibility features enabled")

