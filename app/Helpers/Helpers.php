<?php

use App\Models\Option;
use Illuminate\Support\Facades\Log;

/**
 * Get value of requested option.
 * @param  string  $optionKey
 * @param  int|string|bool|array  $default
 * @return mixed
 */
function getOption($optionKey, $default = null)
{
    $option = Option::where('key', $optionKey)->first();
    return ($option && $option->value) ? maybeJsonDecode($option->value) : $default;
}

/**/
function getOptions($keyPrefix)
{
    $optionArr = [];
    $options = Option::where('key', 'LIKE', "%" . $keyPrefix . "%")->get(['key', 'value']);

    foreach ($options as $option) {
        $optionArr[$option->key] = maybeJsonDecode($option->value);
    }
    return $optionArr;
}

/**
 * Create or update option.
 * @param  string  $optionKey
 * @param  int|string|bool|array  $default
 * @return mixed
 */
function updateOption($optionKey, $value)
{
    $checkCurrent = array('key' => $optionKey);
    if ($value && $value !== '' && $value !== 'null') {
        $data = array('value' => maybeJsonEencode($value));
        return Option::updateOrCreate($checkCurrent, $data);
    } else {
        return '';
    }
}

/**
 * Do json encode if needed.
 *
 * @param mixed $value
 * @return mixed $value
 */
function maybeJsonEencode($value)
{
    if (is_array($value) || is_object($value)) {
        return json_encode($value);
    }
    return $value;
}

/**
 * Do json decode if needed.
 *
 * @param mixed $value
 * @return mixed $value
 */
function maybeJsonDecode($value)
{
    $decoded_value = json_decode($value, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        return $decoded_value;
    }

    return $value;
}

/**
 * Check if value is JSON.
 *
 * @param mixed $value
 * @return bool
 */
function isJson($value)
{
    json_decode($value);
    return json_last_error() === JSON_ERROR_NONE;
}
