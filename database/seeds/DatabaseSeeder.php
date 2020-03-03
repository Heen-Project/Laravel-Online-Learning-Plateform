<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // First Run
        $this->call('UserTableSeeder');
        $this->call('LessonCategoryTableSeeder');
        $this->call('LessonTableSeeder');

        // Second run
        // $this->call('ArticleTableSeeder');
        // $this->call('DiscussionTableSeeder');

        // Third Run
        // $this->call('CommentTableSeeder');

        Model::reguard();
    }
}


/**
* 
*/
class UserTableSeeder extends Seeder
{
    
    function Run()
    {
        App\User::Create([
            'username' => 'admin',
            'firstName' => 'user',
            'lastName' => 'name',
            'facebookId' => '854356631268967',
            'email' => 'admin@example.com',
            'password' => bcrypt('kakiku'),
            'role' => 'admin',
            'avatar' => 'https://graph.facebook.com/v2.2/854356631268967/picture?type=normal',
            'confirmed' => true,
            ]);
        App\User::Create([
            'username' => 'user',
            'firstName' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('kakiku'),
            'avatar' => '/image/default/userDefaultAvatar.jpeg',
            'confirmed' => true,
            ]);
        
        foreach (range(1, 17) as $index) {
            factory('App\User')->Create();
        }

    }
}

/**
* 
*/
class LessonCategoryTableSeeder extends Seeder
{
    public function run()
    {
        App\LessonCategory::Create([
            'category' => 'HTML',
        ]);
        App\LessonCategory::Create([
            'category' => 'CSS',
        ]);
        App\LessonCategory::Create([
            'category' => 'JavaScript',
        ]);
        App\LessonCategory::Create([
            'category' => 'SQL',
        ]);
        App\LessonCategory::Create([
            'category' => 'PHP',
        ]);
        App\LessonCategory::Create([
            'category' => 'jQuery',
        ]);
        App\LessonCategory::Create([
            'category' => 'Bootstrap',
        ]);
    }
}

/**
* 
*/
class LessonTableSeeder extends Seeder
{
    
