<?php
function hello($name)
{
    $name .= "!";
    return "Hello! {$name}";
}
echo hello("World");
?>