<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Listing;

class ExpireListings extends Command
{
    // The name and signature of the command
    protected $signature = 'listings:expire';

    // The console command description
    protected $description = 'Mark listings as expired if their expiry date has passed';

    // Execute the console command
    public function handle()
    {
        $expiredListings = Listing::where('expiry_date', '<', now())->where('status', '!=', 'expired')->get();

        foreach ($expiredListings as $listing) {
            $listing->status = 'expired';
            $listing->save();
        }

        $this->info('Expired listings have been marked.');
    }
}
