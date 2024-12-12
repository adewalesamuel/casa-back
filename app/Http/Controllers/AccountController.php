<?php
namespace App\Http\Controllers;

use App\Casa\TransactionType;
use App\Http\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repository\AccountRepository;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$accounts = Account::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $accounts = $accounts->get();
        } else {
            $accounts = $accounts->paginate();
        }

        $data = [
            'success' => true,
            'accounts' => $accounts
        ];

        return response()->json($data);
    }

    public function user_index(Request $request)
    {
        $auth_user = Auth::getUser($request, Auth::USER);
    	$accounts = Account::where('user_id', $auth_user->id)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $accounts = $accounts->get();
        } else {
            $accounts = $accounts->paginate();
        }

        $data = [
            'success' => true,
            'accounts' => $accounts
        ];

        return response()->json($data);
    }

    public function user_analytics(Request $request) {
        $auth_user = Auth::getUser($request, Auth::USER);
        $account = $auth_user->account();

        $data = [
            'credit_sum' => $account->transactions()
            ->where('type', TransactionType::CREDIT)->sum(),
            'debit_sum' => $account->transactions()
            ->where('type', TransactionType::DEBIT)->sum(),
            'other_sum' => $account->transactions()
            ->where('type', TransactionType::OTHER)->sum()
        ];

        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        $validated = $request->validated();

        $account = AccountRepository::store($validated);

        $data = [
            'success'       => true,
            'account'   => $account
        ];

        return response()->json($data);
    }

    public function user_store(StoreAccountRequest $request)
    {
        $auth_user = Auth::getUser($request, Auth::USER);
        $validated = $request->validated();

		$validated['user_id'] = $auth_user->id;

        $account = AccountRepository::store($validated);

        $data = [
            'success'       => true,
            'account'   => $account
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $data = [
            'success' => true,
            'account' => $account
        ];

        return response()->json($data);
    }

    public function user_show(Request $request, Account $account)
    {
        $auth_user = Auth::getUser($request, Auth::USER);

        $data = [
            'success' => true,
            'account' => Account::where('id', $account->id)
            ->where('user_id', $auth_user->id)->firstOrFail()
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $validated = $request->validated();

        $account->is_active = $validated['is_active'] ?? null;
		$account->user_id = $validated['user_id'] ?? null;

        $account->save();

        $data = [
            'success'       => true,
            'account'   => $account
        ];

        return response()->json($data);
    }

    public function user_update(UpdateAccountRequest $request, Account $account)
    {
        $auth_user = Auth::getUser($request, Auth::USER);
        $validated = $request->validated();
        $account = Account::where('id', $account->id)
        ->where('user_id', $auth_user->id)->firstOrFail();

        $account->is_active = $validated['is_active'] ?? null;
		$account->user_id = $validated['user_id'] ?? null;

        $account->user_id = $auth_user->id;

        $account->save();

        $data = [
            'success'       => true,
            'account'   => $account
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();

        $data = [
            'success' => true,
            'account' => $account
        ];

        return response()->json($data);
    }

    public function user_destroy(Request $request, Account $account)
    {
        $auth_user =  Auth::getUser($request, Auth::USER);
        $account = Account::where('id', $account->id)
        ->where('user_id', $auth_user->id)->firstOrFail();

        $account->delete();

        $data = [
            'success' => true,
            'account' => $account
        ];

        return response()->json($data);
    }
}
