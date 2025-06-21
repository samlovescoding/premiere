<?php

namespace App\Livewire;

use App\Mail\AccountRecoveryCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Recovery extends Component
{
    private const ERROR_INVALID_CODE = 'Invalid or expired code.';
    public $isCodeSent = false;
    public $isCodeValid = false;

    public $email;
    public $code;
    public $password;
    public $password_confirmation;

    public function generateCode()
    {
        // Delete older tokens
        DB::table('password_reset_tokens')
            ->where('email', $this->email)
            ->orWhere('created_at', '>', now()->subMinutes(10))
            ->delete();

        // Generate a new token
        $generatedCode = rand(100000, 999999);
        DB::table('password_reset_tokens')->insert([
            'email' => $this->email,
            'token' => $generatedCode,
            'created_at' => now(),
        ]);

        return $generatedCode;
    }

    public function sendCode()
    {
        $this->resetErrorBag();
        $generatedCode = $this->generateCode();
        $mail = new AccountRecoveryCode($generatedCode);
        Mail::to($this->email)->send($mail);
        $this->isCodeSent = true;
    }

    public function validateCode()
    {
        $this->resetErrorBag();

        $tokenRecord = DB::table('password_reset_tokens')->where('email', $this->email)->where('created_at', '>', now()->subMinutes(10))->first();

        if (!$tokenRecord) {
            $this->addError('code', self::ERROR_INVALID_CODE);
            return false;
        }

        if ($tokenRecord->token !== $this->code) {
            $this->addError('code', self::ERROR_INVALID_CODE);
            return false;
        }

        $this->isCodeValid = true;
        return true;
    }


    public function handle()
    {
        $this->resetErrorBag();
        $fields = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'same:password'
        ]);

        $isCodeStillValid = $this->validateCode();

        if (!$isCodeStillValid) {
            $this->addError('code', self::ERROR_INVALID_CODE);
            return;
        }

        return $fields;
    }

    public function render()
    {
        return view('recovery');
    }
}
