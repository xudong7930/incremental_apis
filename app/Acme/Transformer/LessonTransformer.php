<?

namespace App\Acme\Transformer;

use App\Acme\Transformer\Transformer;

class LessonTransformer extends Transformer {

    public function transform(array $lesson)
    {
        return [
            'title' => $lesson['title'],
            'content' => $lesson['content'],
            'active' => (boolean)$lesson['some_bool']
        ];
    }
}
