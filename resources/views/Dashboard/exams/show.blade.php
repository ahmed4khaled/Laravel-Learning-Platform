@extends('layout.app')

@section('title', $exam->title)

@section('content')
<link rel="stylesheet" href="{{ asset('assest/css/dashboard.css') }}">

<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <h1>{{ $exam->title }}</h1>
                        <span class="status-badge {{ $exam->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $exam->is_active ? 'نشط' : 'غير نشط' }}
                        </span>
                    </div>
                    @if($exam->description)
                        <p class="exam-description">{{ $exam->description }}</p>
                    @endif
                </div>
                <div class="header-actions">
                    <a href="{{ route('dashboard.exams.edit', $exam) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        تعديل
                    </a>
                    <a href="{{ route('dashboard.exams.questions', $exam) }}" class="btn btn-success">
                        <i class="fas fa-list"></i>
                        إدارة الأسئلة
                    </a>
                    <a href="{{ route('dashboard.exams.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i>
                        رجوع
                    </a>
                </div>
            </div>
        </div>

        <!-- Exam Details -->
        <div class="dashboard-grid">
            <!-- Main Info -->
            <div class="main-content">
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-info-circle"></i>
                        <h3>تفاصيل الامتحان</h3>
                    </div>
                    <div class="card-content">
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">المحاضرة</span>
                                <span class="info-value">{{ $exam->lecture->title ?? 'بدون محاضرة' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">درجة النجاح</span>
                                <span class="info-value">{{ $exam->pass_score }}%</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">مدة الامتحان</span>
                                <span class="info-value">{{ $exam->duration_min }} دقيقة</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">الحد الأقصى للمحاولات</span>
                                <span class="info-value">{{ $exam->max_attempts }}</span>
                            </div>
                            @if($exam->start_date)
                            <div class="info-item">
                                <span class="info-label">تاريخ البداية</span>
                                <span class="info-value">{{ $exam->start_date->format('Y-m-d H:i') }}</span>
                            </div>
                            @endif
                            @if($exam->end_date)
                            <div class="info-item">
                                <span class="info-label">تاريخ الانتهاء</span>
                                <span class="info-value">{{ $exam->end_date->format('Y-m-d H:i') }}</span>
                            </div>
                            @endif
                            <div class="info-item">
                                <span class="info-label">تاريخ الإنشاء</span>
                                <span class="info-value">{{ $exam->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">آخر تحديث</span>
                                <span class="info-value">{{ $exam->updated_at->format('Y-m-d H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Quick Actions -->
                <div class="action-card">
                    <div class="card-header">
                        <i class="fas fa-bolt"></i>
                        <h3>إجراءات سريعة</h3>
                    </div>
                    <div class="card-content">
                        <div class="action-list">
                            <form action="{{ route('dashboard.exams.toggle-status', $exam) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="action-button {{ $exam->is_active ? 'action-danger' : 'action-success' }}">
                                    <i class="fas {{ $exam->is_active ? 'fa-times' : 'fa-check' }}"></i>
                                    {{ $exam->is_active ? 'إلغاء التفعيل' : 'تفعيل' }}
                                </button>
                            </form>
                            <a href="{{ route('dashboard.exams.create-question', $exam) }}" 
                               class="action-button action-primary">
                                <i class="fas fa-plus"></i>
                                إضافة سؤال
                            </a>
                            <a href="{{ route('dashboard.exams.statistics', $exam) }}" 
                               class="action-button action-info">
                                <i class="fas fa-chart-bar"></i>
                                عرض الإحصائيات
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Status Summary -->
                <div class="stats-card">
                    <div class="card-header">
                        <i class="fas fa-chart-pie"></i>
                        <h3>ملخص الحالة</h3>
                    </div>
                    <div class="card-content">
                        <div class="stats-list">
                            <div class="stat-item">
                                <span class="stat-label">إجمالي الأسئلة</span>
                                <span class="stat-value">{{ $questionStats['total'] }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">الأسئلة النشطة</span>
                                <span class="stat-value">{{ $questionStats['active'] }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">إجمالي النقاط</span>
                                <span class="stat-value">{{ $exam->total_points ?? 0 }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">إجمالي المحاولات</span>
                                <span class="stat-value">{{ $resultStats['total_attempts'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions Summary -->
        @if($questionStats['total'] > 0)
        <div class="summary-card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <div>
                        <i class="fas fa-list-alt"></i>
                        <h3>ملخص الأسئلة</h3>
                    </div>
                    <a href="{{ route('dashboard.exams.questions', $exam) }}" 
                       class="link-primary">عرض جميع الأسئلة</a>
                </div>
            </div>
            <div class="card-content">
                <div class="summary-grid">
                    @foreach($questionStats['by_type'] as $type => $count)
                    <div class="summary-item">
                        <div class="summary-number">{{ $count }}</div>
                        <div class="summary-label">
                            @switch($type)
                                @case('multiple_choice')
                                    أسئلة اختيار من متعدد
                                    @break
                                @case('true_false')
                                    أسئلة صح وخطأ
                                    @break
                                @case('essay')
                                    أسئلة مقالية
                                    @break
                                @default
                                    {{ $type }}
                            @endswitch
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Results Summary -->
        @if($resultStats['total_attempts'] > 0)
        <div class="summary-card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <div>
                        <i class="fas fa-chart-line"></i>
                        <h3>ملخص النتائج</h3>
                    </div>
                    <a href="{{ route('dashboard.exams.statistics', $exam) }}" 
                       class="link-primary">عرض الإحصائيات التفصيلية</a>
                </div>
            </div>
            <div class="card-content">
                <div class="summary-grid">
                    <div class="summary-item">
                        <div class="summary-number">{{ $resultStats['total_attempts'] }}</div>
                        <div class="summary-label">إجمالي المحاولات</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-number success">{{ $resultStats['passed'] }}</div>
                        <div class="summary-label">نجح</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-number danger">{{ $resultStats['failed'] }}</div>
                        <div class="summary-label">رسب</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-number info">{{ number_format($resultStats['average_score'], 1) }}%</div>
                        <div class="summary-label">متوسط الدرجات</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Recent Questions -->
        @if($exam->questions->count() > 0)
        <div class="table-card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <div>
                        <i class="fas fa-question-circle"></i>
                        <h3>أحدث الأسئلة</h3>
                    </div>
                    <a href="{{ route('dashboard.exams.questions', $exam) }}" 
                       class="link-primary">عرض جميع الأسئلة</a>
                </div>
            </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exam->questions->take(5) as $question)
                            <tr>
                                <td>
                                    <div class="question-text">{{ Str::limit($question->question, 100) }}</div>
                                </td>
                                <td class="question-type">
                                    @switch($question->question_type)
                                        @case('multiple_choice')
                                            اختيار من متعدد
                                            @break
                                        @case('true_false')
                                            صح وخطأ
                                            @break
                                        @case('essay')
                                            مقالي
                                            @break
                                        @default
                                            {{ $question->question_type }}
                                    @endswitch
                                </td>
                                <td class="question-points">{{ $question->points }}</td>
                                <td>
                                    <span class="status-badge {{ $question->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $question->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </td>
                                <td class="question-date">{{ $question->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
