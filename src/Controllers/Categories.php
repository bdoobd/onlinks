<?php

namespace App\Controllers;

class Categories
{
    public function read(): void
    {
        // return ['first', 'second', 'third'];
        echo 'Successfully reading data ....';
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
