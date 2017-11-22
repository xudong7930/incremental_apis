<?

namespace App\Http\Conrollers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller {
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_ERROR = 500;
    const HTTP_SUCCESS = 201;
    const HTTP_REQUEST_SUCCESS = 200;

    protected $statusCode = self::HTTP_REQUEST_SUCCESS;
    
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message = '')
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(self::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondInteralError($message = 'Intermal Error')
    {
        return $this->setStatusCode(self::HTTP_INTERNAL_ERROR)->respondWithError($message);
    }

    public function respondWithPagination(Paginator $page, $data)
    {
        return $this->setStatusCode(self::HTTP_SUCCESS)->respond([
            'data' => $data,
            'paginator' => [
                'total' => $page->total(),
                'total_page' => ceil($page->total()/$page->perPage()),
                'current_page' => $page->currentPage(),
                'per_page' => (int)$page->perPage() 
            ]
        ]);
    }

    public function respondCreated($message = 'created!')
    {
        return $this->setStatusCode(self::HTTP_SUCCESS)->respond([
            'message' => $message
        ]);
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    
}
