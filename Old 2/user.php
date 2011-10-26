<?php
    class Todo
    {
        public $mTask = 'default name';
        public $mTime = 0;
        
        public function __construct($task = '', $time = 0)
        {
            $this->mTask = $task;
            $this->mTime = $time;
        }
    }
    
    class User
    {
        public $mUsername = 'default name';
        public $mTodos = array();
        
        public function __construct ($username = '', array $todos = array()) 
        {
            $this->mUsername = $username;
            $this->mTodos = $todos;
        }
    }
    
    
?>