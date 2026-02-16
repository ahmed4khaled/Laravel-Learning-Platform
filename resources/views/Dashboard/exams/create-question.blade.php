@extends('layout.app')

@section('title', 'إضافة سؤال جديد')

@section('content')
<link rel="stylesheet" href="{{ asset('assest/css/dashboard.css') }}">

<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="flex items-center justify-between">
                <div>
                    <h1>إضافة سؤال جديد</h1>
                    <p>امتحان: {{ $exam->title }}</p>
                </div>
                <a href="{{ route('dashboard.exams.questions', $exam) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    العودة لإدارة الأسئلة
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="form-container">
            <form action="{{ route('dashboard.exams.store-question', $exam) }}" method="POST" class="form-sections">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                
                <!-- Question Type Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-list-alt"></i>
                        <h3>نوع السؤال</h3>
                    </div>
                    
                    <div class="form-group">
                        <label for="question_type" class="form-label">نوع السؤال *</label>
                        <select name="question_type" id="question_type" class="form-select" required>
                            <option value="">اختر نوع السؤال</option>
                            <option value="multiple_choice" {{ old('question_type') == 'multiple_choice' ? 'selected' : '' }}>اختيار من متعدد</option>
                            <option value="true_false" {{ old('question_type') == 'true_false' ? 'selected' : '' }}>صح وخطأ</option>
                            <option value="essay" {{ old('question_type') == 'essay' ? 'selected' : '' }}>مقالي</option>
                        </select>
                        @error('question_type')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Question Text Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-question-circle"></i>
                        <h3>نص السؤال</h3>
                    </div>
                    
                    <div class="form-group">
                        <label for="question" class="form-label">نص السؤال *</label>
                        <textarea name="question" id="question" rows="4"
                                  class="form-textarea"
                                  placeholder="أدخل نص السؤال" required>{{ old('question') }}</textarea>
                        @error('question')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Multiple Choice Options Section -->
                <div id="multiple_choice_options" class="form-section hidden">
                    <div class="section-header">
                        <i class="fas fa-check-square"></i>
                        <h3>خيارات الإجابة - اختيار من متعدد</h3>
                    </div>
                    
                    <div class="options-grid">
                        <div class="option-group">
                            <label for="option_a" class="form-label">
                                <span class="option-label">أ</span>
                                الخيار أ *
                            </label>
                            <input type="text" name="option_a" id="option_a" 
                                   value="{{ old('option_a') }}"
                                   class="form-input"
                                   placeholder="أدخل الخيار أ">
                            @error('option_a')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="option-group">
                            <label for="option_b" class="form-label">
                                <span class="option-label">ب</span>
                                الخيار ب *
                            </label>
                            <input type="text" name="option_b" id="option_b" 
                                   value="{{ old('option_b') }}"
                                   class="form-input"
                                   placeholder="أدخل الخيار ب">
                            @error('option_b')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="option-group">
                            <label for="option_c" class="form-label">
                                <span class="option-label">ج</span>
                                الخيار ج *
                            </label>
                            <input type="text" name="option_c" id="option_c" 
                                   value="{{ old('option_c') }}"
                                   class="form-input"
                                   placeholder="أدخل الخيار ج">
                            @error('option_c')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="option-group">
                            <label for="option_d" class="form-label">
                                <span class="option-label">د</span>
                                الخيار د *
                            </label>
                            <input type="text" name="option_d" id="option_d" 
                                   value="{{ old('option_d') }}"
                                   class="form-input"
                                   placeholder="أدخل الخيار د">
                            @error('option_d')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="correct-answer-section">
                        <label for="correct_option" class="form-label">الإجابة الصحيحة *</label>
                        <select name="correct_option" id="correct_option" class="form-select">
                            <option value="">اختر الإجابة الصحيحة</option>
                            <option value="a" {{ old('correct_option') == 'a' ? 'selected' : '' }}>أ</option>
                            <option value="b" {{ old('correct_option') == 'b' ? 'selected' : '' }}>ب</option>
                            <option value="c" {{ old('correct_option') == 'c' ? 'selected' : '' }}>ج</option>
                            <option value="d" {{ old('correct_option') == 'd' ? 'selected' : '' }}>د</option>
                        </select>
                        @error('correct_option')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- True/False Options Section -->
                <div id="true_false_options" class="form-section hidden">
                    <div class="section-header">
                        <i class="fas fa-toggle-on"></i>
                        <h3>خيارات الإجابة - صح وخطأ</h3>
                    </div>
                    
                    <div class="options-grid">
                        <div class="option-group">
                            <label for="option_a_true_false" class="form-label">
                                <span class="option-label true-label">صح</span>
                                الخيار أ (صح) *
                            </label>
                            <input type="text" name="option_a" id="option_a_true_false" 
                                   value="{{ old('option_a', 'صح') }}"
                                   class="form-input"
                                   placeholder="صح">
                            @error('option_a')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="option-group">
                            <label for="option_b_true_false" class="form-label">
                                <span class="option-label false-label">خطأ</span>
                                الخيار ب (خطأ) *
                            </label>
                            <input type="text" name="option_b" id="option_b_true_false" 
                                   value="{{ old('option_b', 'خطأ') }}"
                                   class="form-input"
                                   placeholder="خطأ">
                            @error('option_b')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="correct-answer-section">
                        <label for="correct_option_true_false" class="form-label">الإجابة الصحيحة *</label>
                        <select name="correct_option" id="correct_option_true_false" class="form-select">
                            <option value="">اختر الإجابة الصحيحة</option>
                            <option value="a" {{ old('correct_option') == 'a' ? 'selected' : '' }}>صح</option>
                            <option value="b" {{ old('correct_option') == 'b' ? 'selected' : '' }}>خطأ</option>
                        </select>
                        @error('correct_option')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Settings Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-cog"></i>
                        <h3>إعدادات السؤال</h3>
                    </div>
                    
                    <div class="settings-grid">
                        <div class="points-input-group">
                            <label for="points" class="form-label">النقاط *</label>
                            <input type="number" name="points" id="points" 
                                   value="{{ old('points', 1) }}" min="1"
                                   class="form-input" required>
                            <i class="fas fa-star"></i>
                            @error('points')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="checkbox-group">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" name="is_active" id="is_active" 
                                       value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="form-checkbox">
                                <label for="is_active" class="checkbox-label">
                                    <i class="fas fa-check-circle"></i>
                                    تفعيل السؤال فوراً
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
                </div>

                <!-- Explanation Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-lightbulb"></i>
                        <h3>توضيح الإجابة (اختياري)</h3>
                    </div>
                    
                    <div class="form-group">
                        <label for="explanation" class="form-label">توضيح الإجابة</label>
                        <textarea name="explanation" id="explanation" rows="3"
                                  class="form-textarea"
                                  placeholder="أدخل توضيحاً للإجابة الصحيحة">{{ old('explanation') }}</textarea>
                        @error('explanation')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('dashboard.exams.questions', $exam) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        إلغاء
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        إضافة السؤال
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('question_type').addEventListener('change', function() {
        const multipleChoiceOptions = document.getElementById('multiple_choice_options');
        const trueFalseOptions = document.getElementById('true_false_options');
        
        // Hide all options first
        multipleChoiceOptions.classList.add('hidden');
        trueFalseOptions.classList.add('hidden');
        
        // Show relevant options based on selection
        if (this.value === 'multiple_choice') {
            multipleChoiceOptions.classList.remove('hidden');
            // Set required attributes for multiple choice
            document.getElementById('option_a').required = true;
            document.getElementById('option_b').required = true;
            document.getElementById('option_c').required = true;
            document.getElementById('option_d').required = true;
            document.getElementById('correct_option').required = true;
        } else if (this.value === 'true_false') {
            trueFalseOptions.classList.remove('hidden');
            // Set required attributes for true/false
            document.getElementById('option_a_true_false').required = true;
            document.getElementById('option_b_true_false').required = true;
            document.getElementById('correct_option_true_false').required = true;
        } else {
            // For essay questions, no options needed
            document.getElementById('option_a').required = false;
            document.getElementById('option_b').required = false;
            document.getElementById('option_c').required = false;
            document.getElementById('option_d').required = false;
            document.getElementById('correct_option').required = false;
        }
    });
    
    // Trigger change event on page load to show/hide options based on old value
    document.addEventListener('DOMContentLoaded', function() {
        const questionType = document.getElementById('question_type');
        if (questionType.value) {
            questionType.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush
@endsection
