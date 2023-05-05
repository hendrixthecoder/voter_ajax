<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $candidate = Candidate::create([
            'name' => 'Wilson Clifford',
            'vote_count' => 1
        ]);

        $candidate = Candidate::create([
            'name' => 'Thomas Antelope',
            'vote_count' => 1
        ]);

        $candidate = Candidate::create([
            'name' => 'Polly Gray',
            'vote_count' => 1
        ]);

        $candidate = Candidate::create([
            'name' => 'Arrrghj bittchchhhh',
            'vote_count' => 0
        ]);
    }
}
