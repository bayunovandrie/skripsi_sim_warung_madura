<?php

if (!function_exists('return_color_product')) {
    function return_color_product($product)
    {
        $color = '';

        switch ($product) {
            case 'PRD001':
                $color = "#4e73df";
                break;
            case 'PRD002':
                $color = "#1cc88a";
                break;
            case 'PRD003':
                $color = "#36b9cc";
                break;
            case 'PRD004':
                $color = "#f6c23e";
                break;
            case 'PRD005':
                $color = "#e74a3b";
                break;
            case 'PRD006':
                $color = "#6f42c1";
                break;
            case 'PRD007':
                $color = "#fd7e14";
                break;
            case 'PRD008':
                $color = "#20c997";
                break;
            case 'PRD009':
                $color = "#ff6384";
                break;
            
            default:
                $color = "#000";
                break;
        }

        return $color;
    }
}