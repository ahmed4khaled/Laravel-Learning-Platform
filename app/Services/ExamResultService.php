<?php

namespace App\Services;

use App\Models\Exam;
use App\Models\ExamResult;
use Illuminate\Support\Collection;

/**
 * Handles exam results export (CSV/JSON), recalculate, and detailed report.
 */
/**
 * Exam results export (CSV), recalculate, and detailed report building.
 */
class ExamResultService
{
    /**
     * Build CSV download response with BOM for Arabic.
     *
     * @param  Collection  $results  Mapped rows (array of arrays)
     */
    public function streamCsv(Collection $results, string $filename): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($results) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            if ($results->count() > 0) {
                fputcsv($file, array_keys($results->first()));
            }
            foreach ($results as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Recalculate total and passed for a result.
     */
    public function recalculateResult(ExamResult $result): void
    {
        $totalScore = 0;
        foreach ($result->answers as $answer) {
            if ($answer->is_correct) {
                $totalScore += $answer->question->mark;
            }
        }
        $result->update([
            'total' => $totalScore,
            'passed' => $totalScore >= $result->exam->pass_score,
        ]);
    }

    /**
     * Build detailed report array for an exam.
     */
    public function buildDetailedReport(Exam $exam): array
    {
        $exam->load(['questions', 'results.user', 'results.answers.question']);

        return [
            'exam_info' => [
                'title' => $exam->title,
                'total_questions' => $exam->questions()->count(),
                'total_points' => $exam->total_points,
                'pass_score' => $exam->pass_score,
                'created_at' => $exam->created_at->format('Y-m-d H:i'),
            ],
            'overall_stats' => [
                'total_attempts' => $exam->results()->count(),
                'passed' => $exam->results()->where('passed', true)->count(),
                'failed' => $exam->results()->where('passed', false)->count(),
                'pass_rate' => $exam->pass_rate,
                'average_score' => $exam->results()->avg('total') ?? 0,
                'highest_score' => $exam->results()->max('total') ?? 0,
                'lowest_score' => $exam->results()->min('total') ?? 0,
            ],
            'question_analysis' => $exam->questions()->get()->map(function ($question) {
                $totalAnswers = $question->studentAnswers()->count();
                $correctAnswers = $question->studentAnswers()->where('is_correct', true)->count();
                return [
                    'question' => $question->question,
                    'type' => $question->question_type,
                    'mark' => $question->mark,
                    'total_answers' => $totalAnswers,
                    'correct_answers' => $correctAnswers,
                    'correct_rate' => $totalAnswers > 0 ? round(($correctAnswers / $totalAnswers) * 100, 2) : 0,
                ];
            }),
            'student_performance' => $exam->results()->with('user')->get()->map(function ($result) {
                return [
                    'student_name' => $result->user->name,
                    'student_number' => $result->user->Phone ?? null,
                    'score' => $result->total,
                    'percentage' => $result->percentage,
                    'grade' => $result->grade,
                    'passed' => $result->passed,
                    'attempt_date' => $result->created_at->format('Y-m-d H:i'),
                ];
            }),
        ];
    }
}
