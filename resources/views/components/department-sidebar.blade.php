@php
    $routeName = request()->route()->getName();
    $dept = null;
    if (str_starts_with($routeName, 'departments.')) {
        $parts = explode('.', $routeName);
