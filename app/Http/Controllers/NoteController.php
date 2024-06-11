<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class NoteController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // $user_id = Auth::id();
    // $notes = Note::where('user_id',$user_id)->latest('updated_at')->paginate(5);

    $notes = Auth::user()->notes()->with('transactions')->latest('updated_at')->paginate(5);
    return view('notes.index', compact('notes'));
    // return $notes;
    //dd($notes); 
    // $notes->each( function ($note)
    // {
    //     dump($note->title);
    // });

  }
  // 

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('notes.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|max:120',
      'text' => 'required'
    ]);

    Note::create([
      'uuid' => Str::uuid(),
      'user_id' => Auth::id(),
      'title' => $request->title,
      'text' => $request->text,

    ]);
    /*
      Auth::user()->notes()->create([
        'uuid'=> Str::uuid(),
        'title' => $request->title,
        'text' => $request->text,
        
      ]);*/

    return to_route('notes.index')->with('success', 'Note inserted successfully!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Note $note)
  {
    // validation to prevent seeing notes that belongs to other user
    //  if($note->user_id != Auth::id())
    //     return abort(403);

    if (!$note->user->is(Auth::user()))
      return abort(403);

    return view('notes.show')->with('note', $note);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Note $note)
  {
    if ($note->user_id != Auth::id())
      return abort(403);

    return view('notes.edit')->with('note', $note);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Note $note)
  {
    if ($note->user_id != Auth::id())
      return abort(403);

    $request->validate([
      'title' => 'required|max:120',
      'text' => 'required'
    ]);

    $note->update([
      'title' => $request->title,
      'text' => $request->text,
    ]);

    return to_route('notes.show', $note)->with('success', 'Note updated successfully!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Note $note)
  {
    if ($note->user_id != Auth::id())
      return abort(403);

    $note->delete();
    return to_route('notes.index')->with('success', 'Note moved to trash');
  }
}
