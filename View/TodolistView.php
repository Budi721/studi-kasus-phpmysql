<?php

namespace View {

    use Helper\InputHelper;
    use Service\TodolistService;

    class TodolistView
    {
        private TodolistService $todolistService;

        public function __construct(TodolistService $todolistService)
        {
            $this->todolistService = $todolistService;
        }

        function showTodolist(): void
        {

            while (true) {
                // Menampilkan todoList
                $this->todolistService->showTodolist();

                // Pilihan Menu di terminal user
                echo "MENU" . PHP_EOL;
                echo "Pilih 1 untuk menambah todo" . PHP_EOL;
                echo "Pilih 2 untuk menghapus todo" . PHP_EOL;
                echo "Pilih x untuk keluar" . PHP_EOL;

                // Menyimpan masukan user kedalam variabel pilihan
                $pilihan = InputHelper::input("Pilih");

                if ($pilihan == "1") {
                    $this->addTodolist();
                } elseif ($pilihan == "2") {
                    $this->removeTodolist();
                } elseif ($pilihan == "x") {
                    break;
                } else {
                    echo "Pilihan tidak dimengerti" . PHP_EOL;
                }
            }

            echo "Sampai Jumpa Lagi" . PHP_EOL;
        }

        function addTodolist(): void
        {
            echo "MENAMBAH TODO" . PHP_EOL;

            $todo = InputHelper::input("Todo (Tekan X untuk batal)");

            if ($todo == "x") {
                echo "Batal menambah todo" . PHP_EOL;
            } else {
                $this->todolistService->addTodolist($todo);
            }
        }

        function removeTodolist(): void
        {
            echo "MENGHAPUS TODO" . PHP_EOL;

            $pilihan = InputHelper::input("Nomer (Tekan X untuk batal)");

            if ($pilihan == "x") {
                echo "Batal menghapus todo" . PHP_EOL;
            } else {
                $this->todolistService->removeTodolist($pilihan);
            }
        }
    }
}