@extends('layout.app')

@section('title', 'إحصائيات الامتحان')

@section('content')
<link rel="stylesheet" href="{{ asset('assest/css/dashboard.css') }}">

<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="flex justify-between items-center">
                <div>
                    <h1>إحصائيات الامتحان: {{ $exam->title }}</h1>
                    <p>تحليل شامل لأداء الامتحان والنتائج</p>
                </div>
                <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn-primary">
                    <i class="fas fa-arrow-right"></i>
                    العودة للامتحان
                </a>
            </div>
        </div>

        <!-- Exam Info -->
        <div class="exam-section">
            <h3 class="section-title">
                <i class="fas fa-info-circle"></i>
                معلومات الامتحان
            </h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-number">{{ $exam->lecture->title ?? 'بدون محاضرة' }}</div>
                    <div class="stat-label">المحاضرة</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-number">{{ $exam->pass_score }}%</div>
                    <div class="stat-label">درجة النجاح</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number">{{ $exam->duration_min }}</div>
                    <div class="stat-label">مدة الامتحان (دقيقة)</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-number">{{ $exam->created_at->format('Y/m/d') }}</div>
                    <div class="stat-label">تاريخ الإنشاء</div>
                </div>
            </div>
        </div>

        <!-- Question Statistics -->
        <div class="exam-section">
            <h3 class="section-title">
                <i class="fas fa-question-circle"></i>
                إحصائيات الأسئلة
            </h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <div class="stat-number">{{ $exam->total_questions }}</div>
                    <div class="stat-label">إجمالي الأسئلة</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number">{{ $exam->total_points }}</div>
                    <div class="stat-label">إجمالي النقاط</div>
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
                        <i class="fas fa-pause-circle"></i>
                    </div>
                    <div class="stat-number">{{ $exam->questions()->where('is_active', false)->count() }}</div>
                    <div class="stat-label">الأسئلة المعطلة</div>
                </div>
            </div>

            <!-- Question Types Distribution -->
            @if($questionStats->count() > 0)
            <div class="table-section">
                <h4 class="section-title">
                    <i class="fas fa-chart-pie"></i>
                    توزيع أنواع الأسئلة
                </h4>
                <div class="stats-grid">
                    @foreach($questionStats as $stat)
                    <div class="stat-card">
                        <div class="stat-icon">
                            @switch($stat->question_type)
                                @case('multiple_choice')
                                    <i class="fas fa-list-ul"></i>
                                    @break
                                @case('true_false')
                                    <i class="fas fa-toggle-on"></i>
                                    @break
                                @case('essay')
                                    <i class="fas fa-edit"></i>
                                    @break
                                @default
                                    <i class="fas fa-question"></i>
                            @endswitch
                        </div>
                        <div class="stat-number">{{ $stat->count }}</div>
                        <div class="stat-label">
                            @switch($stat->question_type)
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
                                    {{ $stat->question_type }}
                            @endswitch
                        </div>
                        <div class="text-xs text-gray-400 mt-2">متوسط النقاط: {{ round($stat->avg_points, 1) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Results Statistics -->
        <div class="exam-section">
            <h3 class="section-title">
                <i class="fas fa-chart-bar"></i>
                إحصائيات النتائج
            </h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">{{ $exam->results()->count() }}</div>
                    <div class="stat-label">إجمالي المحاولات</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                    <div class="stat-number">{{ $exam->results()->where('total', '>=', $exam->pass_score)->count() }}</div>
                    <div class="stat-label">النجاح</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-thumbs-down"></i>
                    </div>
                    <div class="stat-number">{{ $exam->results()->where('total', '<', $exam->pass_score)->count() }}</div>
                    <div class="stat-label">الرسوب</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-number">{{ round($exam->results()->avg('total') ?? 0, 1) }}</div>
                    <div class="stat-label">متوسط الدرجات</div>
                </div>
            </div>

            <!-- Score Distribution -->
            @if($scoreDistribution->count() > 0)
            <div class="table-section">
                <h4 class="section-title">
                    <i class="fas fa-chart-area"></i>
                    توزيع الدرجات
                </h4>
                <div class="space-y-4">
                    @foreach($scoreDistribution as $range)
                    <div class="flex items-center justify-between bg-gray-50 rounded-lg p-4">
                        <span class="text-sm font-semibold text-gray-700">{{ $range->score_range }}</span>
                        <div class="flex items-center space-x-3 space-x-reverse">
                            <div class="w-32 bg-gray-200 rounded-full h-3">
                                @php
                                    $total = $exam->results()->count();
                                    $percentage = $total > 0 ? ($range->count / $total) * 100 : 0;
                                @endphp
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                            </div>
                            <span class="text-sm font-bold text-gray-900 w-12 text-left">{{ $range->count }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Recent Results -->
        @if($exam->results()->count() > 0)
        <div class="table-section">
            <h3 class="section-title">
                <i class="fas fa-history"></i>
                أحدث النتائج
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الطالب</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الدرجة</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">النتيجة</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($exam->results()->latest()->take(10)->get() as $result)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                        {{ substr($result->user->name ?? 'غير محدد', 0, 1) }}
                                    </div>
                                    <span class="mr-3">{{ $result->user->name ?? 'غير محدد' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="font-semibold">{{ $result->total }}/{{ $exam->total_points }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($result->total >= $exam->pass_score)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        نجح
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        رسب
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                    {{ $result->created_at->diffForHumans() }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Empty State for No Results -->
        @if($exam->results()->count() == 0)
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <h3>لا توجد نتائج بعد</h3>
            <p>لم يقم أي طالب بحل هذا الامتحان حتى الآن</p>
            <div class="empty-actions">
                <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i>
                    عرض الامتحان
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
