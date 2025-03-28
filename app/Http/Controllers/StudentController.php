<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a list of students
    public function index(Request $request)
    {
        // Initialize query for students
        $studentsQuery = Student::query();
    
        // Handle AJAX requests (name search)
        if ($request->ajax()) {
            $query = trim($request->input('searchS')); // Search query for name
            \Log::info('AJAX Search Name Query: ' . $query); // Debugging
    
            if (!empty($query)) {
                $studentsQuery->where('name', 'LIKE', "%{$query}%");
            }
    
            // Handle AJAX requests (age search)
            $ageQuery = trim($request->input('age')); // Search query for age
            \Log::info('AJAX Search Age Query: ' . $ageQuery); // Debugging
    
            if (!empty($ageQuery)) {
                $studentsQuery->where('age', '=', $ageQuery);
            }
    
            // Get the filtered students and return as JSON
            $students = $studentsQuery->get();
            return response()->json($students, 200);
        }
    
        // For regular requests (non-AJAX), handle both name and age filters
        if ($request->has('searchS')) {
            $query = $request->searchS;
            \Log::info('Regular Search Name Query: ' . $query); // Debugging
            $studentsQuery->where('name', 'LIKE', "%{$query}%");
        }
    
        if ($request->has('age')) {
            $ageQuery = $request->age;
            \Log::info('Regular Search Age Query: ' . $ageQuery); // Debugging
            $studentsQuery->where('age', '=', $ageQuery);
        }
    
        // Get the filtered students for regular request
        $students = $studentsQuery->get();
    
        // Return the view with students data
        return view('index', compact('students'));
    }

    

    // Show the form to create a new student
    public function create()
    {
        return view('create');
    }

    // Store a newly created student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer|min:1|max:100',
        ]);

        Student::create([
            'name' => $request->name,
            'age'  => $request->age,
        ]);

        return redirect()->route('views.index')->with('success', 'Student added successfully!');
    }

    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {

    }
    public function destroy($id) {}
}
