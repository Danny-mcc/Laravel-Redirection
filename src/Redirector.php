<?php

namespace Dannymcc\Redirection;

use Dannymcc\Redirection\Models\Redirect;

class Redirector
{
    /**
     * @param $request
     * @return Redirect|null
     */
    public function redirectFor($request)
    {
        $redirect = Redirect::whereIn('from_url', $this->urlsToMatch($request))->first();

        if( ! $redirect ){
            return null;
        }

        return redirect($redirect->to_url, $redirect->status_code);
    }

    /**
     * Return urls to check against.
     *
     * @param $request
     * @return array
     */
    private function urlsToMatch($request)
    {
        return [
            $request->fullUrl(),
            $request->fullUrl() . '/',
            ($request->path() == '/' ? '/' : '/' . $request->path()),
            $request->getHttpHost() . '/' . $request->path()
        ];
    }
}