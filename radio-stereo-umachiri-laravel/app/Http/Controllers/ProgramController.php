<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all()->groupBy('day_of_week');
        $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        
        // Obtener programas destacados (si decides implementar esta funcionalidad)
        $featuredPrograms = Program::where('is_featured', true)->get();
        
        return view('programs.index', compact('programs', 'days', 'featuredPrograms'));
    }

    public function podcasts(Program $program)
    {
        $podcasts = $program->podcasts()->latest()->get();
        return view('programs.podcasts', compact('program', 'podcasts'));
    }
}