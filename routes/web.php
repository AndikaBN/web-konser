    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\AuthenticatedSessionController;
    use App\Http\Controllers\Auth\RegisteredUserController;
    use App\Http\Controllers\AdminUserController;
    use App\Http\Controllers\KonserController;
    use App\Http\Controllers\RekeningController;
    use App\Http\Controllers\PesananController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\UserProfileController;
    use App\Http\Controllers\AllKonserController;
    use App\Http\Controllers\FaqController;

    Route::get('/', function () {
        return view('auth.login');
    });

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login')
        ->middleware('guest');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register')
        ->middleware('guest');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            if (auth()->user()->role === 'admin') {
                return redirect('/admin');
            }
            return redirect('/user');
        })->name('dashboard');

        // Halaman Admin
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->middleware('role:admin')->name('admin.dashboard');

        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::get('/admin', function () {
                return view('admin.dashboard');
            })->name('admin.dashboard');

            Route::resource('users', AdminUserController::class)->except(['show']);
            Route::resource('konser', KonserController::class)->except(['show']);
            Route::resource('rekening', RekeningController::class);
            Route::resource('category', CategoryController::class)->except(['show']);
            Route::get('admin/pesanan', [PesananController::class, 'indexAdmin'])->name('admin.pesanan.index');
            Route::post('admin/pesanan/{pesanan}/mark-paid', [PesananController::class, 'markAsPaid'])->name('admin.pesanan.mark-paid');

            Route::get('faq', [FaqController::class, 'index'])->name('faq.index');
            Route::get('faq/create', [FaqController::class, 'create'])->name('faq.create');
            Route::post('faq', [FaqController::class, 'store'])->name('faq.store');
            Route::delete('faq/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');
        });

        Route::get('/user', function () {
            return view('user.dashboard');
        })->middleware('role:user')->name('user.dashboard');

        Route::middleware(['auth', 'role:user'])->group(function () {
            Route::get('/user', [UserProfileController::class, 'konserUserDashboard'])->name('konserUser.dashboard');
            Route::get('user/profile', [UserProfileController::class, 'profile'])->name('user.profile');
            Route::get('user/profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
            Route::put('user/profile/', [UserProfileController::class, 'update'])->name('user.profile.update');
            Route::get('user/pesanan', [PesananController::class, 'indexUser'])->name('user.pesanan.index');
            Route::get('user/pesanan/create', [PesananController::class, 'create'])->name('user.pesanan.create');
            Route::post('user/pesanan', [PesananController::class, 'store'])->name('user.pesanan.store');
            Route::get('user/pesanan/{pesanan}/download', [PesananController::class, 'downloadETicket'])->name('user.pesanan.download');

            Route::get('all-konser', [AllKonserController::class, 'index'])->name('all-konser.index');

            Route::get('/konser/{id}', [PesananController::class, 'show'])->name('all-konser.show');
            Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
        });
    });
