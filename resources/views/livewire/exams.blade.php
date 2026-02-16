<main class="main">
    <section class="exam-page section" id="exam-page">
        <div class="container">
            <div class="exam-container animate-on-load animate-delay-2">

                {{-- زر بدء الامتحان --}}
@if (!$examStarted && !$examFinished && $currentAttempt < $maxAttempts )
                    <div class="text-center mt-5">
                        <button class="btn btn-primary btn-lg" wire:click="startExam">
                            ابدأ الامتحان
                        </button>
                    </div>
                @endif

                {{-- عرض المؤقت --}}
                @if ($examStarted && !$examFinished)
                    <div wire:poll.1000ms="countdown" class="exam-timer text-center mb-4">
                        <h4 class="text-danger">
                            الوقت المتبقي: 
                            {{ gmdate('i:s', $timeRemaining) }}
                        </h4>
                    </div>
                @endif

                {{-- عرض الأسئلة --}}
                @if ($examStarted && !$examFinished && $currentQuestion < count($questions))
                    @php $question = $questions[$currentQuestion]; @endphp

                    <div class="exam-card" id="examCard">
                        <div class="question-number">
                            السؤال <span>{{ $currentQuestion + 1 }}</span> من 
                            <span>{{ count($questions) }}</span>
                        </div>
<div class="question-text text-center">
    @if ($question->img)
        {{-- عرض الصورة إذا كانت موجودة --}}
        <img src="{{ asset('/assest/img/' . $question->img) }}" alt="السؤال" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
    @else
        <h3>{{ $question->question }}</h3>
    @endif
</div>

                       <div class="options-container">
    @foreach (['a', 'b', 'c', 'd'] as $letter)
        <label class="option" for="{{ $question->id }}-{{ $letter }}" style="cursor: pointer;">
            <input type="radio" 
                name="{{ $question->id }}"
                id="{{ $question->id }}-{{ $letter }}"
                value="{{ $letter }}"
                @if(isset($selectedAnswers[$question->id]) && $selectedAnswers[$question->id] == $letter) checked @endif
                wire:click="chooseAnswer({{ $question->id }}, '{{ $question->correct_option }}', '{{ $letter }}', {{ $question->mark }})">
            <span>{{ $letter }}</span>
        </label>
    @endforeach
</div>


                    <div class="exam-navigation">
                        <button class="btn btn-secondary" wire:click="previous" @if ($currentQuestion == 0) disabled @endif>
                            <i class="ri-arrow-right-line"></i> السابق
                        </button>

                        <button class="btn btn-primary" wire:click="next" @if ($currentQuestion == count($questions) - 1) style="display:none;" @endif>
                            التالي <i class="ri-arrow-left-line"></i>
                        </button>

                        @if ($currentQuestion == count($questions) - 1)
                            <button class="btn btn-primary submit-exam-btn" wire:click="submitExam">
                                إنهاء الامتحان <i class="ri-check-line"></i>
                            </button>
                        @endif
                    </div>
                @endif

                {{-- عرض النتائج --}}
                @if ($examFinished && count($allAttempts) <= 1)
                    <div class="results-section mt-5" id="resultsSection">
                        <h3 class="results-title">نتائج الامتحان</h3>
                        <p class="score-display text-lg">
                            الدرجة: {{ $score }} من {{ $totalScore }}
                        </p>

                        @if ($showLecture)
                            <div class="lecture-content mt-4 p-4 bg-success text-white rounded">
                                <h3>🎉 تهانينا، تم فتح المحاضرة!</h3>
                                <a href="{{ route('course.1', [ $grade , $lec_id, 1]) }}" class="btn btn-light mt-3">
                                    مشاهدة المحاضرة الآن
                                </a>
                            </div>
                        @endif

                        {{-- إعادة المحاولة لو لسه فيه محاولات --}}
@if ($currentAttempt < $maxAttempts )
                            <button class="btn btn-primary mt-4" wire:click="startExam">
                                <span>إعادة الامتحان</span>
                                <i class="ri-refresh-line"></i>
                            </button>
                        @elseif ($currentAttempt >= $maxAttempts)
                            <div class="alert alert-warning mt-4">
                                لقد استنفدت جميع المحاولات.
                            </div>
                        @endif
                    </div>
                @endif
                {{-- جدول المحاولات السابقة --}}
                @if (count($allAttempts) > 0)
                    <div class="previous-attempts mt-5">
                        <h4>📜 المحاولات السابقة:</h4>
                        <table class="table table-bordered mt-3  table table-bordered previous-attempts-table mt-3">
                            <thead>
                                <tr>
                                    <th>رقم المحاولة</th>
                                    <th>الدرجة</th>
                                    <th>رابط الأسئلة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allAttempts as $attempt)
                                    <tr>
                                        <td>{{ $attempt->attempt }}</td>
                                        <td>{{ $attempt->total }} / {{ $totalScores }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary"
                                               href="{{ route('exam.answers', ['exam' => $exam->id, 'attempt' => $attempt->attempt]) }}">
                                                عرض
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </section>
</main>
