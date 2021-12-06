<?php

class Person
{
    public string $name;
    public string $surname;
    private ?int $age;
    public static int $counter = 0;

    public function __constructor($name, $surname)
    {
        $this->name = $name;
        $this->surname = $name;
        $this->age = null;
        self::$counter++;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }
}