    function run()
    {
        App\Lesson::Create([
            'userId' => 1,
            'categoryId' => 1,
            'title'=> 'HTML(5) Tutorial',
            'description'=> 'With HTML you can create your own Web site.

This tutorial teaches you everything about HTML.

HTML is easy to learn - You will enjoy it.',
            'approval'=> true,
            'adminCheck' => true,
        ]);
        App\Lesson::Create([
            'userId' => 1,
            'categoryId' => 1,
            'title'=> 'HTML Introduction',
            'description'=> 'What is HTML?
HTML is a markup language for describing web documents (web pages).

HTML stands for Hyper Text Markup Language
A markup language is a set of markup tags
HTML documents are described by HTML tags
Each HTML tag describes different document content',
            'approval'=> true,
            'adminCheck' => true,
        ]);
        App\Lesson::Create([
            'userId' => 1,
            'categoryId' => 2,
            'title'=> 'CSS Tutorial',
            'description'=> 'Save a lot of work with CSS!

In our CSS tutorial you will learn how to use CSS to control the style and layout of multiple Web pages all at once.',
            'approval'=> true,
            'adminCheck' => true,
        ]);
        App\Lesson::Create([
            'userId' => 1,
            'categoryId' => 2,
            'title'=> 'CSS Introduction',
            'description'=> 'What is CSS?
CSS stands for Cascading Style Sheets
CSS defines how HTML elements are to be displayed
Styles were added to HTML 4.0 to solve a problem
CSS saves a lot of work
External Style Sheets are stored in CSS files
',
            'approval'=> true,
            'adminCheck' => true,
        ]);
        App\Lesson::Create([
            'userId' => 2,
            'categoryId' => 3,
            'title'=> 'JavaScript Tutorial',
            'description'=> 'JavaScript is the programming language of HTML and the Web.

Programming makes computers do what you want them to do.

JavaScript is easy to learn.

This tutorial will teach you JavaScript from basic to advanced.',
            'approval'=> false,
            'adminCheck' => false,
        ]);
        App\Lesson::Create([
            'userId' => 2,
            'categoryId' => 3,
            'title'=> 'JavaScript Introduction',
            'description'=> 'JavaScript is the most popular programming language in the world.

This page contains some examples of what JavaScript can do.',
            'approval'=> false,
            'adminCheck' => false,
        ]);
        App\Lesson::Create([
            'userId' => 2,
            'categoryId' => 4,
            'title'=> 'SQL Tutorial',
            'description'=> 'SQL is a standard language for accessing databases.

Our SQL tutorial will teach you how to use SQL to access and manipulate data in: MySQL, SQL Server, Access, Oracle, Sybase, DB2, and other database systems.',
            'approval'=> false,
            'adminCheck' => true,
        ]);
        App\Lesson::Create([
            'userId' => 2,
            'categoryId' => 4,
            'title'=> 'Introduction to SQL',
            'description'=> 'SQL is a standard language for accessing and manipulating databases.

What is SQL?
SQL stands for Structured Query Language
SQL lets you access and manipulate databases
SQL is an ANSI (American National Standards Institute) standard
What Can SQL do?
SQL can execute queries against a database
SQL can retrieve data from a database
SQL can insert records in a database
SQL can update records in a database
SQL can delete records from a database
SQL can create new databases
SQL can create new tables in a database
SQL can create stored procedures in a database
SQL can create views in a database
SQL can set permissions on tables, procedures, and views',
            'approval'=> false,
            'adminCheck' => true,
        ]);
        App\Lesson::Create([
            'userId' => 2,
            'categoryId' => 5,
            'title'=> 'PHP 5 Tutorial',
            'description'=> 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.

PHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'s ASP.',
            'approval'=> true,
            'adminCheck' => true,
        ]);
        App\Lesson::Create([
            'userId' => 2,
            'categoryId' => 5,
            'title'=> 'PHP 5 Introduction',
            'description'=> 'PHP scripts are executed on the server.

What You Should Already Know
Before you continue you should have a basic understanding of the following:

HTML
CSS
JavaScript
If you want to study these subjects first, find the tutorials on our Home page.

What is PHP?
PHP is an acronym for "PHP: Hypertext Preprocessor"
PHP is a widely-used, open source scripting language
PHP scripts are executed on the server
PHP is free to download and use',
            'approval'=> true,
            'adminCheck' => true,
        ]);
        App\Lesson::Create([
            'userId' => 1,
            'categoryId' => 6,
            'title'=> 'jQuery Tutorial',
            'description'=> 'jQuery is a JavaScript Library.

jQuery greatly simplifies JavaScript programming.

jQuery is easy to learn.',
            'approval'=> true,
            'adminCheck' => true,
        ]);
        App\Lesson::Create([
            'userId' => 2,
            'categoryId' => 6,
            'title'=> 'jQuery Introduction',
            'description'=> 'jWhat is jQuery?
jQuery is a lightweight, "write less, do more", JavaScript library.

The purpose of jQuery is to make it much easier to use JavaScript on your website.

jQuery takes a lot of common tasks that require many lines of JavaScript code to accomplish, and wraps them into methods that you can call with a single line of code.

jQuery also simplifies a lot of the complicated things from JavaScript, like AJAX calls and DOM manipulation.

The jQuery library contains the following features:

HTML/DOM manipulation
CSS manipulation
HTML event methods
Effects and animations
AJAX
Utilities
Tip: In addition, jQuery has plugins for almost any task out there.',
            'approval'=> true,
            'adminCheck' => true,
        ]);
    }
}

/**
* 
*/
class ArticleTableSeeder extends Seeder
{
    function run()
    {
        foreach (range(1, 100) as $index) {
            factory('App\Article')->Create();
        }
    }
}

/**
* 
*/
class DiscussionTableSeeder extends Seeder
{
    function run()
    {
        foreach (range(1, 30) as $index) {
            factory('App\Discussion')->Create();
        }
    }
}

/**
* 
*/
class CommentTableSeeder extends Seeder
{
    
    function run()
    {
       foreach (range(1, 1000) as $index) {
            factory('App\Comment')->Create();
        }
    }
}
