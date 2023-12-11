@extends('layout.teacher')

@section('content')
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">Update Student Grades</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('storeStudentGrades', ['class' => $class_id, 'student' => $student_id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="averageGrade" class="form-label">Average Grade</label>
                        <input type="text" class="form-control" name="averageGrade" id="averageGrade" value="{{ old('averageGrade', $grades->averageGrade) }}">
                    </div>

                    <div class="mb-3">
                        <label for="quizGrade" class="form-label">Quiz Grade</label>
                        <input type="text" class="form-control" name="quizGrade" id="quizGrade" value="{{ old('quizGrade', $grades->quizGrade) }}">
                    </div>

                    <div class="mb-3">
                        <label for="projectGrade" class="form-label">Project Grade</label>
                        <input type="text" class="form-control" name="projectGrade" id="projectGrade" value="{{ old('projectGrade', $grades->projectGrade) }}">
                    </div>

                    <div class="mb-3">
                        <label for="assignmentGrade" class="form-label">Assignment Grade</label>
                        <input type="text" class="form-control" name="assignmentGrade" id="assignmentGrade" value="{{ old('assignmentGrade', $grades->assignmentGrade) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Grades</button>
                </form>
            </div>
        </div>
    </div>
@endsection('content')
