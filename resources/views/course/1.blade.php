@extends('layout.app')
@include('layout.navbar')

@section('content')
<?php
$name = $info['name'];
$links = preg_split('/(~)/', $info['link0']);
$names = preg_split('/(-)/', $info['name0']);
$link = $links[$num];
?>

<style>
/* Modern Design System */
:root {
  --primary: #667eea;
  --primary-dark: #764ba2;
  --success: #48bb78;
  --success-dark: #38a169;
  --danger: #e53e3e;
  --warning: #ed8936;
  --gray-50: #f8fafc;
  --gray-100: #f1f5f9;
  --gray-200: #e2e8f0;
  --gray-500: #64748b;
  --gray-700: #334155;
  --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
  --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
  --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
}

/* Base Styles */
.lecture-container {
    margin-top: 5rem;
  min-height: 100vh;
  padding: 80px 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Header Styles */
.lecture-header {
  text-align: center;
  margin-bottom: 60px;
}

.lecture-badge {
  display: inline-block;
  padding: 10px 25px;
  background: linear-gradient(90deg, var(--primary), var(--primary-dark));
  color: white;
  border-radius: 50px;
  font-size: 14px;
  font-weight: 600;
  margin-bottom: 25px;
  box-shadow: var(--shadow-md);
  transition: all 0.3s ease;
}

.lecture-title {
  font-size: 2.8rem;
  font-weight: 800;
  color: var(--gray-700);
  margin-bottom: 15px;
  line-height: 1.2;
}

.lecture-subtitle {
  font-size: 1.2rem;
  color: var(--gray-500);
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.7;
}

/* Toggle Button */
.toggle-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 15px 30px;
  background: linear-gradient(90deg, var(--success), var(--success-dark));
  color: white;
  border: none;
  border-radius: 50px;
  font-weight: 600;
  font-size: 1.1rem;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: var(--shadow-md);
  margin: 20px auto;
}

.toggle-btn:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-lg);
}

/* Content Container */
.content-box {
  background: white;
  border-radius: 20px;
  padding: 30px;
  box-shadow: var(--shadow-md);
  margin-top: 30px;
  border: 1px solid var(--gray-200);
  transition: all 0.3s ease;
}

/* Video Styles */
.video-wrapper {
  position: relative;
  padding-top: 56.25%;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: var(--shadow-md);
  margin-bottom: 25px;
}

.video-wrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: none;
}

/* Parts List */
.parts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
  margin-top: 40px;
}

.part-card {
  background: white;
  border-radius: 15px;
  padding: 20px;
  transition: all 0.3s ease;
  border: 1px solid var(--gray-200);
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 15px;
}

.part-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-lg);
  border-color: var(--primary);
}

.part-card.active {
  border-left: 4px solid var(--primary);
  background: var(--gray-50);
}

.part-icon {
  font-size: 1.5rem;
  color: var(--primary);
}

.part-title {
  font-size: 1.2rem;
  font-weight: 600;
  color: var(--gray-700);
  margin: 0;
}

/* Exam Section */
.exam-section {
  background: white;
  border-radius: 20px;
  padding: 30px;
  box-shadow: var(--shadow-md);
}

/* Download Button */
.download-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: white;
  color: var(--primary);
  border: 1px solid var(--gray-200);
  border-radius: 8px;
  font-weight: 500;
  transition: all 0.3s ease;
}

.download-btn:hover {
  background: var(--gray-50);
  color: var(--primary-dark);
}

/* Loading State */
.loading-spinner {
  width: 40px;
  height: 40px;
  border: 4px solid var(--gray-200);
  border-top: 4px solid var(--primary);
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin: 0 auto;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Questions Section */
.questions-section {
  margin-top: 50px;
  background: white;
  border-radius: 20px;
  padding: 30px;
  box-shadow: var(--shadow-md);
}

.section-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--gray-700);
  margin-bottom: 25px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.question-form {
  margin-bottom: 30px;
}

.question-input {
  width: 100%;
  padding: 15px;
  border: 1px solid var(--gray-200);
  border-radius: 10px;
  font-size: 1rem;
  margin-bottom: 15px;
  transition: all 0.3s ease;
}

