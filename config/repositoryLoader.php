<?php

function getRepository(string $name) {
    require __DIR__.'./../src/Domain/Models/'.$name.'.php';
}