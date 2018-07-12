<?php 

namespace Trip;

use Ramsey\Uuid\Uuid;

class TripId {

    /** @var string */
    protected $id;

    protected function __construct(string $id) {
        $this->id = $id;
    }


    public static function generate(){
        return new static(Uuid::uuid4()->toString());
    }

    public function toString(): string {
        return $this->id;
    }

    public function __toString(): string {
        return $this->toString();
    }

    public function equals(self $that): bool {
        if (get_class($this) !== get_class($that)) {
            throw new Exception('Cannot compare different id\'s');
        }
        return $this->id === $that->id;
    }
}
