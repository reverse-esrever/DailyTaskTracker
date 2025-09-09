<?php

namespace App\Filters;

use Masterminds\HTML5\Serializer\RulesInterface;
use PHPUnit\Framework\MockObject\Rule\ParametersRule;

abstract class FilterRule
{
    protected array $whereRules = [
        '>' => '',
    ];

    public static function get(string $class, string $column, mixed $value){
        $classRules = $class::rules();
        $operatorRules = self::rules();
        $callback = $operatorRules[$classRules[$column]];
        return $callback($column, $value);
    }

    protected static function rules(){
        return [
            '=' => function($column, $value){
                return "where($column, '=', $value)";
            },
            '<' => function($column, $value){
                return "where($column, '<', $value)";
            },
            '>' => function($column, $value){
                return "where($column, '>', $value)";
            },
        ];
    }
}