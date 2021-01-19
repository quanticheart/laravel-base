<?php
    
    namespace App\Exceptions;
    
    use Closure;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Validation\ValidationException;
    use function App\Helpers\responseQueryError;
    use function App\Helpers\responseValidationError;

    class RequestValidation
    {
        static function tryCatch(Closure $block): JsonResponse
        {
            try {
                return $block();
            } catch (ValidationException $e) {
                return responseValidationError($e);
            } catch (QueryException $e) {
                return responseQueryError();
            }
        }
    }
    
