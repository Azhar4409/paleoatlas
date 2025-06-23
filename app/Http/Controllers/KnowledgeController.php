<?php

namespace App\Http\Controllers;

use App\Models\Knowledge;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $knowledges = Knowledge::latest()->paginate(10);
        return view('back.knowledge.index', compact('knowledges'));
    }

    public function create()
    {
        return view('back.knowledge.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
        Knowledge::create($request->all());
        return redirect()->route('knowledge.index')->with('success', 'Knowledge created!');
    }

    public function edit(Knowledge $knowledge)
    {
        return view('back.knowledge.edit', compact('knowledge'));
    }

    public function update(Request $request, Knowledge $knowledge)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $knowledge->update($request->all());
        return redirect()->route('knowledge.index')->with('success', 'Knowledge updated!');
    }

    public function destroy(Knowledge $knowledge)
    {
        $knowledge->delete();
        return redirect()->route('knowledge.index')->with('success', 'Knowledge deleted!');
    }
}
