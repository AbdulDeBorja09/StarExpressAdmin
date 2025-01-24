<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;

use Throwable;

class CustomHandler extends ExceptionHandler
{
    public function report(Throwable $e): void
    {
        parent::report($e);

        if ($this->shouldReport($e)) {
            $this->sendErrorEmail($e);
        }
    }


    protected function sendErrorEmail(Throwable $e): void
    {
        try {
            $errorDetails = [
                'url' => request()->fullUrl(),
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ];

            logger()->info('Sending error email with details: ', $errorDetails);
            Mail::send('email.error_report', $errorDetails, function ($message) {
                $message->to('abduldb09@gmail.com')
                    ->subject('Error in StarExpressAdmin');
            });

            logger()->info('Error email sent successfully.');
        } catch (Throwable $e) {
            logger()->error('Failed to send error email: ' . $e->getMessage());
        }
    }
}
