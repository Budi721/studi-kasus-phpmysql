<?php

require_once __DIR__ . "/../Entity/Todolist.php";
require_once __DIR__ . "/../Repository/TodolistRepository.php";
require_once __DIR__ . "/../Service/TodolistService.php";
require_once __DIR__ . "/../Config/Database.php";

use Entity\TodoList;
use Service\TodolistServiceImpl;
use Repository\TodolistRepositoryImpl;

function testShowTodolist(): void
{
    $connection = \Config\Database::getConnection();
    $todoListRepository = new TodolistRepositoryImpl($connection);

    $todoListService = new TodolistServiceImpl($todoListRepository);

    $todoListService->showTodolist();
}

function testAddTodolist(): void
{
    $connection = \Config\Database::getConnection();
    $todoListRepository = new TodolistRepositoryImpl($connection);

    $todoListService = new TodolistServiceImpl($todoListRepository);
    $todoListService->addTodolist("Belajar PHP");
    $todoListService->addTodolist("Belajar PHP OOP");
    $todoListService->addTodolist("Belajar PHP WEB");

    $todoListService->showTodolist();
}

function testRemoveTodolist(): void
{
    $connection = \Config\Database::getConnection();
    $todoListRepository = new TodolistRepositoryImpl($connection);
    $todoListService = new TodolistServiceImpl($todoListRepository);

    echo $todoListService->removeTodolist(5);
    echo $todoListService->removeTodolist(4);
    echo $todoListService->removeTodolist(3);
    echo $todoListService->removeTodolist(2);
    echo $todoListService->removeTodolist(1);

}

testShowTodolist();