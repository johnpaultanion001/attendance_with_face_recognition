<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectTeacherStudent;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            // For admin
            [
                'id'                => '1',
                'name'              => 'Admin',
                'email'             => 'admin@admin.com',
                'password'          => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896' ,//password
                'remember_token'    => null,
                'contact_number'    => '09776668820',
                'address'           => 'Antipol City',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
                'email_verified_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'                => '2',
                'name'              => 'Admin2',
                'email'             => 'admin2@admin2.com',
                'password'          => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896' ,//password
                'remember_token'    => null,
                'contact_number'    => '09776668821',
                'address'           => 'Antipol City',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
                'email_verified_at' => date("Y-m-d H:i:s"),
            ],
            // For Staff
            [
                'id'                => '3',
                'name'              => 'Teacher 1',
                'email'             => 'teacher@teacher.com',
                'password'          => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896' ,//password
                'remember_token'    => null,
                'contact_number'    => '09776668822',
                'address'           => 'Antipol City',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
                'email_verified_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'                => '4',
                'name'              => 'Teacher 2',
                'email'             => 'teacher2@teacher2.com',
                'password'          => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896' ,//password
                'remember_token'    => null,
                'contact_number'    => '09776668823',
                'address'           => 'Antipol City',
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s"),
                'email_verified_at' => date("Y-m-d H:i:s"),
            ],
        ];

        $students = [
            // students
            [
                'id'                          => '1',
                'user_id'                     => '1',
                'student_folder'              => 'Tony Stark_739674',
                'name'                        => 'Tony Stark',
                'age'                         => '22',
                'address'                     => 'test',
                'grade'                       => 'test',
                'section'                     => 'test',
                'schedule'                    => 'test',
                'image1'                      => 'Tony Stark_739674/1.jpg',
                'image2'                      => 'Tony Stark_739674/2.jpg',
                'created_at'                  => date("Y-m-d H:i:s"),
                'updated_at'                  => date("Y-m-d H:i:s"),
            ],
        ];


        $subjects = [
            [
                'subject_code'                          => 'FIL01',
                'subject_title'                          => 'FILIPINO',
                
                'created_at'                  => date("Y-m-d H:i:s"),
                'updated_at'                  => date("Y-m-d H:i:s"),
            ],
            [
                'subject_code'                          => 'ENG01',
                'subject_title'                          => 'ENGLISH',
                
                'created_at'                  => date("Y-m-d H:i:s"),
                'updated_at'                  => date("Y-m-d H:i:s"),
            ],
            [
                'subject_code'                          => 'MTH01',
                'subject_title'                          => 'MATH',
                
                'created_at'                  => date("Y-m-d H:i:s"),
                'updated_at'                  => date("Y-m-d H:i:s"),
            ],
            [
                'subject_code'                          => 'JAVA01',
                'subject_title'                          => 'JAVA',
                
                'created_at'                  => date("Y-m-d H:i:s"),
                'updated_at'                  => date("Y-m-d H:i:s"),
            ],
        ];

        $subjectTeacherStudent = [
            [
                'subject_id'                          => '1',
                'student_id'                          => '1',
                'teacher_id'                          => '4',
                
                'created_at'                  => date("Y-m-d H:i:s"),
                'updated_at'                  => date("Y-m-d H:i:s"),
            ],
            [
                'subject_id'                          => '2',
                'student_id'                          => '1',
                'teacher_id'                          => '4',
                
                'created_at'                  => date("Y-m-d H:i:s"),
                'updated_at'                  => date("Y-m-d H:i:s"),
            ],
            [
                'subject_id'                          => '3',
                'student_id'                          => '1',
                'teacher_id'                          => '4',
                
                'created_at'                  => date("Y-m-d H:i:s"),
                'updated_at'                  => date("Y-m-d H:i:s"),
            ],
        ];

        User::insert($users);
        Student::insert($students);
        Subject::insert($subjects);
        SubjectTeacherStudent::insert($subjectTeacherStudent);
    }
}
