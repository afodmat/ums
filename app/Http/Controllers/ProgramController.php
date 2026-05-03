<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('program.index', compact('programs'));
    }

    public function create()
    {
        return view('program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_name'=> 'required|max:255|unique:programs,program_name',
            'duration_years'=> 'required|integer|min:1|max:10',
            'duration_semesters'=> 'required|integer|min:2|max:20',
            'fees'=>'required|numeric|min:0',
            'description'=>'nullable|string',
            'degree_type'=>'required|in:Bachelor,Master,PhD,Diploma,Certificate',
            'status'=>'in:active,inactive',
            'entry_requirements'=> 'nullable|string',
        ]);
        
        $program = Program::create($validated); 
        
        return redirect()->route('program.index')->with('success', "Program {$program->program_name} ({$program->program_code}) created successfully");
    }

    public function show(Program $program) // Using route model binding
    {
        return view('program.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('program.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'program_name'=> 'required|max:255|unique:programs,program_name,' . $program->id,
            'duration_years'=> 'required|integer|min:1|max:10',
            'duration_semesters'=> 'required|integer|min:2|max:20',
            'fees'=>'required|numeric|min:0',
            'description'=>'nullable|string',
            'degree_type'=>'required|in:Bachelor,Master,PhD,Diploma,Certificate',
            'status'=>'required|in:active,inactive',
            'entry_requirements'=> 'nullable|string',
        ]);
        
        $program->update($validated);
        
        return redirect()->route('program.index')->with('success', 'Program updated successfully');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('program.index')->with('success', 'Program deleted successfully');
    }
}