<main class="main">
    <section class="exam-page section">
        <div class="container ash">
            <h2 class="mb-4">مراجعة الإجابات للمحاولة رقم {{ $attempt }}</h2>

            @foreach ($questions as $index => $question)
                @php
                    $studentAnswer = $studentAnswers[$question->id]['selected_option'] ?? null;
                @endphp

                <div class="mb-4 p-3 border rounded">
                    <p><strong>السؤال {{ $index + 1 }}:</strong> {{ $question->question }}</p>

                    @foreach (['a', 'b', 'c', 'd'] as $option)
                        @php
                            $isCorrect = $question->correct_option === $option;
                            $isSelected = $studentAnswer === $option;
                        @endphp

                        <div class="ms-3">
                            <label style="display: block; padding: 5px; border-radius: 5px;{{ $isCorrect ? ' background-color: #d4edda;' : '' }}{{ $isSelected && !$isCorrect ? ' background-color: #f8d7da;' : '' }}">
                                <input type="radio" disabled {{ $isSelected ? 'checked' : '' }}>
                                <span>{{ $option }}. {{ $question[$option] }}</span>
                            </label>
                        </div>
                    @endforeach

                    @if (is_null($studentAnswer))
                        <p class="text-danger mt-2">لم تقم بالإجابة على هذا السؤال.</p>
                    @endif
                </div>
            @endforeach

          <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">
    الرجوع للخلف
</a>

        </div>
    </section>
</main>
