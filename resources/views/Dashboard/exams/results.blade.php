@extends('layout.app')

@section('title', 'نتائج الامتحان - ' . $exam->title)

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">نتائج الامتحان: {{ $exam->title }}</h1>
        <div>
            <a href="{{ route('dashboard.exams.results-export', $exam) }}?format=csv" class="btn btn-success btn-sm">
                <i class="fas fa-download fa-sm"></i> تصدير CSV
            </a>
            <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-right fa-sm"></i> العودة للامتحان
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                إجمالي المحاولات
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_attempts'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                الناجحون
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['passed'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                الراسبون
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['failed'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                معدل النجاح
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pass_rate'] }}%</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percentage fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Results List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">قائمة النتائج</h6>
            <span class="badge badge-primary">{{ $results->total() }} نتيجة</span>
        </div>
        <div class="card-body">
            @if($results->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="resultsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الطالب</th>
                                <th>البريد الإلكتروني</th>
                                <th>النقاط</th>
                                <th>النسبة المئوية</th>
                                <th>التقدير</th>
                                <th>الحالة</th>
                                <th>المحاولة</th>
                                <th>تاريخ الامتحان</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm mr-3">
                                                <i class="fas fa-user-circle fa-2x text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold">{{ $result->user->name }}</div>
                                                <small class="text-muted">ID: {{ $result->user->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $result->user->email }}</td>
                                    <td>
                                        <div class="text-center">
                                            <div class="font-weight-bold">{{ $result->total }}</div>
                                            <small class="text-muted">من {{ $exam->total_points }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar {{ $result->percentage >= 60 ? 'bg-success' : 'bg-danger' }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $result->percentage }}"
                                                 aria-valuenow="{{ $result->percentage }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                {{ $result->percentage }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $result->percentage >= 90 ? 'success' : ($result->percentage >= 80 ? 'info' : ($result->percentage >= 70 ? 'warning' : ($result->percentage >= 60 ? 'secondary' : 'danger'))) }}">
                                            {{ $result->grade }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($result->passed)
                                            <span class="badge badge-success">نجح</span>
                                        @else
                                            <span class="badge badge-danger">رسب</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $result->attempt }}</span>
                                    </td>
                                    <td>{{ $result->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('dashboard.exams.result-details',[$exam,$result]) }}" 
                                               class="btn btn-info btn-sm" title="عرض التفاصيل">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                          <form action="{{ route('dashboard.exams.result-destroy', [$exam, $result]) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" title="حذف"
        onclick="return confirm('هل أنت متأكد من حذف هذه النتيجة؟')">
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
                    {{ $results->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">لا توجد نتائج</h5>
                    <p class="text-muted">لم يتم تسجيل أي نتائج لهذا الامتحان بعد</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#resultsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json"
        },
        "pageLength": 25,
        "order": [[8, "desc"]]
    });

    // Handle delete confirmation
    $('.delete-form').on('submit', function(e) {
        if (!confirm('هل أنت متأكد من حذف هذه النتيجة؟')) {
            e.preventDefault();
        }
    });
});
</script>
@endpush
