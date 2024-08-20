<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class AlertCell extends Cell
{
    public string $type = '';
    public array $messages = [];
}
