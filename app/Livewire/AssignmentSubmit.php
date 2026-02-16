<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AssignmentSum;
use Illuminate\Support\Facades\Auth;

/**
 * Livewire component: submit assignment (file + notes) for a lecture.
 * Uses AssignmentSum model.
 */
class AssignmentSubmit extends Component
{
    use WithFileUploads;

    public $lec_id;
    public $notes = '';
    public $homework_file;
    public $isSubmitted = false;

    public function mount($lec_id)
    {
        $this->lec_id = $lec_id;
    }

    public function submit()
    
    {

        $this->validate([
            'homework_file' => 'required|file|mimes:pdf,doc,docx,txt,zip,rar|max:5120', // 5MB كحد أقصى
            'notes' => 'nullable|string|max:500',
        ]);

        try {
            // تخزين الملف
            $filePath = $this->homework_file->store('assignments', 'public');
            
            // حفظ البيانات في قاعدة البيانات
            AssignmentSum::create([
                'lecture_id' => $this->lec_id,
                'user_id' => Auth::id(),
                'file_path' => $filePath,
                'notes' => $this->notes,
                'submitted_at' => now(),
            ]);

            // إعادة تعيين الحقول
            $this->reset(['homework_file', 'notes']);
            $this->isSubmitted = true;
            
            session()->flash('success', 'تم تسليم الواجب بنجاح!');
            
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء تسليم الواجب: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.assignment-submit');
    }
}