<div>
    <!-- نموذج إضافة سؤال جديد -->
    <div class="question-form mb-8 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4">اطرح سؤالاً جديداً</h3>
        <form wire:submit.prevent="submitQuestion">
            <textarea 
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                wire:model="newQuestion" 
                placeholder="اكتب سؤالك هنا بالتفصيل..." 
                rows="4"
                required
            ></textarea>
            @error('newQuestion') 
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
                        <!-- حقل رفع الصورة -->
            <div class="mt-3">
                <input 
                    type="file" 
                    wire:model="questionImage" 
                    accept="image/*" 
                    class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none"
                >
                @error('questionImage') 
                    <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> 
                @enderror

                <!-- معاينة الصورة قبل الإرسال -->
                @if ($questionImage)
                    <div class="mt-2">
                        <img src="{{ $questionImage->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-lg border">
                    </div>
                @endif
            </div>


            <div class="flex justify-end mt-3">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow"
                >
                    نشر السؤال
                </button>
            </div>
        </form>
    </div>

    <!-- قائمة الأسئلة -->
    <div class="question-list space-y-6">
        @foreach($questions as $question)
            <div class="question-item p-6 bg-white rounded-lg shadow-md border border-gray-100">
                <div class="question-header flex justify-between items-start mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 font-semibold">{{ substr($question->user->name ?? '?', 0, 1) }}</span>
                        </div>
                        <div>
                            <span class="question-user font-semibold text-gray-800 block">
                                {{ $question->user->name ?? 'مستخدم مجهول' }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $question->created_at ? $question->created_at->diffForHumans() : 'تاريخ غير معروف' }}
                            </span>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full 
                        {{ $question->user->role === 'Adm' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ $question->user->role === 'Adm' ? 'مساعد' : 'طالب' }}
                    </span>
                </div>
                
                <p class="question-text mb-4 text-gray-700 leading-relaxed">{{ $question->content }}</p>
                <!-- عرض صورة السؤال لو موجودة -->
                @if ($question->image)
                    <div class="mb-4">
                        
                       {{ asset($question->image) }} 
<img src="{{ asset($question->image) }}" alt="صورة السؤال">
                    </div>
                @endif
                <!-- زر عرض/إخفاء الإجابات -->
                <div class="flex justify-between items-center border-t border-gray-100 pt-3">
                    <button 
                        wire:click="toggleAnswers({{ $question->id }})" 
                        class="flex items-center text-blue-600 hover:text-blue-800 transition"
                    >
                        <span class="font-medium">
                            @if($showAnswersForQuestion === $question->id)
                                إخفاء الإجابات
                            @else
                                عرض الإجابات
                            @endif
                        </span>
                        <span class="mr-2 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                            {{ $question->answers->count() }}
                        </span>
                    </button>
                    
                    @if(auth()->user()->role === 'Adm' && $showAnswersForQuestion !== $question->id)
                        <button 
                            wire:click="toggleAnswers({{ $question->id }})"
                            class="text-sm bg-green-50 text-green-700 px-3 py-1 rounded hover:bg-green-100"
                        >
                            أجب على السؤال
                        </button>
                    @endif
                </div>

                <!-- عرض الإجابات إذا كانت ظاهرة -->
                @if($showAnswersForQuestion === $question->id)
                    <div class="answers-section mt-6 space-y-4">
                        @forelse($answers[$question->id] ?? [] as $answer)<!-- داخل عرض الإجابة -->

<div class="answer-item p-4 bg-gray-50 rounded-lg border border-gray-200">
    <div class="answer-header flex justify-between items-start mb-3">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 rounded-full 
                {{ $answer->user->role === 'Adm' ? 'bg-green-100' : 'bg-blue-100' }} 
                flex items-center justify-center">
                <span class="{{ $answer->user->role === 'Adm' ? 'text-green-600' : 'text-blue-600' }} text-sm font-semibold">
                    {{ substr($answer->user->name ?? '?', 0, 1) }}
                </span>
            </div>
            <div>
                <span class="answer-user font-medium text-gray-800 block text-sm">
                    {{ $answer->user->name ?? 'مستخدم مجهول' }}
                </span>
                <span class="text-xs text-gray-500">
                    {{ $answer->created_at ? $answer->created_at->diffForHumans() : 'تاريخ غير معروف' }}
                </span>
            </div>
        </div>
        <span class="px-2 py-1 text-xs rounded-full 
            {{ $answer->user->role === 'Adm' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
            {{ $answer->user->role === 'Adm' ? 'مساعد' : 'طالب' }}
        </span>
    </div>
    
    <!-- نص الإجابة -->
    <p class="answer-text text-gray-700 mb-3 pl-11">{{ $answer->content }}</p>
    @if($answer->image)
    <!-- صورة الإجابة لو موجودة -->
        <div class="mb-3 pl-11">
            <img src="{{ asset('storage/'.  $answer->image) }}" 
                 alt="صورة الإجابة" 
                 class="max-w-full rounded-lg border shadow-sm">
        </div>
        @endif


    <!-- التعليقات على الإجابة -->
    @if($answer->commentsan->count() > 0)
        <div class="comments-section mt-4 pl-11">
            <div class="border-l-2 border-gray-300 pl-4 space-y-3">
                @foreach($answer->commentsan as $comment)
                    <div class="comment-item py-2">
                        <div class="flex items-center space-x-2">
                            <span class="font-medium text-sm text-gray-800">{{ $comment->user->name }}</span>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">{{ $comment->content }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

                                
                                <!-- نموذج إضافة تعليق جديد (للطلاب فقط) -->
                                @if(auth()->user()->role === 'std')
                                    <div class="add-comment mt-4 pl-11">
                                        <div class="flex items-start space-x-2">
                                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mt-1">
                                                <span class="text-gray-600 text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                            </div>
                                            <div class="flex-1">
                                                <textarea
                                                    wire:model="newComments.{{ $answer->id }}"
                                                    class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-blue-500"
                                                    placeholder="أضف تعليقك على هذه الإجابة..."
                                                    rows="2"
                                                ></textarea>
                                                <div class="flex justify-end mt-2">
                                                    <button
                                                        wire:click="submitComment({{ $answer->id }})"
                                                        class="px-4 py-1 bg-gray-600 text-white text-sm rounded-lg hover:bg-gray-700 transition"
                                                    >
                                                        إرسال التعليق
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-4 text-gray-500">
                                لا توجد إجابات حتى الآن
                            </div>
                        @endforelse

                        <!-- نموذج إضافة إجابة جديدة (للمساعدين فقط) -->
                        @if(auth()->user()->role === 'Adm')
                            <div class="add-answer mt-6 bg-blue-50 p-4 rounded-lg">
                                <h4 class="font-medium text-blue-800 mb-3">أضف إجابة جديدة كمساعد</h4>
                                <textarea
                                    wire:model="newAnswers.{{ $question->id }}"
                                    class="w-full p-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                                    placeholder="اكتب إجابتك هنا..."
                                    rows="4"
                                ></textarea>
                                @error("newAnswers.$question->id") 
                                    <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> 
                                @enderror
                                <div class="flex justify-end mt-3">
                                    <button
                                        wire:click="submitAnswer({{ $question->id }})"
                                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                                    >
                                        نشر الإجابة
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- الترقيم الصفحي -->
    <div class="mt-8">
        {{ $questions->links() }}
    </div>
</div>