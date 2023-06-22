<?php

// Function which prints "Hello I am Zura"
// function hello()
// {
//     echo 'Hello I am Zura<br>';
// }

// hello();
// hello();
// hello();
// Function with argument

// function hello($name)
// {
//     return "Hello I am $name";
// }

// echo hello("jose"). '<br>';
// echo hello("Miguel"). "<br>";
// Create sum of two functions
// function sum($a, $b)
// {
//     return $a + $b;
// }

// echo sum(4,5). '<br>';
// echo sum(9,10). '<br>';
// Create function to sum all numbers using ...$nums
// function sum(...$nums)
// {
//     $sum = 0;
//     foreach ($nums as $num) $sum += $num;
//     return $sum;
// }
// echo sum(1, 2, 3, 4, 6);

// Arrow functions
function sum(...$nums)
{
    return array_reduce($nums, fn($take, $n)=> $take + $n);
    
}
echo sum(1,2,3,4,5,6);