<?php

if (! function_exists('class_basename')) {
    /**
     * Get the class "basename" of the given object / class.
     *
     * @param  string|object  $class
     * @return string
     */
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (! function_exists('ingor_url')) {
    /**
     * Generate a url for the Ingor.
     *
     * @param  string  $path
     * @param  mixed  $parameters
     * @param  bool|null  $secure
     * @return string
     */
    function ingor_url($path, $parameters = [], $secure = null)
    {
        return url(config('ingor.prefix').'/'.ltrim($path, '/'), $parameters, $secure);
    }
}

if (! function_exists('ingor_redirect')) {
    /**
     * Get an instance of the redirector for Ingor.
     *
     * @param  string|null  $to
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return \Ingor\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function ingor_redirect($to = null, $status = 302, $headers = [], $secure = null)
    {
        if (is_null($to)) {
            return app('ingor.redirect');
        }

        return app('ingor.redirect')->to($to, $status, $headers, $secure);
    }
}
