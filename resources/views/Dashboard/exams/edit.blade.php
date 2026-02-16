@extends('layout.app')

@section('title', 'تعديل الامتحان')

@section('content')
<link rel="stylesheet" href="{{ asset('assest/css/dashboard.css') }}">

<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="flex items-center justify-between">
                <div>
                    <h1>تعديل الامتحان</h1>
                    <p>{{ $exam->title }}</p>
                </div>
                <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    العودة للامتحان
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="form-container">
            <form action="{{ route('dashboard.exams.update', $exam) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Basic Information Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-info-circle"></i>
                        <h3>المعلومات الأساسية</h3>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group md:col-span-2">
                            <label for="title" class="form-label">عنوان الامتحان *</label>
                            <input type="text" name="title" id="title" 
                                   value="{{ old('title', $exam->title) }}"
                                   class="form-input"
                                   placeholder="أدخل عنوان الامتحان" required>
                            @error('title')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group md:col-span-2">
                            <label for="description" class="form-label">وصف الامتحان</label>
                            <textarea name="description" id="description" rows="3"
                                      class="form-textarea"
                                      placeholder="أدخل وصفاً مختصراً للامتحان">{{ old('description', $exam->description) }}</textarea>
                            @error('description')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Exam Settings Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-cog"></i>
                        <h3>إعدادات الامتحان</h3>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="lecture_id" class="form-label">المحاضرة *</label>
                            <select name="lecture_id" id="lecture_id" class="form-select" required>
                                <option value="">اختر المحاضرة</option>
                                @foreach($lectures as $lecture)
                                    <option value="{{ $lecture->id }}" 
                                            {{ old('lecture_id', $exam->lecture_id) == $lecture->id ? 'selected' : '' }}>
                                        {{ $lecture->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lecture_id')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pass_score" class="form-label">درجة النجاح *</label>
                            <input type="number" name="pass_score" id="pass_score" 
                                   value="{{ old('pass_score', $exam->pass_score) }}"
                                   min="0" max="100"
                                   class="form-input" required>
                            @error('pass_score')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="duration_min" class="form-label">مدة الامتحان (دقائق) *</label>
                            <input type="number" name="duration_min" id="duration_min" 
                                   value="{{ old('duration_min', $exam->duration_min) }}"
                                   min="1"
                                   class="form-input" required>
                            @error('duration_min')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="max_attempts" class="form-label">الحد الأقصى للمحاولات *</label>
                            <input type="number" name="max_attempts" id="max_attempts" 
                                   value="{{ old('max_attempts', $exam->max_attempts) }}"
                                   min="1"
                                   class="form-input" required>
                            @error('max_attempts')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Timing Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-clock"></i>
                        <h3>توقيت الامتحان</h3>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="start_date" class="form-label">تاريخ البداية</label>
                            <input type="datetime-local" name="start_date" id="start_date" 
                                   value="{{ old('start_date', $exam->start_date ? $exam->start_date->format('Y-m-d\TH:i') : '') }}"
                                   class="form-input">
                            @error('start_date')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                            <input type="datetime-local" name="end_date" id="end_date" 
                                   value="{{ old('end_date', $exam->end_date ? $exam->end_date->format('Y-m-d\TH:i') : '') }}"
                                   class="form-input">
                            @error('end_date')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-toggle-on"></i>
                        <h3>حالة الامتحان</h3>
                    </div>
                    
                    <div class="checkbox-group">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" name="is_active" id="is_active" 
                                   value="1"
                                   {{ old('is_active', $exam->is_active) ? 'checked' : '' }}
                                   class="form-checkbox">
                            <label for="is_active" class="checkbox-label">
                                <i class="fas fa-check-circle"></i>
                                تفعيل الامتحان
                            </label>
                        </div>
                        @error('is_active')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        إلغاء
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        تحديث الامتحان
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-calculate end date when start date changes
    document.getElementById('start_date').addEventListener('change', function() {
        const startDate = this.value;
        if (startDate) {
            const endDate = new Date(startDate);
            endDate.setHours(endDate.getHours() + 24); // Add 24 hours by default
            
            const endDateString = endDate.toISOString().slice(0, 16);
            document.getElementById('end_date').value = endDateString;
        }
    });
</script>
@endpush
@endsection
