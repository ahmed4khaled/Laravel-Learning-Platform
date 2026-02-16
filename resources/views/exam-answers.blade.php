@extends('layout.app')
@include('layout.navbar')


@section('content')
    @livewire('solved-answers', ['exam' => $examId, 'attempt' => $attempt])
@endsection
