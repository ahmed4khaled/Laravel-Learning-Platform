@extends('layout.app')

@section('title', 'إدارة أسئلة ' . $exam->title)

@section('content')
<link rel="stylesheet" href="{{ asset('assest/css/dashboard.css') }}">

<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="flex items-center justify-between">
                <div>
                    <h1>إدارة أسئلة الامتحان</h1>
                    <p>{{ $exam->title }}</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('dashboard.exams.create-question', $exam) }}" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                        إضافة سؤال جديد
                    </a>
                    <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i>
                        رجوع للامتحان
                    </a>
                </div>
            </div>
        </div>

        <!-- Questions Summary -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="stat-number">{{ $questions->total() }}</div>
                <div class="stat-label">إجمالي الأسئلة</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ $exam->questions()->where('is_active', true)->count() }}</div>
                <div class="stat-label">الأسئلة النشطة</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-number">{{ $exam->total_points ?? 0 }}</div>
                <div class="stat-label">إجمالي النقاط</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-number">{{ $exam->pass_score }}%</div>
                <div class="stat-label">درجة النجاح</div>
            </div>
        </div>

        <!-- Questions Table -->
        <div class="table-card">
            <div class="card-header">
                <div class="flex items-center">
                    <i class="fas fa-list"></i>
                    <h3>الأسئلة</h3>
                </div>
            </div>
            
            @if($questions->count() > 0)
            <div class="card-content">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>السؤال</th>
                                <th>النوع</th>
                                <th>النقاط</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                            <tr class="question-row">
                                <td>
                                    <div class="question-content">
                                        <div class="question-text">{{ Str::limit($question->question, 150) }}</div>
                                        @if($question->question_type === 'multiple_choice')
                                            <div class="question-options">
                                                <div class="option-item">
                                                    <span class="option-label">أ:</span>
                                                    <span class="option-text">{{ $question->option_a }}</span>
                                                </div>
                                                <div class="option-item">
                                                    <span class="option-label">ب:</span>
                                                    <span class="option-text">{{ $question->option_b }}</span>
                                                </div>
                                                <div class="option-item">
                                                    <span class="option-label">ج:</span>
                                                    <span class="option-text">{{ $question->option_c }}</span>
                                                </div>
                                                <div class="option-item">
                                                    <span class="option-label">د:</span>
                                                    <span class="option-text">{{ $question->option_d }}</span>
                                                </div>
                                                <div class="correct-answer">
                                                    <i class="fas fa-check-circle"></i>
                                                    الإجابة الصحيحة: {{ strtoupper($question->correct_option) }}
                                                </div>
                                            </div>
                                        @endif
                                        @if($question->explanation)
                                            <div class="question-explanation">
                                                <i class="fas fa-info-circle"></i>
                                                <span class="explanation-text">{{ Str::limit($question->explanation, 100) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="question-type-badge question-type-{{ $question->question_type }}">
                                        @switch($question->question_type)
                                            @case('multiple_choice')
                                                <i class="fas fa-list-ul"></i>
                                                اختيار من متعدد
                                                @break
                                            @case('true_false')
                                                <i class="fas fa-toggle-on"></i>
                                                صح وخطأ
                                                @break
                                            @case('essay')
                                                <i class="fas fa-edit"></i>
                                                مقالي
                                                @break
                                            @default
                                                <i class="fas fa-question"></i>
                                                {{ $question->question_type }}
                                        @endswitch
                                    </span>
                                </td>
                                <td>
                                    <div class="points-display">
                                        <i class="fas fa-star"></i>
                                        <span class="points-number">{{ $question->points }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $question->is_active ? 'status-active' : 'status-inactive' }}">
                                        <i class="fas {{ $question->is_active ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                        {{ $question->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="date-display">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span class="date-text">{{ $question->created_at->format('Y-m-d') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="question-actions">
                                        <a href="{{ route('dashboard.questions.edit', $question) }}" 
                                           class="btn btn-info btn-sm" title="تعديل السؤال">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('dashboard.questions.toggle-status', $question) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="btn {{ $question->is_active ? 'btn-danger' : 'btn-success' }} btn-sm"
                                                    title="{{ $question->is_active ? 'إلغاء التفعيل' : 'تفعيل' }}">
                                                <i class="fas {{ $question->is_active ? 'fa-times-circle' : 'fa-check-circle' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('dashboard.questions.destroy', $question) }}" method="POST" class="inline" 
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="حذف السؤال">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $questions->links() }}
                </div>
            </div>
            @else
            <div class="card-content">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <h3>لا توجد أسئلة</h3>
                    <p>ابدأ بإضافة أسئلة للامتحان</p>
                    <div class="empty-actions">
                        <a href="{{ route('dashboard.exams.create-question', $exam) }}" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                            إضافة سؤال جديد
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<div class="floating-action" onclick="window.location.href='{{ route('dashboard.exams.create-question', $exam) }}'">
    <i class="fas fa-plus"></i>
</div>
@endsection
