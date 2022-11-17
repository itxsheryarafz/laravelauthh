<?php

namespace App\Http\Controllers\{guard}\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | {guard} that recently registered with the application. Emails may also
    | be re-sent if the {guard} didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect {guard} after verification.
     *
     * @var string
     */
    protected $redirectTo = '/{guard}';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guard.auth');
        $this->middleware('signed')->only('guard.verify');
        $this->middleware('throttle:6,1')->only('guard.verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user('guard')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('guard.auth.verify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user('guard')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('guard')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('guard')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('guard')->markEmailAsVerified()) {
            event(new Verified($request->user('guard')));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user('guard')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('guard')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}
