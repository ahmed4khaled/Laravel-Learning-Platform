@extends('layout.app')

@section('title', 'تعديل السؤال')

@section('content')
<link rel="stylesheet" href="{{ asset('assest/css/dashboard.css') }}">

<div class="dashboard-container">
    <div class="dashboard-content">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="flex justify-between items-center">
                <div>
                    <h1>تعديل السؤال</h1>
                    <p>قم بتعديل السؤال: {{ $question->question_text }}</p>
                </div>
                <a href="{{ route('dashboard.exams.show', $question->exam) }}" class="btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    العودة للامتحان
                </a>
            </div>
        </div>

        <!-- Question Form -->
        <div class="form-section">
            <form action="{{ route('dashboard.questions.update', $question) }}" method="POST" class="question-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Question Type Selection -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-list-ul"></i>
                        نوع السؤال
                    </label>
                    <div class="question-type-selector">
                        <div class="type-option" data-type="multiple_choice">
                            <input type="radio" name="question_type" value="multiple_choice" id="type_multiple" class="hidden" {{ $question->question_type == 'multiple_choice' ? 'checked' : '' }}>
                            <label for="type_multiple" class="type-label">
                                <i class="fas fa-list-ul"></i>
                                <span>اختيار من متعدد</span>
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
                    <textarea 
                        name="question" 
                        rows="4" 
                        class="form-textarea" 
                        placeholder="اكتب نص السؤال هنا..."
                        required
                    >{{ old('question', $question->question) }}</textarea>
                    @error('question')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Question Image -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-image"></i>
                        صورة السؤال (اختياري)
                    </label>
                    
                    <!-- Current Image Preview -->
                    @if($question->image_path)
                    <div class="current-image-preview mb-4">
                        <p class="text-sm text-gray-600 mb-2">الصورة الحالية:</p>
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $question->image_path) }}" alt="صورة السؤال" class="question-image">
                            <div class="image-actions mt-2">
                                <a href="{{ asset('storage/' . $question->image_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm mr-3">
                                    <i class="fas fa-eye"></i> عرض الصورة
                                </a>
                                <button type="button" onclick="removeImage()" class="text-red-600 hover:text-red-800 text-sm">
                                    <i class="fas fa-trash"></i> حذف الصورة
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Image Upload -->
                    <div class="image-upload-container">
                        <input 
                            type="file" 
                            name="question_image" 
                            id="question_image" 
                            class="file-input hidden" 
                            accept="image/*"
                        >
                        <label for="question_image" class="upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>اختر صورة للسؤال</span>
                        </label>
                        <div id="image-preview" class="image-preview hidden">
                            <img id="preview-img" src="" alt="معاينة الصورة">
                            <button type="button" onclick="clearImage()" class="remove-image-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    @error('question_image')
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
                        name="points" 
                        min="1" 
                        max="100" 
                        class="form-input" 
                        value="{{ old('points', $question->mark) }}"
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
                        <input type="checkbox" name="is_active" id="is_active" class="toggle-input" {{ $question->is_active ? 'checked' : '' }}>
                        <label for="is_active" class="toggle-label">
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-text">نشط</span>
                    </div>
                </div>

                <!-- Multiple Choice Options -->
                <div id="multiple_choice_options" class="options-section" {{ $question->question_type == 'multiple_choice' ? '' : 'style="display: none;"' }}>
                    <h4 class="section-title">
                        <i class="fas fa-list-ul"></i>
                        خيارات الإجابة
                    </h4>
                    <div class="options-container">
                        @php
                            $options = json_decode($question->options, true) ?? [];
                            $correctAnswer = $question->correct_answer;
                        @endphp
                        
                        <div class="option-item">
                            <div class="option-header">
                                <span class="option-number">أ</span>
                                <div class="option-controls">
                                    <input type="radio" name="correct_answer" value="0" class="correct-radio" {{ $correctAnswer == '0' ? 'checked' : '' }} required>
                                    <label class="correct-label">إجابة صحيحة</label>
                                </div>
                            </div>
                            <textarea 
                                name="options[0]" 
                                class="option-textarea" 
                                placeholder="اكتب الخيار الأول..."
                                required
                            >{{ old('options.0', $options[0] ?? '') }}</textarea>
                        </div>
                        
                        <div class="option-item">
                            <div class="option-header">
                                <span class="option-number">ب</span>
                                <div class="option-controls">
                                    <input type="radio" name="correct_answer" value="1" class="correct-radio" {{ $correctAnswer == '1' ? 'checked' : '' }}>
                                    <label class="correct-label">إجابة صحيحة</label>
                                </div>
                            </div>
                            <textarea 
                                name="options[1]" 
                                class="option-textarea" 
                                placeholder="اكتب الخيار الثاني..."
                                required
                            >{{ old('options.1', $options[1] ?? '') }}</textarea>
                        </div>
                        
                        <div class="option-item">
                            <div class="option-header">
                                <span class="option-number">ج</span>
                                <div class="option-controls">
                                    <input type="radio" name="correct_answer" value="2" class="correct-radio" {{ $correctAnswer == '2' ? 'checked' : '' }}>
                                    <label class="correct-label">إجابة صحيحة</label>
                                </div>
                            </div>
                            <textarea 
                                name="options[2]" 
                                class="option-textarea" 
                                placeholder="اكتب الخيار الثالث..."
                                required
                            >{{ old('options.2', $options[2] ?? '') }}</textarea>
                        </div>
                        
                        <div class="option-item">
                            <div class="option-header">
                                <span class="option-number">د</span>
                                <div class="option-controls">
                                    <input type="radio" name="correct_answer" value="3" class="correct-radio" {{ $correctAnswer == '3' ? 'checked' : '' }}>
                                    <label class="correct-label">إجابة صحيحة</label>
                                </div>
                            </div>
                            <textarea 
                                name="options[3]" 
                                class="option-textarea" 
                                placeholder="اكتب الخيار الرابع..."
                                required
                            >{{ old('options.3', $options[3] ?? '') }}</textarea>
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
                    >{{ old('explanation', $question->explanation) }}</textarea>
                </div>

                <!-- Hidden field for image removal -->
                <input type="hidden" name="remove_image" id="remove_image" value="0">

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        حفظ التعديلات
                    </button>
                    <a href="{{ route('dashboard.exams.show', $question->exam) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        إلغاء
                    </a>
                    <button type="button" class="btn btn-danger" onclick="deleteQuestion()">
                        <i class="fas fa-trash"></i>
                        حذف السؤال
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>تأكيد الحذف</h3>
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p>هل أنت متأكد من حذف هذا السؤال؟</p>
            <p class="text-sm text-gray-600">لا يمكن التراجع عن هذا الإجراء.</p>
        </div>
        <div class="modal-actions">
            <form action="{{ route('dashboard.questions.destroy', $question) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    نعم، احذف
                </button>
            </form>
            <button onclick="closeDeleteModal()" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                إلغاء
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const questionTypeRadios = document.querySelectorAll('input[name="question_type"]');
    const multipleChoiceOptions = document.getElementById('multiple_choice_options');

    function showOptionsForType(type) {
        // Hide all option sections
        multipleChoiceOptions.style.display = 'none';

        // Show the appropriate section
        if(type === 'multiple_choice') {
            multipleChoiceOptions.style.display = 'block';
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

    // Image preview functionality
    const imageInput = document.getElementById('question_image');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
});

