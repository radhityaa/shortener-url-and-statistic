<?php

namespace App\Http\Controllers;

use App\Jobs\RecordVisitor;
use App\Models\Shortener;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class ShortenerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super admin'])->only(['index']);
    }

    public function show(Request $request, Shortener $shortener)
    {
        $agent = new Agent();
        $agent->setUserAgent($request->userAgent());

        // $this->dispatch(new RecordVisitor($shortener, $agent));
        $job = new RecordVisitor($shortener, $agent);
        $job->onConnection('database')->onQueue('shorteners');
        $job->handle();

        return redirect($shortener->original);
    }

    public function index()
    {
        $shorteners = Shortener::latest()->paginate(10);

        return view('shorteners.index', compact('shorteners'));
    }

    public function stats(Shortener $shortener)
    {
        $devices = Visitor::query()
            ->whereBelongsTo($shortener)
            ->groupByType('device')
            ->get();

        $device_types = Visitor::query()
            ->whereBelongsTo($shortener)
            ->groupByType('device_type')
            ->get();

        $browsers = Visitor::query()
            ->whereBelongsTo($shortener)
            ->groupByType('browser')
            ->get();

        $platforms = Visitor::query()
            ->whereBelongsTo($shortener)
            ->groupByType('platform')
            ->get();

        $referrers = Visitor::query()
            ->whereBelongsTo($shortener)
            ->groupByType('referrer')
            ->get()
            ->filter(fn ($item) => $item->name !== null);

        return view('shorteners.stats', compact('shortener', 'devices', 'device_types', 'browsers', 'platforms', 'referrers'));
    }
}
