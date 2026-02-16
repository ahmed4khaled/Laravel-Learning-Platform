# Database

## Migrations

Migrations follow Laravel conventions and are ordered by date. Table names match the refactored models:

| Table            | Model          |
|------------------|----------------|
| `users`          | User           |
| `user_sessions`  | UserSession    |
| `lectures`       | Lecture        |
| `exams`          | Exam           |
| `questions`      | Question       |
| `exam_results`   | ExamResult     |
| `student_answers`| StudentAnswer  |
| `qrs`            | QrCode         |
| `sells`          | Sale           |
| `questionlecs`   | QuestionLec    |
| `answerlecs`     | AnswerLec      |
| `commentsans`    | Commentsans    |
| `assignmentsums` | AssignmentSum  |

- Each migration has a short PHPDoc describing the table/purpose.
- All migrations implement `down()` for rollback.
- Anonymous class style: `return new class extends Migration { ... };`

## Seeders

- **DatabaseSeeder**: entry point; add `$this->call([...])` for other seeders.

## Factories

- **UserFactory**: default Jetstream/Factory; adjust for app (e.g. `Phone` instead of `email` if needed).
