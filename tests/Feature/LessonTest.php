<?

namespace Tests\Feature;

use Tests\TestCase;

class LessonTest extends TestCase {

    public function testFetchLesson()
    {
        $response = $this->get('/api/lesson');
        $response->assertStatus(200);
    }
}
