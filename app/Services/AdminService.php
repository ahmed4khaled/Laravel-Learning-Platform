<?php

namespace App\Services;

use App\Models\Lecture;
use App\Models\User;
use App\Models\QrCode;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Handles admin dashboard business logic: users, QR codes, lectures, and sales.
 */
class AdminService
{
    /**
     * Get dashboard data for a given grade and state filter.
     *
     * @return array{view: string, data: array}
     */
    public function getDashboardData(int $gradeId, string $state): array
    {
        $usersByGrade = [
            1 => User::where('class', 'grade1')->get(),
            2 => User::where('class', 'grade2')->get(),
            3 => User::where('class', 'grade3')->get(),
        ];

        $lecturesByGrade = [
            1 => Lecture::where('grade', 1)->get(),
            2 => Lecture::where('grade', 2)->get(),
            3 => Lecture::where('grade', 3)->get(),
        ];

        $users1 = $usersByGrade[1] ?? collect();
        $users2 = $usersByGrade[2] ?? collect();
        $users3 = $usersByGrade[3] ?? collect();
        $lec1 = $lecturesByGrade[1] ?? collect();
        $lec2 = $lecturesByGrade[2] ?? collect();
        $lec3 = $lecturesByGrade[3] ?? collect();

        $stds = ($usersByGrade[$gradeId] ?? collect())->where('type', $state);
        $Lecs = $lecturesByGrade[$gradeId] ?? collect();

        $payload = [
            'stds' => $stds,
            'Lecs' => $Lecs,
            'numone' => $users1->where('type', $state),
            'numtwo' => $users2->where('type', $state),
            'numthree' => $users3->where('type', $state),
        ];

        $role = Auth::user()->role;
        $view = ($role === 'inst' && in_array($gradeId, [2, 3])) ? 'ashboardinst' : 'ashboard';

        return ['view' => $view, 'data' => $payload];
    }

    /**
     * Generate and store QR codes.
     *
     * @return array{codes: array<int, string>}
     */
    public function createQrCodes(array $input): array
    {
        $numGenerates = (int) ($input['qr'] ?? 0);
        $char = '123456789';
        $passwordLength = 9;
        $codes = [];

        for ($j = 0; $j < $numGenerates; $j++) {
            $pass = '';
            for ($i = 0; $i < $passwordLength; $i++) {
                $pass .= $char[random_int(0, strlen($char) - 1)];
            }

            QrCode::create([
                'qr' => $pass,
                'discount' => $input['dis'] ?? null,
                'std' => $input['std'] ?? null,
                'copon' => $input['cop'] ?? null,
                'role' => $input['RoleQR'] ?? null,
            ]);
            $codes[] = $pass;
        }

        return ['codes' => $codes];
    }

    /**
     * Search QR codes by coupon, std, and role.
     */
    public function searchQrByCoupon(string $coupon, string $value, string $role)
    {
        return QrCode::where('copon', $coupon)
            ->where('std', $value)
            ->where('role', $role)
            ->get();
    }

    /**
     * Search QR codes by QR code value.
     */
    public function searchQrByCode(string $qrSearch)
    {
        return QrCode::where('qr', $qrSearch)->get();
    }

    /**
     * Search users by phone.
     */
    public function searchUsersByPhone(string $phone)
    {
        return User::where('Phone', $phone)->get();
    }

    /**
     * Search user by ID.
     */
    public function searchUserById(int $id)
    {
        return User::where('id', $id)->get();
    }

    /**
     * Create a new lecture from request data.
     */
    public function createLecture(array $input): Lecture
    {
        $lec = new Lecture();
        $lec->title = $input['title'] ?? '';
        $lec->description = $input['des'] ?? '';
        $lec->grade = $input['std'] ?? null;
        $lec->role = $input['RoleQR'] ?? null;
        $lec->Monthly = $input['Monthly'] ?? null;
        $lec->name0 = $input['subname'] ?? null;
        $lec->link0 = $input['link'] ?? null;
        $lec->Time = $input['Time'] ?? null;
        $lec->price = $input['price'] ?? null;
        $lec->exam_id = $input['exam'] ?? null;

        if (!empty($input['img_file'])) {
            $file = $input['img_file'];
            $file->move(public_path() . '_html/assest/img', $file->getClientOriginalName());
            $lec->img = $file->getClientOriginalName();
        }

        $lec->save();
        return $lec;
    }

    /**
     * Update user by ID.
     */
    public function updateUser(int $id, array $input): void
    {
        $update = [
            'name' => $input['Name'] ?? null,
            'Phone' => $input['Phone'] ?? null,
            'Phone_par' => $input['Phone_par'] ?? null,
        ];
        if (!empty($input['pass'])) {
            $update['password'] = Hash::make($input['pass']);
        }
        User::where('id', $id)->update($update);
    }

    /**
     * Get lectures for admin view by grade and role.
     *
     * @return array{Lec1: \Illuminate\Support\Collection, std: int, sell: \Illuminate\Database\Query\Builder}
     */
    public function getLecturesForAdmin(int $gradeId, string $role): array
    {
        $lecture = Lecture::where('role', $role)->where('grade', $gradeId)->get();
        return [
            'Lec1' => $lecture,
            'std' => $gradeId,
            'sell' => DB::table('sells'),
        ];
    }

    /**
     * Get lecture for editing (admin).
     */
    public function getLectureForEdit(int $gradeId, int $lectureId)
    {
        return Lecture::where('id', $lectureId)->where('grade', $gradeId)->first();
    }

    /**
     * Update lecture by ID and grade.
     */
    public function updateLecture(int $gradeId, int $lectureId, array $input): void
    {
        Lecture::where('id', $lectureId)->where('grade', $gradeId)->update([
            'title' => $input['Name'] ?? null,
            'description' => $input['File'] ?? null,
            'Time' => $input['Time'] ?? null,
            'Monthly' => $input['Month'] ?? null,
            'name0' => $input['name0'] ?? null,
            'link0' => $input['link0'] ?? null,
        ]);
    }

    /**
     * Get QR codes for a user.
     */
    public function getQrCodesForUser(int $userId): array
    {
        $qrs = QrCode::where('user_id', $userId)->get();
        return [
            'Lec1' => $qrs,
            'std' => $userId,
            'sell' => DB::table('sells'),
        ];
    }

    /**
     * Get sales (lecture purchases) for a user.
     */
    public function getSalesForUser(int $userId): array
    {
        $sales = Sale::where('user_id', $userId)->get();
        return [
            'Lec1' => $sales,
            'std' => $userId,
            'sell' => DB::table('sells'),
        ];
    }
}
