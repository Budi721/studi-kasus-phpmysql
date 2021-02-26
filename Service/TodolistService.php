<?php

namespace Service {

    use Entity\TodoList;
    use Repository\TodolistRepository;

    interface TodolistService
    {
        function showTodolist(): void;

        function addTodolist(string $todo): void;

        function removeTodolist(int $number): void;
    }

    class TodolistServiceImpl implements TodolistService
    {
        private TodolistRepository $todolistRepository;

        public function __construct(TodolistRepository $todolistRepository)
        {
            $this->todolistRepository = $todolistRepository;
        }

        function showTodolist(): void
        {
            echo "TODOLIST" . PHP_EOL;
            $todoList = $this->todolistRepository->findAll();
            foreach ($todoList as $number => $value) {
                echo $value->getId() . ". " . $value->getTodo() . PHP_EOL;
            }
        }

        function addTodolist(string $todo): void
        {
            $todoList = new TodoList($todo);
            $this->todolistRepository->save($todoList);
            echo "SUKSES MENAMBAH TODOLIST" . PHP_EOL;
        }

        function removeTodolist(int $number): void
        {
            if ($this->todolistRepository->remove($number)){
                echo "SUKSES MENGHAPUS TODOlIST KE $number" . PHP_EOL;
            } else {
                echo "GAGAL MENGHAPUS TODOLIST KE $number" . PHP_EOL;
            }
        }
    }
}