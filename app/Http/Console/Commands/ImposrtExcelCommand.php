<?php

namespace App\Console\Commands;

use App\Imports\PostsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImposrtExcelCommand extends Command
{
    protected $signature = 'import:excel';
    protected $description = 'Get data from Excel';

    public function handle()
    
    {
        ini_set('memory_limit', '-1');
        Excel::import(new PostsImport, public_path('excel/posts.xlsx'));

        dd('finish');
    }
}
