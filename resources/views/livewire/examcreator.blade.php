<!-- resources/views/dashboard/exams/create.blade.php -->

@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle"></i> إنشاء امتحان جديد
                    </h4>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="submitExam">
                        <div class="row">
                            <!-- معلومات أساسية -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title">عنوان الامتحان</label>
                                    <input type="text" wire:model="title" class="form-control" required>
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description">وصف الامتحان</label>
                                    <textarea wire:model="description" class="form-control" rows="3" placeholder="وصف اختياري للامتحان..."></textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="lecture">المحاضرة المرتبطة</label>
                                    <select wire:model="lecture_id" class="form-control" required>
                                        <option value="">اختر المحاضرة</option>
                                        @foreach($lectures as $lecture)
                                            <option value="{{ $lecture->id }}">{{ $lecture->title ?? 'محاضرة ' . $lecture->id }}</option>
                                        @endforeach
                                    </select>
                                    @error('lecture_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- إعدادات الامتحان -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="duration_min">مدة الامتحان (دقائق)</label>
                                    <input type="number" wire:model="duration_min" class="form-control" min="1" required>
                                    @error('duration_min') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="max_attempts">عدد المحاولات المسموحة</label>
                                    <input type="number" wire:model="max_attempts" class="form-control" min="1" value="3" required>
                                    @error('max_attempts') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pass_score">درجة النجاح</label>
                                    <input type="number" wire:model="pass_score" class="form-control" min="1" max="100" required>
                                    @error('pass_score') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="start_date">تاريخ بداية الامتحان</label>
                                    <input type="datetime-local" wire:model="start_date" class="form-control">
                                    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="end_date">تاريخ انتهاء الامتحان</label>
                                    <input type="datetime-local" wire:model="end_date" class="form-control">
                                    @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input type="checkbox" wire:model="is_active" class="form-check-input" id="is_active">
                                    <label class="form-check-label" for="is_active">
                                        الامتحان نشط
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- إضافة الأسئلة -->
                        <div class="mt-4 border-top pt-3">
                            <h5 class="mb-3">
                                <i class="fas fa-question-circle"></i> أسئلة الامتحان
                                <button type="button" wire:click="addQuestion" class="btn btn-sm btn-success float-start">
                                    <i class="fas fa-plus"></i> إضافة سؤال
                                </button>
                            </h5>

                            <div class="questions-container">
                                @foreach($questions as $index => $question)
                                    <div class="question-card mb-4 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <button type="button" wire:click="removeQuestion({{ $index }})" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group mb-3">
                                                            <label>نص السؤال</label>
                                                            <textarea wire:model="questions.{{ $index }}.question" class="form-control" rows="2" required></textarea>
                                                            @error("questions.{$index}.question") <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>نوع السؤال</label>
                                                            <select wire:model="questions.{{ $index }}.question_type" wire:change="updateQuestionType({{ $index }}, $event.target.value)" class="form-control" required>
                                                                <option value="multiple_choice">اختيار من متعدد</option>
                                                                <option value="true_false">صح أو خطأ</option>
                                                                <option value="essay">مقالي</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>درجة السؤال</label>
                                                            <input type="number" wire:model="questions.{{ $index }}.points" class="form-control" min="1" required>
                                                            @error("questions.{$index}.points") <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>شرح الإجابة (اختياري)</label>
                                                            <input type="text" wire:model="questions.{{ $index }}.explanation" class="form-control" placeholder="شرح الإجابة الصحيحة">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" wire:model="questions.{{ $index }}.is_active" class="form-check-input" id="question_active_{{ $index }}">
                                                            <label class="form-check-label" for="question_active_{{ $index }}">
                                                                السؤال نشط
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- خيارات الإجابة (للأسئلة متعددة الخيارات) -->
                                                @if($question['question_type'] === 'multiple_choice')
                                                    <div class="options-container mt-3">
                                                        <h6>خيارات الإجابة:</h6>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label>الخيار أ</label>
                                                                    <input type="text" wire:model="questions.{{ $index }}.option_a" class="form-control" required>
                                                                    @error("questions.{$index}.option_a") <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label>الخيار ب</label>
                                                                    <input type="text" wire:model="questions.{{ $index }}.option_b" class="form-control" required>
                                                                    @error("questions.{$index}.option_b") <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label>الخيار ج</label>
                                                                    <input type="text" wire:model="questions.{{ $index }}.option_c" class="form-control" required>
                                                                    @error("questions.{$index}.option_c") <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label>الخيار د</label>
                                                                    <input type="text" wire:model="questions.{{ $index }}.option_d" class="form-control" required>
                                                                    @error("questions.{$index}.option_d") <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <label>الإجابة الصحيحة</label>
                                                                    <select wire:model="questions.{{ $index }}.correct_option" class="form-control" required>
                                                                        <option value="">اختر الإجابة الصحيحة</option>
                                                                        <option value="a">أ</option>
                                                                        <option value="b">ب</option>
                                                                        <option value="c">ج</option>
                                                                        <option value="d">د</option>
                                                                    </select>
                                                                    @error("questions.{$index}.correct_option") <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- خيارات الإجابة (للأسئلة صح أو خطأ) -->
                                                @if($question['question_type'] === 'true_false')
                                                    <div class="options-container mt-3">
                                                        <h6>خيارات الإجابة:</h6>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <label>الإجابة الصحيحة</label>
                                                                    <select wire:model="questions.{{ $index }}.correct_option" class="form-control" required>
                                                                        <option value="">اختر الإجابة الصحيحة</option>
                                                                        <option value="true">صح</option>
                                                                        <option value="false">خطأ</option>
                                                                    </select>
                                                                    @error("questions.{$index}.correct_option") <span class="text-danger">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- ملاحظة للأسئلة المقالية -->
                                                @if($question['question_type'] === 'essay')
                                                    <div class="alert alert-info mt-3">
                                                        <i class="fas fa-info-circle"></i>
                                                        <strong>ملاحظة:</strong> الأسئلة المقالية تحتاج إلى تقييم يدوي من قبل المعلم.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- زر الإرسال -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> إنشاء الامتحان
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection