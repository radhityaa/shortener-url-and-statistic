<?php

namespace App\Jobs;

use App\Models\Shortener;
use App\Services\IpAddressServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Jenssegers\Agent\Agent;

class RecordVisitor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Shortener $shortener, private Agent $agent)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->shortener->visitors()->create([
            'ip_address' => $ip = request()->ip(),
            'country' => (new IpAddressServices())->getCountry($ip),
            'city' => (new IpAddressServices())->getCity($ip),
            'platform' => $this->agent->platform(),
            'device' => $this->agent->device(),
            'device_type' => $this->agent->deviceType(),
            'browser' => $this->agent->browser(),
            'referrer' => parse_url(request()->header('referer'), PHP_URL_HOST),
        ]);
    }
}
