<?php

namespace App\Controllers;

class Categories
{
    public function read(): array
    {
        return ['first', 'second', 'third'];
    }

    public function add(): int
    {
        return 5;
    }

    public function edit(): void
    {
        echo "Edit success";
    }

    public function delete(): void
    {
        echo 'Delete success';
    }
}
