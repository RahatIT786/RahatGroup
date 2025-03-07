<?php

namespace App\Http\Middleware;

use App\Models\Agent;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAgentWebsite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(1212112);
        $agentWebsite = $request->route('agent_website');
        // dd($agentWebsite);
        $agent = Agent::where('id', $agentWebsite)->first();
        // dd($agent);
        if ($agent) {
            // Agent website exists, proceed to the next middleware or controller
            $request->merge(['agent' => $agent]);
            return $next($request);
        }

        // Redirect to the agent login page if the website is not found
        return redirect()->route('agent.login');
    }
}
