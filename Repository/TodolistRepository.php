<?php

namespace Repository {

    use Entity\TodoList;

    interface TodolistRepository
    {
        function save(TodoList $todolist): void;

        function remove(int $number): bool;

        function findAll(): array;
    }

    class TodolistRepositoryImpl implements TodolistRepository
    {

        public array $todolist = array();

        public function __construct(
            private \PDO $connection
        )
        {
        }

        function save(TodoList $todolist): void
        {
            // $number = sizeof($this->todolist) + 1;
            // $this->todolist[$number] = $todolist;

            $sql = "INSERT INTO todolist(todo) VALUES (?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$todolist->getTodo()]);
        }

        function remove(int $number): bool
        {
//            if ($number > sizeof($this->todolist)){
//                return false;
//            }
//
//            for ($i = $number; $i < sizeof($this->todolist); $i++){
//                $this->todolist[$i] = $this->todolist[$i + 1];
//            }
//
//            unset($this->todolist[sizeof($this->todolist)]);
//
//            return true;

            $sql = "SELECT * FROM todolist WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            if ($statement->fetch()) {
                $sql = "DELETE FROM todolist WHERE id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);
                return true;
            } else {
                return false;
            }
        }

        function findAll(): array
        {
//            return $this->todolist;
            $sql = "SELECT id, todo FROM todolist";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $result = [];
            foreach ($statement as $row) {
                $todolist = new TodoList();
                $todolist->setId($row['id']);
                $todolist->setTodo($row['todo']);
                $result[] = $todolist;
            }

            return $result;
        }
    }
}