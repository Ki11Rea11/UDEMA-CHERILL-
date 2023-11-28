<?php

namespace Src\Controllers;

use MiladRahimi\PhpRouter\View\View;
use ORM;

class CourseController
{
    public function coursesPage(View $view)
    {
        $courses = ORM::forTable('category')
            ->join('course', array('course.category_id', '=', 'category.id'))
            ->find_many();
        return $view->make('udema.courses-list-sidebar',[
            'courses' => $courses
        ]);
    }
    public function course_detailPage(View $view, int $course_id)
    {
        $courses = ORM::forTable('category')
            ->join('course', array('course.category_id', '=', 'category.id'))
            ->find_one($course_id);
        $content = ORM::forTable('content')
            ->where('course_id',$course_id)
            ->find_many();
        $lessons = ORM::forTable('lessons')
            ->find_many();
        $comments = ORM::forTable('comments')
            ->join('users', array('comments.user_id', '=', 'users.id'))
            ->where('comments.course_id', $course_id)
            ->find_many();
        return $view->make('udema.course-detail',[
            'courses' => $courses,
            'content'=>$content,
            'lessons'=>$lessons,
            'comments'=> $comments

        ]);
    }
}