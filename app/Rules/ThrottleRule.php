<?php

namespace App\Rules;

use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

class ThrottleRule implements Rule
{

    protected $key;
    protected $maxAttempts = 5;
    protected $decayInMinutes = 30;

    public function __construct($key, $maxAttempts = 5, $decayInMinutes = 30)
    {
        $this->key = $key;
        $this->maxAttempts = $maxAttempts;
        $this->decayInMinutes = $decayInMinutes;
    }

    public function passes($attribute, $value)
    {
        if ($this->hasTooManyAttempts()) {
            return false;
        }

        $this->incrementAttempts();

        return true;
    }

    public function message()
    {

        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($this->request())
        );

        return Lang::get('auth.throttle', ['minutes' => ceil($seconds / 60)]);
    }

    protected function hasTooManyAttempts()
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey(), $this->maxAttempts
        );
    }

    protected function incrementAttempts()
    {
        $this->limiter()->hit(
            $this->throttleKey(), $this->decayInMinutes * 60
        );
    }

    protected function throttleKey()
    {

        return $this->request()->get($this->key);
    }

    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    protected function request()
    {
        return app(Request::class);
    }
}
