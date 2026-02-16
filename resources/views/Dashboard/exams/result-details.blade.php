@extends('layout.app')

@section('content')
<div class="container-fluid py-4">
    <!-- عنوان الصفحة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">تفاصيل نتيجة الامتحان</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">العودة</a>
    </div>

    <!-- بطاقة معلومات الطالب والامتحان -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white py-3">
            <h6 class="m-0 font-weight-bold">معلومات النتيجة</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>الطالب:</strong> {{ $result->user->name }}</p>
                    <p><strong>البريد الإلكتروني:</strong> {{ $result->user->email }}</p>
                    <p><strong>تاريخ التسليم:</strong> {{ $result->created_at->format('Y-m-d H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>الامتحان:</strong> {{ $result->exam->title }}</p>
                    <p><strong>الدرجة الكلية:</strong> {{ $result->total_mark }} من {{ $result->exam->total_mark }}</p>
                    <p><strong>النسبة المئوية:</strong> {{ number_format(($result->total_mark / $result->exam->total_points) * 100, 2) }}%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- جدول تفاصيل الأسئلة -->
    <div class="card shadow">
        <div class="card-header bg-info text-white py-3">
            <h6 class="m-0 font-weight-bold">تفاصيل الإجابات</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">السؤال</th>
                            <th width="15%">نوع السؤال</th>
                            <th width="15%">إجابة الطالب</th>
                            <th width="15%">الإجابة الصحيحة</th>
                            <th width="10%">الحالة</th>
                            <th width="5%">النقاط</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questionStats as $index => $question)
                        <tr class="{{ $question['is_correct'] ? 'table-success' : 'table-danger' }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{!! nl2br(e($question['question'])) !!}</td>
                            <td>{{ $question['question_type'] }}</td>
                            <td>{!! nl2br(e($question['student_answer'] ?? 'لم يتم الإجابة')) !!}</td>
                            <td>{!! nl2br(e($question['correct_answer'])) !!}</td>
                            <td>
                                @if($question['is_correct'])
                                    <span class="badge badge-success">صحيح</span>
                                @else
                                    <span class="badge badge-danger">خطأ</span>
                                @endif
                            </td>
                            <td>{{ $question['points_earned'] }} / {{ $question['max_points'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ملخص النتيجة -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                الإجابات الصحيحة</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $questionStats->where('is_correct', true)->count() }} / {{ $questionStats->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                النسبة المئوية للإجابات الصحيحة</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(($questionStats->where('is_correct', true)->count() / $questionStats->count()) * 100, 2) }}%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percent fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }
    .card-header {
        border-radius: 0.35rem 0.35rem 0 0 !important;
    }
</style>
@endsection