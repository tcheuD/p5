<?php

function getRepository(string $name) {
    require __DIR__ . './../src/Domain/Repository/' .$name.'.php';
}