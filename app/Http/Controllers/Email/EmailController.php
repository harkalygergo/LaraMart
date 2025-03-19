<?php

namespace App\Http\Controllers\Email;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail($fromName, $fromEmail, $toName, $toEmail, $subject, $content)
    {
        try {
            // Validate input parameters
            $validated = $this->validateEmailData([
                'from_name' => $fromName,
                'from_email' => $fromEmail,
                'to_name' => $toName,
                'to_email' => $toEmail,
                'subject' => $subject,
                'content' => $content
            ]);

            // Prepare email data
            $emailData = [
                'from_name' => $validated['from_name'],
                'from_email' => $validated['from_email'],
                'to_name' => $validated['to_name'],
                'to_email' => $validated['to_email'],
                'subject' => $validated['subject'],
                'content' => $validated['content']
            ];

            // Send the email
            Mail::to($toEmail, $toName)->send(new GenericEmail($emailData));

            return response()->json([
                'success' => true,
                'message' => 'Email sent successfully'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }

    private function validateEmailData(array $data)
    {
        $validator = \Validator::make($data, [
            'from_name' => 'required|string|max:255',
            'from_email' => 'required|email|max:255',
            'to_name' => 'required|string|max:255',
            'to_email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first());
        }

        return $validator->validated();
    }
}
