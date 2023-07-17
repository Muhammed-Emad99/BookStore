<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
//    function list(){
//        $notes = Note::get();
//        return view('note.list',['notes' => $notes]);
//    }

    function create(){
        return view('note.create');
    }

    function save(Request $request){
        $validator = \Validator::make($request->all(),[
            'name' => ['bail','required','max:100','min:3'],
            'cont' => ['bail','required','max:100','min:10'],
        ]);
//        dd($request->all());
        if($validator->fails()) {
            return redirect('notes/create')->withErrors($validator)->withInput();
        }
        $note = new Note();
        $note->name = $request->name;
        $note->content = $request->cont;
        $note->user_id = $request->user_id;
        $note->save();

        return redirect('notes/create');
    }
}
