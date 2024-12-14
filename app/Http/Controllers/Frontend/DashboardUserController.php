<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\StoreRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;


class DashboardUserController extends Controller
{
    private StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    /**
     * Display the user's dashboard.
     */
    public function index()
    {
        try {
            $token = session('jwt_token');
            Log::info('Token from session: ' . $token);

            if (!$token) {
                Log::warning('Token is missing');
                return redirect()->route('login')->withErrors(['error' => 'Token is missing']);
            }

            $store = JWTAuth::setToken($token)->authenticate();
            Log::info('JWT_SECRET: ' . config('jwt.secret'));
            Log::info('Decoded Token (pre-auth): ' . json_encode(JWTAuth::setToken($token)->getPayload()));

            if (!$store) {
                Log::warning('Invalid token detected');
                return redirect()->route('login')->withErrors(['error' => 'Invalid token']);
            }

            Log::info('Authenticated store: ' . $store->username);

            return view('pages.frontend.dashboard.index', compact('store'));
        } catch (TokenExpiredException $e) {
            Log::error('Token has expired: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Your session has expired. Please log in again.']);
        } catch (TokenInvalidException $e) {
            Log::error('Invalid token: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Invalid token.']);
        } catch (JWTException $e) {
            Log::error('JWT error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Error decoding token.']);
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'An unexpected error occurred.']);
        }
    }
}
