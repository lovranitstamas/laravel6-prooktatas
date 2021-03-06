<?php

//7. óra
if (!function_exists('orderTableHeader')) {
    function orderTableHeader($field, $tableHeaderText)
    {

        $currentRouteName = \Route::currentRouteName();
        $link = '<a href="' . route($currentRouteName,
                [
                    'search' => request()->input('search'),
                    'orderBy' => $field,
                    'orderDir' =>
                        request()->input('orderBy') == $field &&
                        request()->input('orderDir') == 'asc' ? 'desc' : 'asc'
                ]) . '">' . $tableHeaderText . '</a>';

        $link .= ' <i class="fa fa-caret-';
        if (request()->input('orderBy') == $field &&
            request()->input('orderDir') == 'asc') {
            $link .= 'up';
        } else {
            $link .= 'down';
        }
        $link .= '"></i>';

        return $link;
    }
}

if (!function_exists('authCustomer')) {
    function authCustomer()
    {
        return auth()->guard('customer')->user();
    }
}

