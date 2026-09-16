<?php

namespace App\Traits;

use App\Exceptions\UserMessageException;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use Illuminate\Http\JsonResponse;

trait HttpResponse
{
    public function success(mixed $data): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => 'success',
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function error(string $message, int $code = 500): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => 'error',
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }

    public function withErrorHandling(Closure $callback): JsonResponse
    {
        try {
            return $callback();
        }
        catch (ModelNotFoundException $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
        catch (UserMessageException $exception) {
            return $this->error( message: $exception->getMessage(), code: $exception->getCode());
        }
        catch (Throwable $exception) {
            return $this->error(message: "Ошибка сервера", code: 500);
        }
    }
}