function clearImage() {
    const imageInput = document.getElementById('question_image');
    const imagePreview = document.getElementById('image-preview');
    
    imageInput.value = '';
    imagePreview.classList.add('hidden');
}

function removeImage() {
    document.getElementById('remove_image').value = '1';
    document.querySelector('.current-image-preview').style.display = 'none';
    // Also clear any newly selected image
    clearImage();
}

function deleteQuestion() {
    document.getElementById('deleteModal').style.display = 'block';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('deleteModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

<style>
.image-upload-container {
    border: 2px dashed #d1d5db;
    border-radius: 0.5rem;
    padding: 1.5rem;
    text-align: center;
    transition: border-color 0.3s;
}

.image-upload-container:hover {
    border-color: #3b82f6;
}

.upload-label {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    color: #6b7280;
    transition: color 0.3s;
}

.upload-label:hover {
    color: #3b82f6;
}

.upload-label i {
    margin-left: 0.5rem;
    font-size: 1.25rem;
}

.image-preview {
    position: relative;
    margin-top: 1rem;
    max-width: 300px;
    margin-left: auto;
    margin-right: auto;
}

.image-preview img {
    width: 100%;
    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
}

.remove-image-btn {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #ef4444;
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: none;
}

.question-image {
    max-width: 300px;
    max-height: 200px;
    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
}

.current-image-preview {
    padding: 1rem;
    background-color: #f9fafb;
    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
}

.hidden {
    display: none;
}
</style>
@endsection