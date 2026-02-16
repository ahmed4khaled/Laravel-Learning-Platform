<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">المساعد والأسئلة</h2>
        
        <!-- فلتر الأسئلة -->
        <div class="mb-6">
            <div class="flex space-x-4 rtl:space-x-reverse">
                <button wire:click="$set('filter', 'all')" 
                        class="px-4 py-2 rounded-lg {{ $filter === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                    جميع الأسئلة
                </button>
                <button wire:click="$set('filter', 'answered')" 
                        class="px-4 py-2 rounded-lg {{ $filter === 'answered' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                    الأسئلة المجاب عنها
                </button>
                <button wire:click="$set('filter', 'unanswered')" 
                        class="px-4 py-2 rounded-lg {{ $filter === 'unanswered' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                    الأسئلة غير المجاب عنها
                </button>
            </div>
        </div>

        <!-- قائمة المحاضرات -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($lectures as $lecture)
                <div class="bg-gray-50 rounded-lg p-4 border {{ $selectedLectureId == $lecture->id ? 'border-blue-500' : 'border-gray-200' }}">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $lecture->title ?? 'محاضرة ' . $lecture->id }}</h3>
                        <button wire:click="toggleLecture({{ $lecture->id }})" 
                                class="text-blue-600 hover:text-blue-800">
                            {{ in_array($lecture->id, $expandedLectures) ? 'إخفاء' : 'عرض' }}
                        </button>
                    </div>
                    
                    <div class="text-sm text-gray-600 mb-3">
                        <p>إجمالي الأسئلة: {{ $lecture->questions_count }}</p>
                        <p>الأسئلة المجاب عنها: {{ $lecture->answered_questions_count }}</p>
                        <p>الأسئلة غير المجاب عنها: {{ $lecture->unanswered_questions_count }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- الأسئلة -->
        @if($selectedLectureId && $questions->count() > 0)
            <div class="space-y-6">
                <h3 class="text-xl font-semibold text-gray-800">أسئلة المحاضرة</h3>
                
                @foreach($questions as $question)
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <p class="text-gray-800 mb-2">{{ $question->content }}</p>
                                @dd($question->image)

                                @if($question->image)
                                    <img src="{{ asset('storage/' . $question->image) }}" alt="صورة السؤال"
                                         class="max-w-full h-auto rounded-lg mb-2">
                                @endif
                                
                                <div class="text-sm text-gray-500">
                                    <span>بواسطة: {{ $question->user->name ?? 'مستخدم' }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $question->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- الإجابات -->
                        @if($question->answers->count() > 0)
                            <div class="mt-4 space-y-3">
                                <h4 class="font-medium text-gray-700">الإجابات:</h4>
                                @foreach($question->answers as $answer)
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-gray-800 mb-2">{{ $answer->content }}</p>
                                        @if($answer->image)
                                            <img src="{{ asset('storage/' . $answer->image) }}" alt="صورة الإجابة"
                                                 class="max-w-full h-auto rounded-lg mb-2">
                                        @endif

                                        <div class="text-sm text-gray-500">
                                            <span>بواسطة: {{ $answer->user->name ?? 'مستخدم' }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ $answer->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- إضافة إجابة جديدة -->
                        <div class="mt-4">
                            <textarea wire:model="newAnswers.{{ $question->id }}" 
                                      placeholder="اكتب إجابتك هنا..."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      rows="3"></textarea>

                            <input type="file" wire:model="newAnswerImages.{{ $question->id }}" 
                                   class="mt-2 block w-full text-sm text-gray-500">

                            <button wire:click="submitAnswer({{ $question->id }})" 
                                    class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                إضافة إجابة
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($selectedLectureId)
            <div class="text-center py-8">
                <p class="text-gray-500">لا توجد أسئلة في هذه المحاضرة</p>
            </div>
        @endif
    </div>
</div>
