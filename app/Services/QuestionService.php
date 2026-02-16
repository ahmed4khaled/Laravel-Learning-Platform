<?php

namespace App\Services;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * Handles question CRUD, import/export, reorder, and exam totals.
 */
/**
 * Question import/export and exam totals recalculation.
 * Shared by QuestionController and ExamController.
 */
class QuestionService
{
    /**
     * Recalculate exam total_questions and total_points from active questions.
     */
    public function updateExamTotals(Exam $exam): void
    {
        $totals = $exam->questions()
            ->where('is_active', true)
            ->selectRaw('COUNT(*) as total_questions, SUM(mark) as total_points')
            ->first();

        $exam->update([
            'total_questions' => $totals->total_questions ?? 0,
            'total_points' => $totals->total_points ?? 0,
        ]);
    }

    /**
     * Parse CSV and return array of question attributes for the exam.
     *
     * @return array<int, array<string, mixed>>
     */
    public function parseImportCsv(string $path, int $examId): array
    {
        $questions = [];
        if (($handle = fopen($path, 'r')) !== false) {
            fgetcsv($handle); // skip header
            while (($data = fgetcsv($handle)) !== false) {
                if (count($data) >= 4) {
                    $questions[] = [
                        'exam_id' => $examId,
                        'question' => $data[0],
                        'question_type' => $data[1],
                        'option_a' => $data[2] ?? null,
                        'option_b' => $data[3] ?? null,
                        'option_c' => $data[4] ?? null,
                        'option_d' => $data[5] ?? null,
                        'correct_option' => $data[6] ?? null,
                        'mark' => $data[7] ?? 1,
                        'explanation' => $data[8] ?? null,
                        'is_active' => true,
                    ];
                }
            }
            fclose($handle);
        }
        return $questions;
    }
}
