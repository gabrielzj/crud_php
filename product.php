<?php
class Product
{
    private  int $id;
    private  string $name;
    private  string $type;
    private int $novoid;
    public function __construct(int $id, string $name, string $type, int $novoid)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->novoid = $novoid;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getNovoId(): int
    {
        return $this->novoid;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function setNovoId($novoid): void
    {
        $this->novoid = $novoid;
    }
}
