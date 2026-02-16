<!-- resources/views/dashboard/exams/index.blade.php -->

@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-clipboard-list"></i> قائمة الامتحانات
                        </h4>
                        <a href="{{ route('dashboard.exams.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus"></i> إنشاء جديد
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>اسم الامتحان</th>
                                    <th>الصف</th>
                                    <th>عدد الأسئلة</th>
                                    <th>المدة</th>
                                    <th>درجة النجاح</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($exams as $exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $exam->name }}</td>
                                        <td>{{ $exam->grade->name }}</td>
                                        <td>{{ $exam->questions_count }}</td>
                                        <td>{{ $exam->duration }} دقيقة</td>
                                        <td>{{ $exam->passing_score }}</td>
                                        <td>{{ $exam->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.exams.edit', $exam->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button wire:click="confirmDelete({{ $exam->id }})" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <a href="{{ route('dashboard.exams.show', $exam->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $exams->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection