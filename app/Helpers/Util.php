<?php

use App\Models\Setting;

/**
 * Return the value of the 'facebook' setting.
 *
 * @return string
 */
function facebooklink()
{
    return Setting::where('key', 'facebook')->first()->value ?? '';
}
/**
 * Return the value of the 'youtube' setting.
 *
 * @return string
 */
function youtubelink()
{
    return Setting::where('key', 'youtube')->first()->value ?? '';
}
/**
 * Return the value of the 'phone' setting.
 *
 * @return string
 */
function contactPhone()
{
    return Setting::where('key', 'phone')->first()->value ?? '';
}
/**
 * Return the value of the 'email' setting.
 *
 * @return string
 */
function contactEmail()
{
    return Setting::where('key', 'email')->first()->value ?? '';
}
/**
 * Return the value of the 'address' setting.
 *
 * @return string
 */
function contactAddress()
{
    return Setting::where('key', 'address')->first()->value ?? '';
}
/**
 * Return the value of the 'logo' setting.
 *
 * @return string
 */
function logo()
{
    return Setting::where('key', 'logo')->first()->value ?? '';
}
