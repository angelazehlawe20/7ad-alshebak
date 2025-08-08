<?php

if (!function_exists('formatArabicNumber')) {
    function formatArabicNumber($number) {
        $westernNumbers = ['0','1','2','3','4','5','6','7','8','9'];
        $arabicNumbers = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        return str_replace($westernNumbers, $arabicNumbers, $number);
    }
}
