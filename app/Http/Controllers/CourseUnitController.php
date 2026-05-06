<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\CourseUnit;
use Illuminate\Http\Request;

class CourseUnitController extends Controller
{
    public function index()
    {
        $courseUnits = CourseUnit::with('program')->get();
        return view('courseUnit.index', compact('courseUnits'));
    }

    public function create()
    {
        $programs = Program::all();
        return view('courseUnit.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'program_id' => 'nullable|exists:programs,id'
        ]);

        $courseUnit = CourseUnit::create($validated);
        return redirect()->route('courseUnit.index')->with('success', 'Course unit created successfully');
    }

    public function show($id)
    {
        $courseUnit = CourseUnit::findOrFail($id);
        return view('courseUnit.show', compact('courseUnit'));
    }

    public function edit(CourseUnit $courseUnit)
    {
        $programs = Program::all();
        return view('courseUnit.edit', compact('courseUnit', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'program_id' => 'nullable|exists:programs,id'
        ]);
        
        $courseUnit = CourseUnit::findOrFail($id);
        $courseUnit->update($validated);
        
        return redirect()->route('courseUnit.index')->with('success', 'Course unit updated successfully');
    }

    public function destroy(CourseUnit $courseUnit)
    {
        $courseUnit->delete();
        return redirect()->route('courseUnit.index')->with('success', 'Course unit deleted successfully');
    }
}