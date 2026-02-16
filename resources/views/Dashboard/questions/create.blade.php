@extends('layout.app')

@section('title', 'إنشاء سؤال جديد')

@section('content')
<link rel="stylesheet" href="{{ asset('assest/css/dashboard.css') }}">

<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="flex justify-between items-center">
                <div>
                    <h1>إنشاء سؤال جديد</h1>
                    <p>أضف سؤال جديد للامتحان: {{ $exam->title }}</p>
                </div>
                <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    العودة للامتحان
                </a>
            </div>
        </div>

        <!-- Question Form -->
        <div class="form-section">
            <form action="{{ route('dashboard.exams.store-question', $exam) }}" method="POST" class="question-form">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                
                <!-- Question Type Selection -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-list-ul"></i>
                        نوع السؤال
                    </label>
                    <div class="question-type-selector">
                        <div class="type-option" data-type="multiple_choice">
                            <input type="radio" name="question_type" value="multiple_choice" id="type_multiple" class="hidden" checked>
                            <label for="type_multiple" class="type-label">
                                <i class="fas fa-list-ul"></i>
                                <span>اختيار من متعدد</span>
                            </label>
                        </div>
                        <div class="type-option" data-type="true_false">
                            <input type="radio" name="question_type" value="true_false" id="type_true_false" class="hidden">
                            <label for="type_true_false" class="type-label">
                                <i class="fas fa-toggle-on"></i>
                                <span>صح وخطأ</span>
                            </label>
                        </div>
                        <div class="type-option" data-type="essay">
                            <input type="radio" name="question_type" value="essay" id="type_essay" class="hidden">
                            <label for="type_essay" class="type-label">
                                <i class="fas fa-edit"></i>
                                <span>سؤال مقالي</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Question Text -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-question-circle"></i>
                        نص السؤال
                    </label>
                    <input 
                        type="text" 
                        name="question" 
                        rows="4" 
                        class="form-textarea" 
                        placeholder="اكتب نص السؤال هنا..."
                        required
                    >{{ old('question') }}</input>
                    @error('question')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Question Points -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-star"></i>
                        نقاط السؤال
                    </label>
                    <input 
                        type="number" 
                        name="mark" 
                        min="1" 
                        max="100" 
                        class="form-input" 
                        value="{{ old('points', 1) }}"
                        required
                    >
                    @error('points')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

           

                <!-- Question Status -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-toggle-on"></i>
                        حالة السؤال
                    </label>
                    <div class="toggle-switch">
                        <input type="checkbox" name="is_active" id="is_active" class="toggle-input" checked>
                        <label for="is_active" class="toggle-label">
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-text">نشط</span>
                    </div>
                </div>

                <!-- Multiple Choice Options -->
                <div id="multiple_choice_options" class="options-section">
                    <h4 class="section-title">
                        <i class="fas fa-list-ul"></i>
                        خيارات الإجابة
                    </h4>
                    <div class="options-container">
                        <div class="option-item">
                            <div class="option-header">
                                <span class="option-number">أ</span>
                                <div class="option-controls">
                                    <input type="radio" name="correct_option" value="a" class="correct-radio" required>
                                    <label class="correct-label">إجابة صحيحة</label>
                                </div>
                            </div>
                            <input 
                                name="option_a" 
                                class="option-textarea" 
                                placeholder="اكتب الخيار الأول..."
                                required
                            >{{ old('option_a') }}</input>
                        </div>
                        
                        <div class="option-item">
                            <div class="option-header">
                                <span class="option-number">ب</span>
                                <div class="option-controls">
                                    <input type="radio" name="correct_option" value="b" class="correct-radio">
                                    <label class="correct-label">إجابة صحيحة</label>
                                </div>
                            </div>
                            <input 
                                name="option_b" 
                                class="option-textarea" 
                                placeholder="اكتب الخيار الثاني..."
                                required
                            >{{ old('option_b') }}</input>
                        </div>
                        
                        <div class="option-item">
                            <div class="option-header">
                                <span class="option-number">ج</span>
                                <div class="option-controls">
                                    <input type="radio" name="correct_option" value="c" class="correct-radio">
                                    <label class="correct-label">إجابة صحيحة</label>
                                </div>
                            </div>
                            <input
                                name="option_c" 
                                class="option-textarea" 
                                placeholder="اكتب الخيار الثالث..."
                                required
                            >{{ old('option_c') }}</input>
                        </div>
                        
                        <div class="option-item">
                            <div class="option-header">
                                <span class="option-number">د</span>
                                <div class="option-controls">
                                    <input type="radio" name="correct_option" value="d" class="correct-radio">
                                    <label class="correct-label">إجابة صحيحة</label>
                                </div>
                            </div>
                            <input 
                                name="option_d" 
                                class="option-textarea" 
                                placeholder="اكتب الخيار الرابع..."
                                required
                            >{{ old('option_d') }}</input>
                        </div>
                    </div>
                </div>

       

            

                <!-- Explanation -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-lightbulb"></i>
                        شرح الإجابة (اختياري)
                    </label>
                    <textarea 
                        name="explanation" 
                        rows="3" 
                        class="form-textarea" 
                        placeholder="اكتب شرحاً للإجابة الصحيحة..."
                    >{{ old('explanation') }}</textarea>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        حفظ السؤال
                    </button>
                    <a href="{{ route('dashboard.exams.show', $exam) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const questionTypeRadios = document.querySelectorAll('input[name="question_type"]');
    const multipleChoiceOptions = document.getElementById('multiple_choice_options');
    const trueFalseOptions = document.getElementById('true_false_options');
    const essayOptions = document.getElementById('essay_options');

    function showOptionsForType(type) {
        // Hide all option sections
        multipleChoiceOptions.style.display = 'none';
        trueFalseOptions.style.display = 'none';
        essayOptions.style.display = 'none';

        // Show the appropriate section
        switch(type) {
            case 'multiple_choice':
                multipleChoiceOptions.style.display = 'block';
                break;
            case 'true_false':
                trueFalseOptions.style.display = 'block';
                break;
            case 'essay':
                essayOptions.style.display = 'block';
                break;
        }
    }

    // Add event listeners to radio buttons
    questionTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            showOptionsForType(this.value);
        });
    });

    // Initialize with the selected type
    const selectedType = document.querySelector('input[name="question_type"]:checked').value;
    showOptionsForType(selectedType);
});
</script>
@endsection
