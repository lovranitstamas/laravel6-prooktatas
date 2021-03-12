<?php

//7. óra
if (!function_exists('orderTableHeader')) {
    function orderTableHeader($field, $tableHeaderText)
    {

        $currentRouteName = \Route::currentRouteName();
        return '<a href="' . route($currentRouteName,
            [
                'search' => request()->input('search'),
                'orderBy' => $field,
                'orderDir' =>
                    request()->input('orderBy') == $field &&
                    request()->input('orderDir') == 'asc' ? 'desc' : 'asc'
            ]) . '">' . $tableHeaderText . '</a>';

    }
}

if (!function_exists('authCustomer')) {
    function authCustomer()
    {
        return auth()->guard('customer')->user();
    }
}

