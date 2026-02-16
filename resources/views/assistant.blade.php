<!-- resources/views/assistant/questions.blade.php -->
@extends('layout.app')

@section('content')
<div class="assistant-dashboard">
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="fas fa-headset"></i> لوحة مساعد الأسئلة
        </h1>
        
    <form method="GET" action="{{ route('assistant.questions') }}" class="grade-filter" style="display:flex; gap:10px;">
    <!-- فلتر الصفوف -->
    <select name="grade" onchange="this.form.submit()" class="filter-select">
        <option value="all" {{ $grade == 'all' ? 'selected' : '' }}>كل الصفوف</option>
        @foreach($grades as $g)
            <option value="{{ $g }}" {{ $grade == $g ? 'selected' : '' }}>الصف {{ $g }}</option>
        @endforeach
    </select>

    <!-- فلتر الأسئلة -->
    <select name="filter" onchange="this.form.submit()" class="filter-select">
        <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>جميع الأسئلة</option>
        <option value="answered" {{ $filter == 'answered' ? 'selected' : '' }}>الأسئلة المجابة</option>
        <option value="unanswered" {{ $filter == 'unanswered' ? 'selected' : '' }}>الأسئلة غير المجابة</option>
    </select>
</form>

    </div>

    <div class="lectures-container">
        @forelse($lectures as $lecture)
            <div class="lecture-item {{ $selectedLectureId == $lecture->id ? 'active' : '' }}">
                <div class="lecture-header" onclick="toggleLecture('lecture-{{ $lecture->id }}')">
                    <div class="lecture-info">
                        <div class="lecture-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div>
                            <h3 class="lecture-title">{{ $lecture->title }}</h3>
                            <div class="lecture-stats">
                                <span class="stat-item stat-answered">
                                    <i class="fas fa-check-circle"></i> {{ $lecture->answered_questions_count }} مجاب
                                </span>
                                <span class="stat-item stat-unanswered">
                                    <i class="fas fa-question-circle"></i> {{ $lecture->unanswered_questions_count }} غير مجاب
                                </span>
                                <span class="stat-item stat-total">
                                    <i class="fas fa-comments"></i> {{ $lecture->questions_count }} الإجمالي
                                </span>
                            </div>
                        </div>
                    </div>
                    <i class="fas fa-chevron-down lecture-toggle"></i>
                </div>

                <div class="questions-list" id="lecture-{{ $lecture->id }}">
                    @forelse($lecture->questions as $question)
                        <div class="question-item">
                            <div class="question-header">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ substr($question->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="user-name">{{ $question->user->name }}</span>
                                        <span class="question-date">{{ $question->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <span class="question-status {{ $question->status == '1' ? 'status-answered' : 'status-unanswered' }}">
                                    {{ $question->status == '1' ? 'مجاب' : 'غير مجاب' }}
                                </span>
                            </div>
                            
                            <p class="question-content">{{ $question->content }}</p>

                            {{-- صورة السؤال إن وجدت --}}
                            @if($question->image)
                                <div class="question-image">
                                    <img src="{{ asset( $question->image) }}" alt="صورة السؤال">
                                </div>
                            @endif
                            
                            @if($question->status == '1')
                                <div class="answers-list">
                                    @foreach($question->answers as $answer)
                                        <div class="answer-item">
                                            <div class="answer-header">
                                                <div class="user-avatar small bg-green-100 text-green-600">
                                                    {{ substr($answer->user->name, 0, 1) }}
                                                </div>
                                                <span class="answer-user">{{ $answer->user->name }}</span>
                                                <span class="answer-date">{{ $answer->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="answer-content">{{ $answer->content }}</p>

                                            {{-- صورة الإجابة إن وجدت --}}
                                            @if($answer->image)
                                                <div class="answer-image">
                                                    <img src="{{ asset('storage/' . $answer->image) }}" alt="صورة الإجابة">
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('assistant.answers.store') }}" class="answer-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <textarea name="content" class="answer-textarea" rows="3" placeholder="أضف إجابة..." required></textarea>
                                
                                <input type="file" name="image" class="answer-file">
                                
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i> إرسال الإجابة
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="empty-questions">
                            <i class="fas fa-inbox"></i>
                            <p>لا توجد أسئلة في هذه الحصة</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="empty-lectures">
                <i class="fas fa-book-open"></i>
                <p>لا توجد حصص دراسية متاحة</p>
            </div>
        @endforelse
    </div>
</div>

<style>
.question-image img,
.answer-image img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin-top: 0.5rem;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
}

.answer-file {
    display: block;
    margin-top: 0.8rem;
    font-size: 0.85rem;
    color: #475569;
}
/* التنسيقات العامة */
.assistant-dashboard {
    font-family: 'Tajawal', sans-serif;
    background-color: #f8fafc;
    min-height: 100vh;
    padding: 2rem;
    direction: rtl;
}

/* شريط العنوان */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.dashboard-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.dashboard-title i {
    color: #3b82f6;
}

/* فلترة الأسئلة */
.questions-filter {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.filter-select {
    border: 1px solid #cbd5e1;
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    background-color: white;
    cursor: pointer;
    transition: all 0.2s ease;
    min-width: 180px;
}

.filter-select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* قائمة الحصص */
.lectures-container {
    background-color: white;
    border-radius: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.lecture-item {
    border-bottom: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

.lecture-item:last-child {
    border-bottom: none;
}

.lecture-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.2rem;
    cursor: pointer;
    background-color: white;
    transition: background-color 0.2s ease;
}

.lecture-header:hover {
    background-color: #f8fafc;
}

.lecture-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.lecture-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 0.75rem;
    background-color: #e0e7ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #3b82f6;
    font-size: 1.2rem;
}

.lecture-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.3rem;
}

.lecture-stats {
    display: flex;
    gap: 1.5rem;
}

.stat-item {
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.stat-answered {
    color: #10b981;
}

.stat-unanswered {
    color: #ef4444;
}

.stat-total {
    color: #64748b;
}

.lecture-toggle {
    transition: transform 0.2s ease;
}

.lecture-item.active .lecture-toggle {
    transform: rotate(180deg);
}

/* أسئلة الحصة */
.questions-list {
    padding: 1rem;
    background-color: #f8fafc;
    display: none;
}

.lecture-item.active .questions-list {
    display: block;
}

.question-item {
    background-color: white;
    border-radius: 0.75rem;
    padding: 1.2rem;
    margin-bottom: 1rem;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.question-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background-color: #e0e7ff;
    color: #3b82f6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.9rem;
}

.user-avatar.small {
    width: 1.8rem;
    height: 1.8rem;
    font-size: 0.8rem;
}

.user-name {
    font-weight: 500;
    color: #1e293b;
}

.question-date {
    font-size: 0.8rem;
    color: #64748b;
}

.question-status {
    padding: 0.3rem 0.8rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-answered {
    background-color: #dcfce7;
    color: #166534;
}

.status-unanswered {
    background-color: #fee2e2;
    color: #991b1b;
}

.question-content {
    color: #334155;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

/* الإجابات */
.answers-list {
    margin-top: 1.5rem;
    padding-right: 1.5rem;
    border-right: 2px solid #e2e8f0;
}

.answer-item {
    padding: 1rem 0;
    border-bottom: 1px solid #f1f5f9;
}

.answer-item:last-child {
    border-bottom: none;
}

.answer-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.answer-user {
    font-weight: 500;
    font-size: 0.9rem;
    color: #1e293b;
}

.answer-date {
    font-size: 0.75rem;
    color: #64748b;
}

.answer-content {
    font-size: 0.9rem;
    color: #475569;
    line-height: 1.6;
    padding-right: 0.5rem;
}

/* نموذج الإجابة */
.answer-form {
    margin-top: 1.5rem;
}

.answer-textarea {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    padding: 0.8rem 1rem;
    font-size: 0.9rem;
    min-height: 6rem;
    resize: vertical;
    transition: all 0.2s ease;
}

.answer-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.submit-btn {
    background-color: #3b82f6;
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 0.6rem 1.2rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-top: 0.8rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.submit-btn:hover {
    background-color: #2563eb;
}

/* الحالات الفارغة */
.empty-lectures,
.empty-questions {
    text-align: center;
    padding: 2rem;
    color: #64748b;
}

.empty-lectures i,
.empty-questions i {
    font-size: 2.5rem;
    color: #cbd5e1;
    margin-bottom: 1rem;
}

.empty-lectures p,
.empty-questions p {
    font-size: 1.1rem;
}

/* التكيف مع الشاشات الصغيرة */
@media (max-width: 768px) {
    .assistant-dashboard {
        padding: 1rem;
    }
    
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .lecture-stats {
        flex-wrap: wrap;
        gap: 0.8rem;
    }
    
    .question-header {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .answers-list {
        padding-right: 1rem;
    }
}
</style>

<script>
function toggleLecture(lectureId) {
    const lectureElement = document.getElementById(lectureId);
    const lectureItem = lectureElement.closest('.lecture-item');
    lectureItem.classList.toggle('active');
}
</script>
@endsection
