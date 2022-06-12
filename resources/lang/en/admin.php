<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'post' => [
        'title' => 'Posts',

        'actions' => [
            'index' => 'Posts',
            'create' => 'New Post',
            'edit' => 'Edit :name',
            'will_be_published' => 'Post will be published at',
        ],

        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'perex' => 'Perex',
            'published_at' => 'Published at',
            'enabled' => 'Enabled',
            
        ],
    ],

    'applicant' => [
        'title' => 'Applicants',

        'actions' => [
            'index' => 'Applicants',
            'create' => 'New Applicant',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'dui' => 'Dui',
            'student_id' => 'Student',
            'birth_date' => 'Birth date',
            'phone_number' => 'Phone number',
            'email' => 'Email',
            
        ],
    ],

    'hrworker' => [
        'title' => 'Hrworkers',

        'actions' => [
            'index' => 'Hrworkers',
            'create' => 'New Hrworker',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'birth_date' => 'Birth date',
            'phone_number' => 'Phone number',
            'address' => 'Address',
            'dui' => 'Dui',
            
        ],
    ],

    'degree' => [
        'title' => 'Degrees',

        'actions' => [
            'index' => 'Degrees',
            'create' => 'New Degree',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'specialization' => [
        'title' => 'Specializations',

        'actions' => [
            'index' => 'Specializations',
            'create' => 'New Specialization',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'degree_id' => 'Degree',
            
        ],
    ],

    'request' => [
        'title' => 'Requests',

        'actions' => [
            'index' => 'Requests',
            'create' => 'New Request',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'entrence_year' => 'Entrence year',
            'graduation_year' => 'Graduation year',
            'cum' => 'Cum',
            'graduation_date' => 'Graduation date',
            'high_school_title' => 'High school title',
            'birth_certificate' => 'Birth certificate',
            'paes' => 'Paes',
            'health_certificate' => 'Health certificate',
            'specialization_id' => 'Specialization',
            'degree_id' => 'Degree',
            'applicant_id' => 'Applicant',
            
        ],
    ],

    'revision' => [
        'title' => 'Revisions',

        'actions' => [
            'index' => 'Revisions',
            'create' => 'New Revision',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'result' => 'Result',
            'comments' => 'Comments',
            'hrworker_id' => 'Hrworker',
            'request_id' => 'Request',
            
        ],
    ],

    'application' => [
        'title' => 'Applications',

        'actions' => [
            'index' => 'Applications',
            'create' => 'New Application',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'entrence_year' => 'Entrence year',
            'graduation_year' => 'Graduation year',
            'cum' => 'Cum',
            'graduation_date' => 'Graduation date',
            'high_school_title' => 'High school title',
            'birth_certificate' => 'Birth certificate',
            'paes' => 'Paes',
            'health_certificate' => 'Health certificate',
            'specialization_id' => 'Specialization',
            'degree_id' => 'Degree',
            'applicant_id' => 'Applicant',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];