.question-input:focus {
  border-color: var(--primary);
  outline: none;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.submit-btn {
  background: linear-gradient(90deg, var(--primary), var(--primary-dark));
  color: white;
  border: none;
  border-radius: 8px;
  padding: 12px 25px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

.question-list {
  margin-top: 30px;
}

.question-item {
  padding: 20px;
  border-radius: 10px;
  background: var(--gray-50);
  margin-bottom: 20px;
}

.question-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.question-user {
  font-weight: 600;
  color: var(--gray-700);
}

.question-date {
  font-size: 0.9rem;
  color: var(--gray-500);
}

.question-text {
  margin-bottom: 15px;
  line-height: 1.6;
}

.answer-section {
  padding: 15px;
  background: white;
  border-radius: 8px;
  margin-top: 15px;
  border-left: 3px solid var(--success);
}

.answer-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.answer-label {
  background: var(--success);
  color: white;
  padding: 3px 10px;
  border-radius: 4px;
  font-size: 0.8rem;
  font-weight: 600;
}

.no-answers {
  font-style: italic;
  color: var(--gray-500);
  padding: 10px 0;
}

/* Pagination Styles */
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 30px;
  gap: 10px;
}

.pagination-btn {
  padding: 8px 16px;
  border: 1px solid var(--gray-200);
  background: white;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 500;
}

.pagination-btn:hover:not(.disabled) {
  background: var(--gray-100);
  border-color: var(--gray-300);
}

.pagination-btn.active {
  background: var(--primary);
  color: white;
  border-color: var(--primary);
}

.pagination-btn.disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.questions-count {
  text-align: center;
  margin-top: 15px;
  color: var(--gray-500);
  font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  .lecture-title {
    font-size: 2.2rem;
  }
  
  .parts-grid {
    grid-template-columns: 1fr;
  }
  
  .content-box, .exam-section, .questions-section {
    padding: 20px;
  }
  
  .pagination {
    flex-wrap: wrap;
  }
}

@media (max-width: 480px) {
  .lecture-container {
    padding: 60px 0;
  }
  
  .lecture-title {
    font-size: 1.8rem;
  }
  
  .toggle-btn {
    padding: 12px 24px;
    font-size: 1rem;
  }
  
  .section-title {
    font-size: 1.5rem;
  }
  
  .pagination-btn {
    padding: 6px 12px;
    font-size: 0.9rem;
  }
}
</style>

<main class="lecture-container">
    <div class="container">
        <div class="lecture-header">
            <span class="lecture-badge">تفاصيل المحاضرة</span>
            <h1 class="lecture-title">{{ $name }}</h1>
            <p class="lecture-subtitle">استكشف محتوى المحاضرة التعليمي بكل سهولة ويسر</p>
            
            <button class="toggle-btn" id="toggleLectureBtn">
                <span>عرض محتوى المحاضرة</span>
                <i class="ri-arrow-down-s-line"></i>
            </button>
        </div>
        <div class="content-box" id="lectureContent" style="display: none;">
            <div id="lectureMainContent">
                @if ($result_exam==null &&$info['exam_id']!=null)
                    <div class="exam-section">
                        <div class="exam">
                            @livewire('exams', ['examId' => $info['exam_id'],'grade'=> $info['grade'],'lec_id'=> $lec])
                        </div>
                    </div>
                @else
                    <div class="video-section">
                        <div class="video-wrapper">
                            <iframe src="{{ $link }}" allowfullscreen></iframe>
                        </div>
                        <a href="{{ $info['description'] }}" class="download-btn">
                            <i class="ri-file-download-line"></i> ملفات المحاضرة
                        </a>
                    </div>
            </div>

            <div class="parts-grid">
                @foreach ($names as $index => $name)
                    <div class="part-card {{ $index == $num ? 'active' : '' }}" data-part="{{ $index }}">
                        <i class="ri-video-line part-icon"></i>
                        <h3 class="part-title">{{ $name }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
   @livewire('AssignmentSubmit', ['lec_id'=> $lec])

        <!-- Questions and Answers Section -->
        <div class="questions-section">
            <h2 class="section-title">
                <i class="ri-question-line"></i>
                الأسئلة والأجوبة
            </h2>
            
            <!-- Question Form -->
            @livewire('questions-lec', ['lectureId' => $lec])
        </div>
                @endif

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleLectureBtn');
    const lectureContent = document.getElementById('lectureContent');
    const lectureParts = document.querySelectorAll('.part-card');
    
    const lectureData = {
        links: @json($links),
        names: @json($names),
        info: @json($info),
        lec: @json($lec),
        std: @json($std)
    };

    // تابع لتبديل عرض/إخفاء المحتوى
    function toggleLectureContent() {
        const isHidden = lectureContent.style.display === 'none';
        
        lectureContent.style.display = isHidden ? 'block' : 'none';
        toggleBtn.querySelector('span').textContent = isHidden ? 
            'إخفاء محتوى المحاضرة' : 'عرض محتوى المحاضرة';
        toggleBtn.querySelector('i').className = isHidden ? 
            'ri-arrow-up-s-line' : 'ri-arrow-down-s-line';
        
        // حفظ حالة العرض في localStorage
        localStorage.setItem('lectureContentVisible', isHidden ? 'true' : 'false');
    }

    // تابع لتحميل محتوى الجزء المحدد
    function loadLecturePart(partIndex) {
        // تحديث الحالة النشطة
        lectureParts.forEach(p => p.classList.remove('active'));
        event.currentTarget.classList.add('active');
        
        // عرض مؤشر التحميل
        const mainContent = document.getElementById('lectureMainContent');
        mainContent.innerHTML = `
            <div style="text-align: center; padding: 40px 0;">
                <div class="loading-spinner"></div>
                <p style="margin-top: 15px;">جاري تحميل المحتوى المطلوب</p>
            </div>
        `;
        
        // محاكاة تحميل المحتوى (يجب استبدالها بالتحميل الفعلي)
        setTimeout(() => {
            if (lectureData.links[partIndex] === '1') {
                loadExamContent();
            } else {
                loadVideoContent(partIndex);
            }
        }, 500);
    }

    // تابع لتحميل محتوى الامتحان
    function loadExamContent() {
        const mainContent = document.getElementById('lectureMainContent');
        
        mainContent.innerHTML = `
        @if ($info['exam_id']!=null)
            <div class="exam-section">
                <div class="exam">
                    @livewire('exams', ['examId' => $info['exam_id'],'grade'=> $info['grade'], 'lec_id'=> $lec])
                </div>
            </div>
  
        @endif
        `;
    }

    // تابع لتحميل محتوى الفيديو
    function loadVideoContent(partIndex) {
        const mainContent = document.getElementById('lectureMainContent');
        mainContent.innerHTML = `
            <div class="video-section">
                <div class="video-wrapper">
                    <iframe src="${lectureData.links[partIndex]}" allowfullscreen></iframe>
                </div>
                <a href="${lectureData.info.description}" class="download-btn">
                    <i class="ri-file-download-line"></i> ملفات المحاضرة
                </a>
            </div>
        `;
    }

    // استعادة حالة العرض من localStorage
    const isContentVisible = localStorage.getItem('lectureContentVisible') === 'true';
    if (isContentVisible) {
        lectureContent.style.display = 'block';
        toggleBtn.querySelector('span').textContent = 'إخفاء محتوى المحاضرة';
        toggleBtn.querySelector('i').className = 'ri-arrow-up-s-line';
    }

    // إضافة معالج الأحداث
    toggleBtn.addEventListener('click', toggleLectureContent);
    
    lectureParts.forEach(part => {
        part.addEventListener('click', function(event) {
            const partIndex = event.currentTarget.dataset.part;
            loadLecturePart(partIndex);
        });
    });

    // إعادة تحميل مكون Livewire عند تبديل الأجزاء
    document.addEventListener('livewire:load', function() {
        lectureParts.forEach(part => {
            part.addEventListener('click', function(event) {
                if (lectureData.links[event.currentTarget.dataset.part] === '1') {
                    setTimeout(() => {
                        Livewire.rescan();
                    }, 100);
                }
            });
        });
    });
});
</script>

@livewireScripts
@endsection