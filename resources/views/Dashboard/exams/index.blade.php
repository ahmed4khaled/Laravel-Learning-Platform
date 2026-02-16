@extends('layout.app')

@section('title', 'لوحة تحكم الامتحانات')

@section('content')
<link rel="stylesheet" href="{{ asset('assest/css/dashboard.css') }}">

<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="flex justify-between items-center">
                <div>
                    <h1>لوحة تحكم الامتحانات</h1>
                    <p>إدارة شاملة لجميع الامتحانات والنتائج</p>
                </div>
                <div class="export-import-buttons">
                    <a href="{{ route('dashboard.exams.export') }}" class="btn-export">
                        <i class="fas fa-download"></i>
                        تصدير البيانات
                    </a>
                    <a href="{{ route('dashboard.exams.create') }}" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        إنشاء امتحان جديد
                    </a>
                </div>
            </div>
        </div>

        <!-- Advanced Search -->
        <div class="advanced-search">
            <form method="GET" action="{{ route('dashboard.exams.index') }}" class="search-form">
                <div class="form-group">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="البحث في العنوان أو الوصف..." class="form-input">
                </div>
                <div class="form-group">
                    <select name="lecture_id" class="form-select">
                        <option value="">جميع المحاضرات</option>
                        @foreach($lectures ?? [] as $lecture)
                            <option value="{{ $lecture->id }}" {{ request('lecture_id') == $lecture->id ? 'selected' : '' }}>
                                {{ $lecture->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select name="status" class="form-select">
                        <option value="">جميع الحالات</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>نشط</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>غير نشط</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="date" name="date_from" value="{{ request('date_from') }}" placeholder="من تاريخ" class="form-input">
                </div>
                <div class="form-group">
                    <input type="date" name="date_to" value="{{ request('date_to') }}" placeholder="إلى تاريخ" class="form-input">
                </div>
                <div class="search-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        بحث
                    </button>
                    <a href="{{ route('dashboard.exams.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        مسح
                    </a>
                </div>
            </form>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-number">{{ $stats['total_exams'] }}</div>
                <div class="stat-label">إجمالي الامتحانات</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ $stats['active_exams'] }}</div>
                <div class="stat-label">الامتحانات النشطة</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="stat-number">{{ $stats['total_questions'] }}</div>
                <div class="stat-label">إجمالي الأسئلة</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">{{ $stats['total_attempts'] }}</div>
                <div class="stat-label">إجمالي المحاولات</div>
            </div>
        </div>

        <!-- Recent Exams -->
        @if($recent_exams->count() > 0)
        <div class="exam-section">
            <h3 class="section-title">
                <i class="fas fa-clock"></i>
                أحدث الامتحانات
            </h3>
            <div class="exam-grid">
                @foreach($recent_exams as $exam)
                <div class="exam-card">
                    <h4 class="exam-title">{{ $exam->title }}</h4>
                    <div class="exam-lecture">
                        <i class="fas fa-book"></i>
                        {{ $exam->lecture->title ?? 'بدون محاضرة' }}
                    </div>
                    <div class="exam-meta">
                        <span><i class="fas fa-question-circle"></i> {{ $exam->questions_count }} سؤال</span>
                        <span><i class="fas fa-calendar"></i> {{ $exam->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="exam-actions">
                        <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i>
                            عرض التفاصيل
                        </a>
                        <a href="{{ route('dashboard.exams.edit', $exam) }}" class="btn btn-success">
                            <i class="fas fa-edit"></i>
                            تعديل
                        </a>
                        <a href="{{ route('dashboard.exams.questions', $exam) }}" class="btn btn-primary">
                            <i class="fas fa-list"></i>
                            إدارة الأسئلة
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Exams Table -->
        <div class="table-section">
            <h3 class="section-title">
                <i class="fas fa-table"></i>
                جميع الامتحانات
            </h3>
                
            @if($exams->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الامتحان</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المحاضرة</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الأسئلة</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المحاولات</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($exams as $exam)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $exam->title }}</div>
                                    @if($exam->description)
                                    <div class="text-sm text-gray-500">{{ Str::limit($exam->description, 50) }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $exam->lecture->title ?? 'بدون محاضرة' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $exam->questions_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $exam->results_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $exam->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $exam->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $exam->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="action-buttons">
                                    <!-- Basic Actions -->
                                    <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn btn-info btn-sm" title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('dashboard.exams.edit', $exam) }}" class="btn btn-success btn-sm" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('dashboard.exams.questions', $exam) }}" class="btn btn-primary btn-sm" title="إدارة الأسئلة">
                                        <i class="fas fa-list"></i>
                                    </a>
                                    
                                    <!-- New Advanced Actions -->
                                    <!-- <button onclick="duplicateExam({{ $exam->id }})" class="btn btn-warning btn-sm" title="نسخ الامتحان">
                                        <i class="fas fa-copy"></i>
                                    </button> -->
                                    @if($exam->results_count > 0)
                                    <a href="{{ route('dashboard.exams.results', $exam->id) }}" class="btn btn-info btn-sm" title="عرض النتائج">
                                        <i class="fas fa-chart-bar"></i>
                                    </a>
                                    <a href="{{ route('dashboard.exams.detailed-report', $exam) }}" class="btn btn-secondary btn-sm" title="تقرير مفصل">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $exams->links() }}
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3>لا توجد امتحانات</h3>
                <p>ابدأ بإنشاء امتحان جديد</p>
                <div class="empty-actions">
                    <a href="{{ route('dashboard.exams.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        إنشاء امتحان جديد
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Duplicate Exam Modal -->
<div id="duplicateModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>نسخ الامتحان</h3>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <p>هل تريد نسخ هذا الامتحان مع جميع أسئلته؟</p>
            <form id="duplicateForm" method="POST">
                @csrf
                <div class="form-group">
                    <label>اسم الامتحان الجديد:</label>
                    <input type="text" name="new_title" class="form-input" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal()">إلغاء</button>
            <button type="submit" form="duplicateForm" class="btn btn-warning">نسخ الامتحان</button>
        </div>
    </div>
</div>

<script>
function duplicateExam(examId) {
    const modal = document.getElementById('duplicateModal');
    const form = document.getElementById('duplicateForm');
    const titleInput = form.querySelector('input[name="new_title"]');
    
    // Set form action
    form.action = `/dashboard/exams/${examId}/duplicate`;
    
    // Show modal
    modal.style.display = 'block';
    
    // Focus on title input
    titleInput.focus();
}

function closeModal() {
    const modal = document.getElementById('duplicateModal');
    modal.style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('duplicateModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Close modal when clicking close button
document.querySelector('.close').onclick = function() {
    closeModal();
}
</script>

<style>
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.modal-header {
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    color: #374151;
}

.close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: #000;
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    padding: 20px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #374151;
}

.form-input {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    font-size: 14px;
}

.form-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
</style>

@endsection
