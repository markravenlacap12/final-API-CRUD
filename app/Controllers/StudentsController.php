<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentsModel;

class StudentsController extends BaseController
{
    public function index()
    {
       return view('students/list');
    }

    public function createStudent()
    {
        $data['studentNumber'] = '20000_'.uniqid();
       return view('students/add', $data);
    }

    public function storeStudent()
    {
        $insertStudents = new StudentsModel();
       
        if($img = $this->request->getFile('studentProfile')){
            if($img->isValid() && ! $img->hasMoved()){
                $imageName = $img->getRandomName();
                $img->move('uploads/', $imageName);
            }
        }

        $data = array(
            'student_name' => $this->request->getPost('studentName'),
            'student_id' => $this->request->getPost('studentNum'),
            'student_section' => $this->request->getPost('studentSection'),
            'student_course' => $this->request->getPost('studentCourse'),
            'student_batch' => $this->request->getPost('studentBatch'),
            'student_grade_level' => $this->request->getPost('studentLevel'),
            'student_profile' => $imageName,
        );

        $insertStudents->insert($data);

        return redirect()->to('/students')->with('success','Student Added Successfully!');
    }
    
    public function editStudent($id)
    {
       return view('students/edit');
    }

    public function updateStudent($id)
    {
       //update the student
    }

    public function deleteStudent()
    {
       //delete the student
    }
}
