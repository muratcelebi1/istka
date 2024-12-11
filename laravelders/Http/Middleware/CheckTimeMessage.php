<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckTimeMessage
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hour = Carbon::now('Europe/Istanbul')->hour;
        $date = Carbon::now('Europe/Istanbul')->toDateString();

        if(session('message_date') != $date){
            session(['message_morning' => false]);
            session(['message_evening' => false]);
            session(['message_afternoon' => false]);
        }

        if (($hour >= 9 && $hour <= 12) && (!session('message_morning'))) {
            session(['message_morning' => true]);
            $message = "Günaydın!";
        } elseif (($hour > 12 && $hour <= 18) && !session('message_evening')) {
            session(['message_evening' => true]);
            $message = "İyi Günler!";
        } elseif (($hour > 18 && $hour <= 22) && !session('message_afternoon')) {
            session(['message_afternoon' => true]);
            $message = "İyi Akşamlar";
        }

        if (isset($message)) {
            session(['message_date' => $date]);
            session()->flash('message', $message);
        }

        return $next($request);
    }
}
