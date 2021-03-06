<?php

namespace App\Rules;

use App\Repositories\Interfaces\FollowInterface;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\App;

class AlreadyFollowedRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $followRepository = app(FollowInterface::class);

        return !$followRepository->isFollow(
            auth()->id(), $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You already following that user.';
    }
}
