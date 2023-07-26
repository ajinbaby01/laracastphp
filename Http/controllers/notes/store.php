<?php

// This controller is responsible for inserting user notes into the 'notes' database
use Core\Session;
use Http\Forms\CreateANoteForm;

$noteBody = $_POST['body'];

$noteForm = new CreateANoteForm;
if($noteForm->validate($noteBody)){
    $noteForm->insert($noteBody);
    redirect('/notes');
}

//validation issue
Session::flash('old', [
    'note' => $noteBody
]);
Session::flash('errors', $noteForm->getErrors());

redirect('/notes/create');

// return view('notes/create.view.php', [
//     'heading' => 'Create a Note',
//     'errors' => $noteForm->getErrors()
// ]);

?>
