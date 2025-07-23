<?php

namespace App\Support;

use App\Models\MailQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailQueue
{
    use Queueable;
    use SerializesModels;

    protected $error;
    private $invoice;

    public function create($object, $input)
    {
        return $object->mailQueue()->create([
            'from' => json_encode([
                'email' => $input['from_email'] ?? 'hello@example.com',
                'name' => $input['from_name'] ?? config('APP_NAME')
            ]),
            'to' => json_encode($input['to']),
            'cc' => json_encode(($input['cc']) ?: []),
            'bcc' => json_encode(($input['bcc']) ?: []),
            'subject' => $input['subject'],
            'body' => $input['body'],
            'attach_pdf' => $input['attach_pdf'],
            'tenant_id' => $input['tenant_id'],
        ]);
    }

    public function send($object, MailQueue $mail)
    {
        $this->invoice = $object;

        if (
            $this->sendMail(
                $mail->from,
                $mail->to,
                $mail->cc,
                $mail->bcc,
                $mail->subject,
                $mail->body,
                $this->getAttachmentPath($mail)
            )
        ) {
            $mail->sent = 1;
            $mail->save();
            return true;
        } else {
            $mail->error = $this->getError();
            $mail->save();
        }
        return false;
    }

    private function sendMail($from, $to, $cc, $bcc, $subject, $body, $attachmentPath = null)
    {
        try {
            Mail::send(
                ['emails.html', 'emails.text'],
                ['body' => $body],
                function ($message) use ($from, $to, $cc, $bcc, $subject, $attachmentPath) {
                    $from = json_decode($from, true);
                    $to = json_decode($to, true);
                    $cc = json_decode($cc, true);
                    $bcc = json_decode($bcc, true);

                    $message->from($from['email'], $from['name']);
                    $message->subject($subject);

                    foreach (explode(',', $to) as $toRecipient) {
                        $message->to(trim($toRecipient));
                    }

                    if ($cc) {
                        foreach (explode(',', $cc) as $ccRecipient) {
                            if ($ccRecipient !== '') {
                                $message->cc(trim($ccRecipient));
                            }
                        }
                    }
                    if ($bcc) {
                        foreach (explode(',', $bcc) as $bccRecipient) {
                            if ($bccRecipient !== '') {
                                $message->bcc(trim($bccRecipient));
                            }
                        }
                    }

                    if ($attachmentPath) {
                        $message->attach($attachmentPath);
                    }
                }
            );

            if ($attachmentPath && file_exists($attachmentPath)) {
                unlink($attachmentPath);
            }

            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    private function getAttachmentPath($mail)
    {
        if ($mail->attach_pdf) {
            $object = $mail->mailable;
            return $object->pdf($object);
        }

        return null;
    }

    public function getError()
    {
        return $this->error;
    }
}
