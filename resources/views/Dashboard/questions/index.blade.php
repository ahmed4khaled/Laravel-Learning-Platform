@extends('layouts.app')

@section('title', 'إدارة الأسئلة')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">إدارة الأسئلة</h1>
        <a href="{{ route('dashboard.questions.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus fa-sm"></i> إضافة سؤال جديد
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">البحث والتصفية</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard.questions.index') }}" class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="search">البحث في السؤال</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="اكتب نص السؤال...">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="question_type">نوع السؤال</label>
                        <select class="form-control" id="question_type" name="question_type">
                            <option value="">جميع الأنواع</option>
                            <option value="multiple_choice" {{ request('question_type') == 'multiple_choice' ? 'selected' : '' }}>
                                اختيار متعدد
                            </option>
                            <option value="true_false" {{ request('question_type') == 'true_false' ? 'selected' : '' }}>
                                صح أو خطأ
                            </option>
                            <option value="essay" {{ request('question_type') == 'essay' ? 'selected' : '' }}>
                                مقالي
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exam_id">الامتحان</label>
                        <select class="form-control" id="exam_id" name="exam_id">
                            <option value="">جميع الامتحانات</option>
                            @foreach($exams as $exam)
                                <option value="{{ $exam->id }}" {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                                    {{ $exam->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status">الحالة</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">جميع الحالات</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>مفعل</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>غير مفعل</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-search"></i> بحث
                            </button>
                            <a href="{{ route('dashboard.questions.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> إلغاء
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Questions List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">قائمة الأسئلة</h6>
            <span class="badge badge-primary">{{ $questions->total() }} سؤال</span>
        </div>
        <div class="card-body">
            @if($questions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="questionsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>السؤال</th>
                                <th>النوع</th>
                                <th>الامتحان</th>
                                <th>النقاط</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($question->img)
                                                <img src="{{ asset('storage/' . $question->img) }}" 
                                                     alt="صورة السؤال" class="mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                            @endif
                                            <div>
                                                <div class="font-weight-bold">{{ Str::limit($question->question, 50) }}</div>
                                                @if($question->explanation)
                                                    <small class="text-muted">{{ Str::limit($question->explanation, 30) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($question->question_type)
                                            @case('multiple_choice')
                                                <span class="badge badge-info">اختيار متعدد</span>
                                                @break
                                            @case('true_false')
                                                <span class="badge badge-warning">صح أو خطأ</span>
                                                @break
                                            @case('essay')
                                                <span class="badge badge-success">مقالي</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.exams.show', $question->exam) }}" class="text-primary">
                                            {{ $question->exam->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">{{ $question->mark }} نقطة</span>
                                    </td>
                                    <td>
                                        @if($question->is_active)
                                            <span class="badge badge-success">مفعل</span>
                                        @else
                                            <span class="badge badge-danger">غير مفعل</span>
                                        @endif
                                    </td>
                                    <td>{{ $question->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('dashboard.questions.show', $question) }}" 
                                               class="btn btn-info btn-sm" title="عرض">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.questions.edit', $question) }}" 
                                               class="btn btn-warning btn-sm" title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dashboard.questions.toggle-status', $question) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm {{ $question->is_active ? 'btn-secondary' : 'btn-success' }}" 
                                                        title="{{ $question->is_active ? 'إلغاء التفعيل' : 'تفعيل' }}">
                                                    <i class="fas {{ $question->is_active ? 'fa-toggle-off' : 'fa-toggle-on' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('dashboard.questions.destroy', $question) }}" 
                                                  method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="حذف"
                                                        onclick="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
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
                <div class="d-flex justify-content-center">
                    {{ $questions->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">لا توجد أسئلة</h5>
                    <p class="text-muted">لم يتم العثور على أسئلة تطابق معايير البحث</p>
                    <a href="{{ route('dashboard.questions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> إضافة سؤال جديد
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من حذف هذا السؤال؟ لا يمكن التراجع عن هذا الإجراء.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">حذف</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#questionsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json"
        },
        "pageLength": 25,
        "order": [[6, "desc"]]
    });

    // Handle delete confirmation
    $('.delete-form').on('submit', function(e) {
        if (!confirm('هل أنت متأكد من حذف هذا السؤال؟')) {
            e.preventDefault();
        }
    });

    // Auto-submit form on filter change
    $('#question_type, #exam_id, #status').on('change', function() {
        $(this).closest('form').submit();
    });
});
</script>
@endpush
