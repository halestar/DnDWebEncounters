<?php

namespace App\Console\Commands;

use App\Spells\JSONSpells;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FilterSpellbook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dnd:filter_spells';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Filters the spell JSON ton only include SR spells';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $all_spells = JSONSpells::allSpells();
        $sr_spells = $all_spells->filter(function($value, $key)
        {
            return preg_match("/^phb /", $value->page);
        })->values()->all();
        Storage::disk('local')->put('sr_spells.json', json_encode($sr_spells, JSON_PRETTY_PRINT));
    }
}
