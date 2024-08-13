<?php
 namespace App\Http\Controllers;

 use App\Models\User;
 use App\Models\VegeProduct;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Mail;
 use Illuminate\Validation\Rule;


 class VegeUserController extends Controller
 {
     public function showRegisterForm()
     {
         return view('vegetables.register');
     }

     public function register(Request $request)
     {
         $validatedData = $request->validate([
             'username' =>'required|unique:users,username',
             'email' => ['required', Rule::unique('users', 'email')],
             'password' => 'required|min:6',
         ]);

         $otp = rand(100000, 999999);

         $user = User::create([
             'username' => $validatedData['username'],
             'email' => $validatedData['email'],
             'password' => $validatedData['password'],
             'otp' => $otp,
             'is_verified' => false,
         ]);

         Mail::raw("Your OTP is: $otp", function ($message) use ($user) {
             $message->to($user->email)
                     ->subject('Verify Your Email');
         });

         return redirect()->route('verify.otp');
     }

     public function showVerifyOtpForm()
     {
         return view('vegetables.verify_otp');
     }

     public function verifyOtp(Request $request)
     {
         $validatedData = $request->validate([
             'otp' => 'required|digits:6',
         ]);

         $user = User::where('otp', $validatedData['otp'])->first();

         if ($user) {
             $user->is_verified = true;
             $user->otp = null;
             $user->save();

             Auth::login($user);

             return redirect()->route('home');
         }

         return back()->withErrors(['otp' => 'Invalid OTP.']);
     }

     public function showLoginForm()
     {
         return view('vegetables.login');
     }

     public function login(Request $request)
     {
         $credentials = $request->only('username', 'password');

         $user = User::where('username', $credentials['username'])->first();

         if ($user && !$user->is_verified) {
             return back()->withErrors(['username' => 'Please verify your email before logging in.']);
         }

         if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
             return redirect()->route('home');
         }

         return back()->withErrors(['username' => 'The provided credentials do not match our records.']);
     }

     public function logout()
     {
         Auth::logout();
         return redirect()->route('vegetables.login');
     }

     public function showProducts()
     {
         $products = VegeProduct::select('id', 'image', 'p_name', 'price', 'mass')->get();
         return view('vegetables.home', compact('products'));
     }

     public function showProductDetails($id)
    {
        $product = VegeProduct::select('image', 'p_name', 'details', 'mass', 'price', 'created_at', 'updated_at')
                            ->where('id', $id)
                            ->first();

        if (!$product) {
            abort(404, 'Product not found');
        }

        return view('vegetables.product_details', compact('product'));
    }

 }
