@extends('layouts.app')

@section('title', 'عرض السؤال')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">عرض السؤال</h1>
        <div>
            <a href="{{ route('dashboard.questions.edit', $question) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit fa-sm"></i> تعديل
            </a>
            <a href="{{ route('dashboard.questions.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-right fa-sm"></i> العودة للقائمة
            </a>
        </div>
    </div>

    <!-- Question Details -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Question Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">تفاصيل السؤال</h6>
                    <div>
                        @if($question->is_active)
                            <span class="badge badge-success">مفعل</span>
                        @else
                            <span class="badge badge-danger">غير مفعل</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <!-- Question Image -->
                    @if($question->img)
                        <div class="text-center mb-3">
                            <img src="{{ asset('storage/' . $question->img) }}" 
                                 alt="صورة السؤال" class="img-fluid rounded" 
                                 style="max-height: 300px;">
                        </div>
                    @endif

                    <!-- Question Text -->
                    <div class="mb-3">
                        <h5 class="font-weight-bold text-dark">نص السؤال:</h5>
                        <p class="lead">{{ $question->question }}</p>
                    </div>

                    <!-- Question Type -->
                    <div class="mb-3">
                        <h6 class="font-weight-bold text-dark">نوع السؤال:</h6>
                        @switch($question->question_type)
                            @case('multiple_choice')
                                <span class="badge badge-info badge-lg">اختيار متعدد</span>
                                @break
                            @case('true_false')
                                <span class="badge badge-warning badge-lg">صح أو خطأ</span>
                                @break
                            @case('essay')
                                <span class="badge badge-success badge-lg">مقالي</span>
                                @break
                        @endswitch
                    </div>

                    <!-- Multiple Choice Options -->
                    @if($question->question_type == 'multiple_choice')
                        <div class="mb-3">
                            <h6 class="font-weight-bold text-dark">الخيارات:</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card {{ $question->correct_option == 'option_a' ? 'border-success' : 'border-light' }} mb-2">
                                        <div class="card-body p-2">
                                            <strong>أ)</strong> {{ $question->option_a }}
                                            @if($question->correct_option == 'option_a')
                                                <i class="fas fa-check text-success float-right"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card {{ $question->correct_option == 'option_b' ? 'border-success' : 'border-light' }} mb-2">
                                        <div class="card-body p-2">
                                            <strong>ب)</strong> {{ $question->option_b }}
                                            @if($question->correct_option == 'option_b')
                                                <i class="fas fa-check text-success float-right"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card {{ $question->correct_option == 'option_c' ? 'border-success' : 'border-light' }} mb-2">
                                        <div class="card-body p-2">
                                            <strong>ج)</strong> {{ $question->option_c }}
                                            @if($question->correct_option == 'option_c')
                                                <i class="fas fa-check text-success float-right"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card {{ $question->correct_option == 'option_d' ? 'border-success' : 'border-light' }} mb-2">
                                        <div class="card-body p-2">
                                            <strong>د)</strong> {{ $question->option_d }}
                                            @if($question->correct_option == 'option_d')
                                                <i class="fas fa-check text-success float-right"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- True/False Answer -->
                    @if($question->question_type == 'true_false')
                        <div class="mb-3">
                            <h6 class="font-weight-bold text-dark">الإجابة الصحيحة:</h6>
                            <span class="badge badge-success badge-lg">
                                {{ $question->correct_option == 'true' ? 'صح' : 'خطأ' }}
                            </span>
                        </div>
                    @endif

                    <!-- Explanation -->
                    @if($question->explanation)
                        <div class="mb-3">
                            <h6 class="font-weight-bold text-dark">شرح الإجابة:</h6>
                            <div class="alert alert-info">
                                {{ $question->explanation }}
                            </div>
                        </div>
                    @endif

                    <!-- Points -->
                    <div class="mb-3">
                        <h6 class="font-weight-bold text-dark">النقاط:</h6>
                        <span class="badge badge-primary badge-lg">{{ $question->mark }} نقطة</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Question Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">معلومات السؤال</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>الامتحان:</strong><br>
                        <a href="{{ route('dashboard.exams.show', $question->exam) }}" class="text-primary">
                            {{ $question->exam->title }}
                        </a>
                    </div>
                    
                    <div class="mb-3">
                        <strong>تاريخ الإنشاء:</strong><br>
                        {{ $question->created_at->format('Y-m-d H:i') }}
                    </div>
                    
                    <div class="mb-3">
                        <strong>آخر تحديث:</strong><br>
                        {{ $question->updated_at->format('Y-m-d H:i') }}
                    </div>
                    
                    <div class="mb-3">
                        <strong>الحالة:</strong><br>
                        @if($question->is_active)
                            <span class="badge badge-success">مفعل</span>
                        @else
                            <span class="badge badge-danger">غير مفعل</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">الإجراءات</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.questions.edit', $question) }}" class="btn btn-warning btn-block">
                            <i class="fas fa-edit"></i> تعديل السؤال
                        </a>
                        
                        <form action="{{ route('dashboard.questions.toggle-status', $question) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-block {{ $question->is_active ? 'btn-secondary' : 'btn-success' }}">
                                <i class="fas {{ $question->is_active ? 'fa-toggle-off' : 'fa-toggle-on' }}"></i>
                                {{ $question->is_active ? 'إلغاء التفعيل' : 'تفعيل' }}
                            </button>
                        </form>
                        
                        <form action="{{ route('dashboard.questions.destroy', $question) }}" method="POST" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block">
                                <i class="fas fa-trash"></i> حذف السؤال
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">إحصائيات</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-right">
                                <div class="h4 mb-0 text-primary">{{ $question->mark }}</div>
                                <div class="text-xs text-muted">النقاط</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="h4 mb-0 text-success">
                                @if($question->is_active)
                                    <i class="fas fa-check"></i>
                                @else
                                    <i class="fas fa-times"></i>
                                @endif
                            </div>
                            <div class="text-xs text-muted">الحالة</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
