<div class="max-w-lg mx-auto bg-white shadow-lg rounded-2xl p-6 mt-10 border border-gray-200">

    <!-- العنوان -->
    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
        📄 <span>تسليم الواجب</span>
    </h2>

    {{-- رسالة نجاح --}}
    @if($isSubmitted)
        <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-sm">
            <p class="font-medium">تم تسليم الواجب بنجاح ✅</p>
        </div>
    @endif

    {{-- رسالة خطأ --}}
    @if (session()->has('error'))
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-4 shadow-sm">
            <p class="font-medium">{{ session('error') }}</p>
        </div>
    @endif

    {{-- رسالة عادية --}}
    @if (session()->has('message'))
        <div class="bg-blue-50 border border-blue-300 text-blue-700 px-4 py-3 rounded-lg mb-4 shadow-sm">
            <p class="font-medium">{{ session('message') }}</p>
        </div>
    @endif

    <!-- تنبيهات هامة -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-yellow-800 mb-2">⚠️ تنبيهات هامة:</h3>
        <ul class="list-disc list-inside text-sm text-yellow-700 space-y-1">
            <li>يجب أن يكون الملف بصيغة <span class="font-bold">PDF فقط</span>.</li>
            <li>تسليم الواجب في <span class="font-bold">نفس أسبوع الحصة</span> شرط لمشاهدة المحاضرات القادمة.</li>
            <li>عدم تسليم الواجب قد يؤدي إلى <span class="font-bold text-red-600">منعك من المنصة</span>.</li>
            <li>الواجب جزء أساسي وضروري من عملية التعلم.</li>
        </ul>
    </div>

    <!-- رفع الملفات -->
    <div class="mb-6">
        <label for="homework_file" class="block text-sm font-semibold text-gray-800 mb-2">
            📂 اختر ملف الواجب
        </label>

        <input type="file" id="homework_file" wire:model="homework_file"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">

        {{-- خطأ في الفالديشن --}}
        @error('homework_file')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        {{-- اسم الملف --}}
        @if($homework_file)
            <p class="text-sm text-gray-600 mt-3 bg-gray-50 px-3 py-2 rounded-lg border">
                📑 الملف: <span class="font-medium">{{ $homework_file->getClientOriginalName() }}</span>
                <span class="text-gray-400">
                    ({{ number_format($homework_file->getSize() / 1024, 2) }} KB)
                </span>
            </p>
        @endif
          <div x-show="progress > 0" class="mt-4">
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-500 h-3 rounded-full transition-all duration-300"
                     :style="`width: ${progress}%;`"></div>
            </div>
            <p class="text-blue-500 text-sm mt-2" x-text="`⏳ جاري رفع الملف... ${progress}%`"></p>
        </div>

        {{-- مؤشر التحميل --}}
        <div wire:loading wire:target="homework_file" class="text-blue-500 text-sm mt-2 animate-pulse">
            ⏳ جاري رفع الملف...
        </div>
    </div>

    <!-- زر التسليم -->
    <div class="flex justify-end">
        <button wire:click="submit" wire:loading.attr="disabled"
            class="relative bg-blue-600 hover:bg-blue-700 text-white font-semibold 
                   px-6 py-2 rounded-lg shadow-md flex items-center gap-2
                   transition duration-200 ease-in-out">

            {{-- مؤشر دوران وقت التسليم --}}
            <span wire:loading wire:target="submit"
                  class="inline-block h-5 w-5 border-2 border-white border-t-transparent rounded-full animate-spin"></span>

            {{-- النص العادي --}}
            <span wire:loading.remove wire:target="submit">📤 تسليم الواجب</span>

            {{-- النص وقت التسليم --}}
            <span wire:loading wire:target="submit">جاري التسليم...</span>
        </button>
    </div>

</div>
