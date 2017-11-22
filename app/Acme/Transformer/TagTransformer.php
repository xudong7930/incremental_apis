<?php

namespace App\Acme\Transformer;

use App\Acme\Transformer\Transformer;

class TagTransformer extends Transformer {
    public function transform(array $tag)
    {
        return [
            'name' => $tag['name'],        
        ];
    }
}
