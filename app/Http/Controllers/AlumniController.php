<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Answer;
use App\Models\Calendar;
use App\Models\ClassT;
use App\Models\Event;
use App\Models\Question;
use App\Models\ReviewE;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AlumniController extends Controller {
    /**
     * Display a listing of the resource.
     */

    public function showLoginForm() {
        return view('auth.alumni-login');
    }
    public function showEdit($event) {
        $alumni = Alumni::find(session('alumni_id'));
        $alumniId = session('alumni_id');
        $alumni = Auth::guard('alumni')->user();

        $alumniFirstName = $alumni->getStudent->firstName;
        $alumniLastName = $alumni->getStudent->lastName;
        $event = Event::findOrFail($event);
        return view('alumni.EditEvent', compact('event', 'alumniFirstName', 'alumniLastName', 'alumni'));
    }
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('alumni')->attempt($credentials)) {
            $alumni = Auth::guard('alumni')->user();
            $request->session()->put('alumni_id', $alumni->id);
            return redirect()->intended('/alumni/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid login credentials']);
    }

    public function createEvent() {
        $alumni = Alumni::find(session('alumni_id'));
        $alumniId = session('alumni_id');
        $alumni = Auth::guard('alumni')->user();

        return view('alumni.createEvent', compact('alumni'));
    }
    public function LogoutAlumni() {
        auth()->guard('alumni')->logout();
        return redirect('/');
    }

    public function showDashboard(Request $request) {

        $alumni = Alumni::find(session('alumni_id'));
        $alumniId = session('alumni_id');
        $alumni = Auth::guard('alumni')->user();


        $graduationYear = $alumni->graduationYear;
        $departmentName = $alumni->getStudent->getDepartment->name;

        $eventsCount = $alumni->getEvent->count();

        $nonEventsCount = Event::whereDoesntHave('getAlumni', function ($query) use ($alumniId) {
            $query->where('id', $alumniId);
        })->count();

        // dd($nonEventsCount);
        // dd( $departmentName);
        // dd(Hash::make('12345678'));
        return view('alumni.dashboard', compact('alumni', 'graduationYear', 'departmentName', 'eventsCount', 'nonEventsCount'));
    }
    public function manageEvents(Request $request) {
        $alumniId = session('alumni_id');
        $alumni = Auth::guard('alumni')->user();
        $events = $alumni->getEvent;
    
        $alumniFirstName = $alumni->getStudent->firstName;
        $alumniLastName = $alumni->getStudent->lastName;
    
        return view('alumni.manageEvents', compact('alumni', 'events', 'alumniFirstName', 'alumniLastName'));
    }
    public function viewCalendar(Request $request) {
        $alumniId = session('alumni_id');
        $alumni = Alumni::find($alumniId);
        
        $events = Event::where('alumni_id', $alumniId)
            ->get(['id', 'title', 'startingtime', 'endingtime', 'time'])
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->time . ' ' . $event->startingtime,
                    'end' => $event->time . ' ' . $event->endingtime,
                ];
            });
        // dd($events);
        $class = ClassT::all();
        $student = Student::all();
        $teacher = Teacher::all();
        $calendar = Calendar::all();
    
        return view('alumni.viewCalendar', compact('alumni', 'events', 'student', 'teacher', 'class', 'calendar'));
    }
    

    public function manageQA(Request $request) {
        // $events = Event::all();
        $questions = Question::all();
        $answers = Answer::all();
        $student = Student::all();

        $alumni = Alumni::find(session('alumni_id'));
        $alumniId = session('alumni_id');
        $alumni = Auth::guard('alumni')->user();

        return view('alumni.manageQ&A', compact('alumni', 'student', 'questions', 'answers'));
    }
    public function submitAnswer(Request $request, $questionId) {
        $request->validate([
            'answer' => 'required|string|max:255',
        ]);

        // Retrieve the authenticated alumni
        $alumni = Auth::guard('alumni')->user();

        // Create a new answer
        $answer = new Answer();
        $answer->answer = $request->input('answer');
        $answer->question_id = $questionId;
        $answer->alumni_id = $alumni->id;
        $answer->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Answer submitted successfully!');
    }

    public function index() {
        $alumnis = Alumni::all();
        return redirect()->intended('/alumni/allalumnis')->with('alumni', $alumnis);
    }

    public function storeEvent(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            // 'time' => 'required|date',
            // 'startingtime' => 'required|date_format:Y-m-d\TH:i',
            // 'endingtime' => 'required|date_format:Y-m-d\TH:i|after:startingtime',
        ]);

        // Get the authenticated alumni
        $alumni = Auth::guard('alumni')->user();

        // Create a new event
        $event = new Event([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'time' => $request->input('time'),
            'startingtime' => $request->input('startingtime'),
            'endingtime' => $request->input('endingtime'),
            'alumni_id' => $alumni->id,
        ]);

        // Save the event
        $event->save();

        // Redirect back to the manage events page with a success message
        return redirect()->route('alumni.manageEvents')->with('success', 'Event created successfully!');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $students = Student::all();
        return view('auth.alumni-register', compact('students'));
        // return redirect()->intended('/admin/alumni/register')->with('student', $student);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request) {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $nalumni = new Alumni();
        $nalumni->graduationYear = date('Y');
        $nalumni->student_id = $request->input('student_id');

        // $students = Student::findOrFail($request->input('student_id'));
        // $nalumni->password = $student->password;
        // $nalumni->email = $student->email;

        $nalumni->save();

        return redirect(route("alumni.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumni) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni) {
        $ealumni = Alumni::findOrFail($alumni);
        return redirect()->intended('/alumni/EditEvent')->with('alumni', $ealumni);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni $alumuni) {
        $request->validate(['graduationYear' => 'required', 'student_id' => 'required',]);

        $ealumni = ReviewE::findOrFail($alumuni);
        $ealumni->graduationYear = date('Y');
        // $ealumni->email = $request->email;
        $ealumni->student_id = $request->student_id;
        // $ealumni->password = $request->password;
        $ealumni->save();
        return redirect(route("alumni.manageEvents"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni, $alumniId) {
        $dalumni = Alumni::findOrFail($alumniId);
        $dalumni->delete();
        $alumni->delete();
        return redirect(route("alumni.manageEvents"));
    }

    public function deleteEvent(Event $event) {
        $alumniId = session('alumni_id');
        $alumni = Auth::guard('alumni')->user();

        $event->delete();

        return redirect()->route("alumni.manageEvents")->with('success', 'Event deleted successfully!');
    }
    public function updateEvent(Request $request, Event $event) {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:255',
        ]);

        // Update the event with the validated data
        $event->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'time' => $request->input('time'),
            'startingtime' => $request->input('startingtime'),
            'endingtime' => $request->input('endingtime'),
        ]);

        return redirect()->route('alumni.manageEvents')->with('success', 'Event updated successfully!');
    }
}
