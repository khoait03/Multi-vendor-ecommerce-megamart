<?php

namespace App\Mail;

use App\Models\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountCreateMail extends Mailable
{
  use Queueable, SerializesModels;

  public $name, $email, $password, $role;

  /**
   * Create a new message instance.
   */
  public function __construct($name, $email, $password, $role)
  {

    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->role = $role;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    $generalSetting = GeneralSetting::first();

    return new Envelope(
      subject: 'Chào mừng bạn đến với ' . $generalSetting->site_name,
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'mail.account-created',
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
